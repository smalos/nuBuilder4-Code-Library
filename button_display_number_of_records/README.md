### Display the Number of Records on a Button

☛  Add a Display Object to your form with an SQL to count the number of records in your table. The object’s ID is displayCustCount in this example. Set its access to Hidden once you get it set up.

☛  On your Screen​ you would have a Button​ called buttonCustCount

☛  Add this code to your form’s Javascript section and replace the IDs with your own ones.

´´´
if (nuFormType() == 'edit') {
    $('#buttonCustCount').html($('#buttonCustCount').html() + ' (' + $('#displayCustCount').val() + ')');
}
´´´

Result: The number of records is displayed on the button:
