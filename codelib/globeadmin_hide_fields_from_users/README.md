### Globeadmin: How do Hide certain Fields from users?

Sometimes you may want to hide certain fields from "normal" users and display them only for the administrator (globeadmin).

To do so, add this JavaScript Code to your form’s *Custom Code* field:

❓ [How to add Custom Code](/codelib/common/form_add_custom_code_javascript.gif)

```javascript

// Declare the fields/nuBuider Object Ids here, that you want to hide from users
var fieldsGlobeadmin = 
	['cus_created_date', 
	'cus_created_user', 
	'cus_updated_date',
	'cus_updated_user'];


function showFields(f, visible) {
    for (var i = 0; i < f.length; i++) {
        visible ? nuShow(f[i]) : nuHide(f[i]);
    }
}

if (nuFormType() == 'edit') {
    if (!window.global_access) { // if not globeadmin
        showFields(fieldsGlobeadmin, false);
    }
}
```
