<!doctype html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.1.1">
  <title>pdf-signature</title>


  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="asset/css/jquery-ui.css">
  <link rel="stylesheet" href="asset/css/jquerysctipttop.css">
  <link rel="stylesheet" href="asset/css/jqueryui-style.css">
  <link rel="stylesheet" href="asset/fontawesome/css/fontawesome.css">
  <link rel="stylesheet" href="asset/fontawesome/css/solid.css">
  <link rel="stylesheet" href="asset/fontawesome/css/brands.css">
  <script src="https://kit.fontawesome.com/2248e51be4.js" crossorigin="anonymous"></script>
  <script src="bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="bootstrap/dist/js/bootstrap.js"></script>

  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <!-- <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://jqueryui.com/jquery-wp-content/themes/jqueryui.com/style.css"> -->

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="style.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
  <header>
  </header>

  <!-- Begin page content -->
  <main role="main" class="main">
    <div class="p-4">
      <form action="api.php" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-7">
            <div class="dtb-canvas push-down">
              <div class="card">
                <div class="card-header">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="myPdf" name="document" accept=".pdf" required="" oninvalid="this.setCustomValidity('File tidak boleh kosong')" oninput="setCustomValidity('')">
                    <label class=" custom-file-label" for="myPdf">Upload PDF</label>
                  </div>
                  <div class="control" style="padding-top: 20px;">
                    <a class='btn-sm page-btn btn btn-secondary float-left' id='prev'>
                      < </a>&nbsp
                        <label class="centered" style="float: left; text-align: center" id="nav"></label> &nbsp
                        <a class='btn-sm page-btn btn btn-secondary float-right' id='next'> > </a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="canvas-here">
                    <canvas class='page' id='pdfViewer' height="100" width="100"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="col-md-1"></div> -->

          <div class="col-md-5 push-down">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab-signature" role="tab" aria-controls="home" aria-selected="true">Signature</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab-materai" role="tab" aria-controls="profile" aria-selected="false" hidden>E-Materai</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="messages-tab" data-toggle="tab" href="#tab-stempel" role="tab" aria-controls="messages" aria-selected="false" hidden>E-Stamp</a>
              </li>
            </ul>

            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="tab-signature" role="tabpanel" aria-labelledby="home-tab">
                <div class="card">
                  <div class="card-header">
                    Signature
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="users" class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Email</th>
                            <th>Box</th>
                            <th>P</th>
                            <th>X</th>
                            <th>Y</th>
                            <th>H</th>
                            <th>W</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card-footer">
                    <a id="generate-json" class="btn btn-md btn-success button_generate" style="display: none;">Generate
                      JSON</a>
                    <a id="clear-table" class="btn btn-md btn-danger float-right">Clear</a>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="tab-materai" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card">
                  <div class="card-header">
                    E-Materai
                  </div>
                  <div class="card-body">
                    <div class="table">
                      <table id="tb_materai" class="table table-striped table-sm">
                        <thead>
                          <div class="row mb-3">
                            <div class="col-6">
                              <div class='custom-control custom-checkbox'>
                                <input type="checkbox" class="custom-control-input" id="useMaterai">
                                <label class="custom-control-label" for="useMaterai">Use e-Materai</label>
                              </div>
                            </div>
                            <div class="col-6">
                              <select id="document_type" name="document_type" class='form-control custom-select' style='width: 100%; border: 1px solid #e5e5e5; border-radius:40px; display: none;'>
                                <option value="Dokumen pelunasan utang (lebih dari 5 juta)">Dokumen pelunasan utang
                                  (lebih
                                  dari 5 juta)</option>
                                <option value="Dokumen penerimaan uang (lebih dari 5 juta)">Dokumen penerimaan uang
                                  (lebih
                                  dari 5 juta)</option>
                                <option value="Dokumen Transaksi">Dokumen Transaksi</option>
                                <option value="Surat Berharga">Surat Berharga</option>
                                <option value="Surat Keterangan">Surat Keterangan</option>
                                <option value="Surat Lainnya">Surat Lainnya</option>
                                <option value="Surat Pernyataan">Surat Pernyataan</option>
                              </select>
                            </div>
                          </div>
                          <tr class="buttonAdd" style="display: none">
                            <th>Materai</th>
                            <th>Page</th>
                            <th>X</th>
                            <th>Y</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="buttonAdd" style="display: none">
                      <a id="materai" class="btn btn-md btn-success"><i class="fa-solid fa-plus"></i></a>
                      <a id="generate-json-materai" class="btn btn-md btn-success button_generate" style="display: none;">Generate JSON</a>
                      <a id="clear-table-materai" class="btn btn-md btn-danger float-right">Clear</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="tab-stempel" role="tabpanel" aria-labelledby="messages-tab">
                <div class="card">
                  <div class="card-header">
                    E-Stamp
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="tb_stempel" class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Email</th>
                            <th>Box</th>
                            <th>Page</th>
                            <th>X</th>
                            <th>Y</th>
                            <th>H</th>
                            <th>W</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card-footer">
                    <a id="stempel" class="btn btn-md btn-success"><i class="fa-solid fa-plus"></i></a>
                    <a id="generate-json-stempel" class="btn btn-md btn-success button_generate" style="display: none;">Generate JSON</a>
                    <a id="clear-table-stempel" class="btn btn-md btn-danger float-right">Clear</a>
                  </div>
                </div>
              </div>
            </div>

            </br>

            <div class="card">
              <div class="card-header">
                <div class="float-right form-check" style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;" unselectable="on" onselectstart="return false;" onmousedown="return false;">
                  <!-- <input type="checkbox" class="form-check-input" id="checkbox" name="is_in_order">
                  <label class="form-check-label" for="checkbox">Sequential Sign</label> -->
                  <div class='custom-control custom-checkbox'>
                    <input type='checkbox' class='custom-control-input' id='checkbox' name="is_in_order">
                    <label class='custom-control-label' for='checkbox'>Sequential Sign</label>
                  </div>
                </div>
              </div>
              <div class="card-body" style="display: none;">

                <textarea class="form-control" id="hasil_json" name="signature"></textarea> <br>
                <textarea class="form-control" id="hasil_json_materai" name="materai"></textarea> <br>
                <textarea class="form-control" id="hasil_json_stempel" name="stempel"></textarea> <br>
              </div>
              <div class="card-footer">
                <!-- <button type="submit" class="btn btn-md btn-success">Send Data</button> -->
                <button type="submit" id="generate-send" class="btn btn-md btn-success">Send Data</button>
                <!-- <a class="btn btn-primary" id="copy">Copy JSON</a> -->
              </div>
            </div>


          </div>



        </div>
    </div>
    </form>
    </div>
  </main>
  <script src="asset/js/jquery-3.4.1.js"></script>
  <script src="asset/js/sweetalert/sweetalert2.all.min.js"></script>
  <script src="asset/js/jquery-ui.js"></script>
  <!-- <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script> -->
  <script src="asset/js/pdf.js"></script>
  <script type="text/javascript" src="script.js"></script>
  <!-- <script type="text/javascript" src="pdf-lib.js"></script> -->

  <script>
    $(document).ready(function() {
      $("#useMaterai").change(function() {
        if (this.checked) {
          $(".buttonAdd").show();
          $("#document_type").show();

        } else {
          $(".buttonAdd").hide();
          $("#document_type").hide();

        }
      });
    });
  </script>
</body>

</html>