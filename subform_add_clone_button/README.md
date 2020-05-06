## Subform: Add Clone Buttons to Rows

This code snippet shows you how to add a *Clone Button* in each row (but the last) of a Subform to copy values from one row to the last row.

<p align="left">
  <img src="https://s6.gifyu.com/images/clone_row.gif" >
</p>

1. First, add a new object (Type: Input, Button) to the your Subform with **Title** *Clone*

2. Attach an **onclick** event to your button in the *Custom Code* Tab with the JavaScript  

```javascript
onSubformClone(event);
```

3. Add an **afterinsertrow** event to the Subform with this JavaScript:

```javascript
onSubFormAfterInserRow();
```

4. Add this JavaScript code to your form's *Custom Code* field:

<details>
  <summary>Click to view the code!</summary>
  
  ```javascript
var sfId = 'Subform_Object_ID'; // <-- Replace with the Subform Object ID.
var btnCloneId = 'Clone_Button_ID'; // <-- Replace with the Button ID of the Clone Button


function getRowNumber(id) {
    return $('#' + String(id)).attr('data-nu-prefix').slice(-3);
}

function onSubformClone(event) {

    var id = event.target.id;

    var sfId = $('#' + id).attr('data-nu-form');

    var sr = nuPad3(getRowNumber(id));
    var dr = nuPad3(nuSubformObject(sfId).rows.length - 1);

    var obj = nuSubformObject(sfId)
    for (var c = 0; c < obj.fields.length - 1; c++) {

        var s = $('#' + sfId + nuPad3(sr) + obj.fields[c]);
        var d = $('#' + sfId + nuPad3(dr) + obj.fields[c]);

        if (s.is(':radio,:checkbox')) {
            d.prop('checked', s.prop('checked')).change();
        } else {
            d.val(s.val()).change();
        }

    }
}

function hideLastCloneButton() {

    var r = nuPad3(nuSubformObject(sfId).rows.length - 1);
    cloneButton = st + nuPad3(r) + btnCloneId;
    nuHide(cloneButton);
}

function onSubFormAfterInserRow() {

    // Show all clone buttons
    $("[id$='" + btnCloneId + "']").each(function (i, obj) {
        nuShow($(this).attr('id'));
    });

    hideLastCloneButton();
}

if (nuFormType() == 'edit') {
    hideLastCloneButton();
}

  ```
</details>

