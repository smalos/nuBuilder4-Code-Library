# Edit Screen: How to validate form entries before saving?

In this article, we'll look at how client side validation can be done using JavaScript/jQuery. 

JavaScript provides a way to validate a form's data on the client's computer before sending it to the web server. 
E.g. if a form field does not contain a valid email address, display an error message and prevent the form from being saved.

The following example shows how to validate a Contract No. (e.g. it must start with a prefix 500) and IBAN when when the user saves the form.
To do so, we are calling a function validateForm() which returns corresponding error messages in case of validation errors.

```javascript
// Function to check if an entered contract number is valid
function validContractNo(f) {
    result = '';
    if (!$('#' + f).val().startsWith("500")) {
        result = 'Please enter a valid <b>Contract No.</b><br>';
    }
    return result;
}

// Function to check if an entered IBAN is valid
function validIBAN(f) {
    result = '';
    if (! [some code that validates an IBAN....]) {
        result = 'Please enter a <b>IBAN</b>.<br>';
    }
    return result;
}

// Function, that validates certain fields on the form
function validateForm() {

    var result = '';

    result += validContractNo('cus_contract_no');
    result += ValidIBAN('cus_iban');

    return result;
}


// Form validation is taking place when the user saves the form
function nuBeforeSave() {

    if (nuFORM.edited === true) {

        var err = validateForm();

        // If there are any errors
        if (err !== '') {
            // Display (all) error messages
            nuMessage([err]);
            // and abort saving
            return false;
        }
        
        // In case of no errors, continue saving
        return true;

    }

    nuMessage(["Form not saved because no data was changed"]);
    return false;
}
```
