## Edit Screen: Setting Up Next and Back Buttons (Advanced)

This code does not have the limitation that you can only navigate to records that are displayed on the current Browse page.

<p align="left">
  <img src="screenshots/edit_record_navigator_adv.gif">
</p>

#### JavaScript Code

☛ Add the JavaScript code from the file [edit_record_navigation.js](edit_record_navigation.js) in the Header (❓ [Home ► Setup](/codelib/common/setup_header.gif)) or include it with the <script> tag. Click Save and log in again.

#### PHP Code

1. Create a [Procedure](https://wiki.nubuilder.net/nubuilderforte/index.php/Procedures): Tab Builders -> Procedure -> Add

2. Code: get_edit_record

3. Give it a description. (E.g. Edit Record Navigator: Get Next/Previous Primary Key)

4. Paste the PHP code from the file [edit_record_navigation_procedure.php](edit_record_navigation_procedure.php) to the PHP field.

5. Save

#### Usage

Call the function addNavigationButtons() to display the navigation buttons.

☛ Add this JavaScript to your form's Custom Code field. ❓ [How to add Custom Code](/common/form_add_custom_code_javascript.gif)
```javascript

if (nuFormType() == 'edit') {
   addNavigationButtons();
}
```
