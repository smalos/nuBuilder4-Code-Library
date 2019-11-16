In this article, I will explain how to upload a file on button click in a nuBuilder subform and store the file name and its file id in a separate field in that row.

To do so, we create an Upload button object and assign an onclick event handler to it which triggers the Click event of a (hidden) Fileupload element which in turn opens the File Upload dialog to choose the file for uploading.
When a File is selected, it triggers the Change event handler of the Fileupload element which than starts the file upload using FormData object and PHP. The form data is sent to a server-side script (upload.php) via Ajax to process the upload and data submission.
Based on the response, the status is shown in a field on the form.

## 1. Add objects to your subform

In your subform, add 3 additional objects:<br />
(Replace *sample* with your table field prefix. E.g. cus_upload, cus_file_name, cust_file_id)

###### 1.1. A button

Type: Input<br />
Label: Upload<br />
ID: sample_upload<br />
Input Type (and class): Button<br />

<p align="left">
  <img src="screenshots/sample_upload_button.png" width="450">
</p>

Custom Code: Event: onclick, Javascript: upload(event);<br />

<p align="left">
  <img src="screenshots/button_onclick.png" width="450">
</p>

###### 1.2. A text field

Type: Input<br />
Label: Filename<br />
ID: sample_file_name<br />
Access: Readonly<br />

<p align="left">
  <img src="screenshots/sample_file_name.png" width="450">
</p>

Also create this column in your database table (in phpMyAdmin). Type: VARCHAR(100)

The file name (without prefix) is written into this field.

###### 1.3. A text field

Type: Input<br />
Label: File Id<br />
ID: sample_file_id<br />
Access: Hidden<br />

<p align="left">
  <img src="screenshots/sample_file_id.png" width="450">
</p>

Also create this column in your database table (in phpMyAdmin). Type: VARCHAR(50)

The file Id (prefix) is written into this field.

## 2. Add objects to your main form

###### 2.1. A HTML object

Type: HTML<br />
Label: Upload<br />
ID: sample_upload<br />
Access: Hidden<br />
HTML: Add the code from [input_type_file.html](input_type_file.html).

The File Upload Control is created in this HTML object and the upload is triggered.

###### 2.2. A Word object

Type: Word<br />
Label: Upload Result<br />
ID: sample_msg<br />

This object is used to display the upload result.

## 3. Custom Code

In your main form's Custom Code, add the Javascript from this file: 

[form_custom_code.js](form_custom_code.js).

<p align="left">
  <img src="screenshots/form_custom_code.png" width="250">
</p>

<br />
(Replace *sample* with your table field prefix. E.g. cus_file_name, cus_file_id)

## 4. Create Folders

Create a new folder /libs/upload/ in the root directory of nuBuilder. Also create a new folder in the upload folder named documents.

<p align="left">
  <img src="screenshots/folders.png" width="250">
</p>

## 5. Upload.php

Place the [upload.php](upload.php) in folder /libs/upload/<br />
Edit the allowed file extensions in that file.
