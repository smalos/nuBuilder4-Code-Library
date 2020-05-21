## Edit Screen: Setting Up Next and Back Buttons

Adding a back and forward button gives the user the possibility to go to the previous or the next record without the need to go back to the Browse Screen first.

Add two button objects to you form:

* A First Button with Title "Next" and in Custom Code, add an onclick event with the Javascript ```openRecord(1);```
* A Second Button with Title "Back" and in Custom Code, add an onclick event with the Javascript ```openRecord(-1);```

This will allow the user to cycle through the records being returned from the Browse Screen.

<p align="left">
  <img src="screenshots/edit_record_navigator.gif">
</p>


☛ Add this JavaScript to your form's Custom Code field:

 ❓ [How to add Custom Code](/common/form_add_custom_code_javascript.gif)

```javascript
function openRecord(r, test) {

    var rows = nuFORM.breadcrumbs[nuFORM.breadcrumbs.length - 2].browse_rows;
    pks = rows.map(x => x[0]);

    var idx = pks.indexOf(nuCurrentProperties().record_id);

    gotoPk = pks[idx + r];
    result = typeof gotoPk !== "undefined";

    if (result && !test == true) {
        nuForm(nuGetProperty('form_id'), gotoPk, '', '', '1');
    }

    return result;
}

function setBtnEnabled(objId, value) {
    value === false ? nuDisable(objId) : nuEnable(objId);
}

// When the Edit Screen is loaded, we set the enabled status of the buttons by calling openRecord() 
// and a second parameter test.
// This will return a boolean flag indicating wheter there is a next or previous record.  

if (nuFormType() == 'edit') {
    setBtnEnabled('btn_next', openRecord(1, true));
    setBtnEnabled('btn_back', openRecord(-1, true));
}
```

