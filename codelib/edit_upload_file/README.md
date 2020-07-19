# Edit Screen: Upload a File to the Server on Button Click

In this article, I will show how to upload a file to the server on button click and store the file name and its (unique) file id in a separate nuBuilder Text object.

### 1. In your Form, add a HTML object.

Type: HTML<br />
Label: Upload File<br />
ID: upload_html<br />
HTML: Add the code from [input_type_file.htm](input_type_file.htm).

The HTML object holds code which creates a file upload object and processes the file upload

### 2. Add a Text Object
Type: Input (Text)<br />
Label: Filename<br />
ID: file_name (e.g.)<br />
Width: 150<br />

Also create this column in your database table (in phpMyAdmin). Type: VARCHAR(100)

This object is used to store the filename that is returned by the PHP script.


### 3. PHP Script

Place the [upload_file.php](upload_file.php) in the folder /libs/upload/<br />
Edit the permitted file types allowed for the file upload. Change the upload directory ($uploaddir) if necessary.


### 4. Create the upload folder

Create a new folder with the name *files* in the folder /libs/upload/ 

