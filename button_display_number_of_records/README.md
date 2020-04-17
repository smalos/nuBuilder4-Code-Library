### Display the Number of Records on a Button

☛  Add a Display Object to your form together with a SQL query to count the number of records in a table. 
The object’s ID is *displayCustCount* in this example. Set its access to *Hidden* once you get it set up.

☛  On your Screen​ you would have a Button​ called *buttonCustCount*

<p align="left">
  <img src="screenshots/display_object_count.png" width="282">
</p>

☛  Add this code to your form’s JavaScript field and replace the IDs with your own ones.

```javascript
if (nuFormType() == 'edit') {
    var btn = $('#buttonCustCount');
    btn.html(btn.html() + ' (' + $('#displayCustCount').val() + ')');
}
```

Result: The number of records is displayed on the button:

<p align="left">
  <img src="screenshots/button_object_count.png" width="195">
</p>
