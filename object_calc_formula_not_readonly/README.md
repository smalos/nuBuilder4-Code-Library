
###  Globeadmin: How to make the Formula field editable

You have created a (complex) formula and want to edit it later? Unfortunately, the formula field is readonly, so that changes are not possible. 
You have to re-create the whole formula...
Calling enableFormulaField() in the Header will activate the formula field permanently.

<p align="left">
  <img src="screenshots/formula_not_readonly.png">
</p>

☛  Add this JavaScript code in the Header (❓ [Home ► Setup](/common/setup_header.gif)). Click Save and log in again.

```javascript
// Make the Formula Field (Object -> Calc Tab) not readonly
function enableFormulaField() {

    if (window.global_access) {
        if ((nuCurrentProperties().form_id == 'nuobject')) {
            $("#sob_calc_formula")
                .prop("readonly", false)
                .removeClass('nuReadonly');
        }
    }
}

function nuOnLoad() {
    enableFormulaField();
}
```
