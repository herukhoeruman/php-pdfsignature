var pdfjsLib = window['pdfjs-dist/build/pdf'];
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.js';
var prev = document.getElementById("prev");
var next = document.getElementById("next")
const myPdf = document.getElementById("myPdf");


window.onload = function(){
	prev.style.visibility = "hidden"; // visible
	next.style.visibility = "hidden"; // visible
	var page_now, i = 1;
	var label_nav = document.getElementById("nav");	
}

myPdf.addEventListener('change', (e) => {
	prev.style.visibility = "visible";
	next.style.visibility = "visible";
	page_now = 1;

  countPage(e.target.files[0]);
  render(e.target.files[0], "pdfViewer")
});


function countPage( file ) {
	var reader = new FileReader();

  reader.readAsBinaryString(file);
  reader.onload = function(a) {
  	// count page
    count_page = reader.result.match(/\/Type[\s]*\/Page[^s]/g).length;
    // show the count to html
    $("#nav").html("Page <b>1</b> From <b>"+count_page+"</b> Page")
  }
}

function render(file, layer, pageNo = false ) {
  var fileReader = new FileReader();
  fileReader.onload = function(e) {
    var pdfData = new Uint8Array(this.result);
    // Using DocumentInitParameters object to load binary data.
    var loadingTask = pdfjsLib.getDocument({data: pdfData});
    loadingTask.promise.then(function(pdf) {
      // Fetch the first page
      var pageNumber = (pageNo) ? pageNo : 1;
      var canvas = document.getElementById(layer);

      pdf.getPage(pageNumber).then(function(page) {
        var scale     = 1;
        var viewport  = page.getViewport({scale: scale});

        // Prepare canvas using PDF page dimensions
        var context   = canvas.getContext('2d');
        canvas.height = viewport.height;
        canvas.width  = viewport.width;

        // Render PDF page into canvas context
        var renderContext = {
          canvasContext : context,
          viewport      : viewport
        };

        var renderTask = page.render(renderContext);
        renderTask.promise.then(function () {
          
        });
      });
    }, function (reason) {
      // PDF loading error
      console.error(reason);
    });
  };
  fileReader.readAsArrayBuffer(file);
}

function toMM(argument) {
	return Math.floor( argument * 0.264583 );
}