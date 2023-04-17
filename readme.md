# Djelas Tandatangan Bersama Tool Documentation

This tool is used to create details values to pass to our API.

## Features

- Preview uploaded PDF
- Get the x-pos, y-pos, height, width and PDF page values
- Create the JSON required by the API


## How To Use

- Upload your PDF Document (Top file input field)
	- Review Uploaded PDF  ```bash ( script.js line 8 - 36 & line 255 - 296 ) ```
- Select the PDF page you want to embed the signature area
	- Function ( script.js line 39 - 71 )

- Select the Area of signature on the PDF preview (Use mouse to select)
	* Once the Signature Area is placed, it can be resized and moved. 
	- The Page number, X-pos, Y-pos, Width and Height will be recorded in the left Data Table ( index.html line 66 - 105 )
	- Function ( script.js line 74 - 183 )

- Input Email Address in the Data table ( index.html line 66 - 105 ) 

- Click the "Generate JSON" button, and your JSON will appear in the JSON Result Textarea ( index.html line 99 )
	- Function ( script.js line 196 - 236 )