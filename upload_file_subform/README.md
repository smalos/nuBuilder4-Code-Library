## 1. Add objects to your subform

In your subform, add 3 additional objects:<br />
(Replace *sample* with your table field prefix. E.g. cus_upload, cus_file_name, cust_file_id)

###### 1.1. A button

Type: Input<br />
Label: Download<br />
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

###### 1.3. A text field

Type: Input<br />
Label: File Id<br />
ID: sample_file_id<br />
Access: Hidden<br />

<p align="left">
  <img src="screenshots/sample_file_id.png" width="450">
</p>

Also create this column in your database table (in phpMyAdmin). Type: VARCHAR(50)

## 2. Add objects to your main form

###### 2.1. A HTML object

Type: HTML<br />
Label: Upload<br />
ID: sample_upload<br />
Access: Hidden<br />
HTML: Add the code from [input_type_file.html](input_type_file.html).

## 3. Custom Code

In your main form's Custom Code, add the Javascript from this file: 

[form_custom_code.js](form_custom_code.js).

<p align="center">
  <img src="screenshots/form_custom_code.png" width="250">
</p>

<br />
(Replace *sample* with your table field prefix. E.g. cus_file_name, cus_file_id)

## 4. Create Folders

Create a new folder /libs/upload/ in the root directory of nuBuilder. Also create a new folder in the upload folder named documents.

<p align="center">
  <img src="screenshots/folders.png" width="250">
</p>

## 5. Upload.php

Place the [upload.php](upload.php) in folder /libs/upload/
