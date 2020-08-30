# Edit Screen: Prevent a user from editing saved records

You may want to prevent users from making changes to existing records.
More precisely, users would only be permitted to add a new record and save it but then after the record is saved they can no longer edit it.

To do so, we are adding some JavaScript code to the form to check whether the user is allowed to edit the record.
The function isEditable() returns true if it is either a new record, if the globeadmin is logged in or the Access Level includes "manager".
If editing is not permitted, all controls on the form will be disabled and a "(Read-only)" text is appended to the current breadcrumb to indicate that the form is in read-only mode.

Since the user may still use the "Save" option in the Options Menu or press Ctrl+Shift+S, we are also adding a check in nuBeforeSave().


☛  Add this code to your form’s custom code field.

❓ [How to add Custom Code](/codelib/common/form_add_custom_code_javascript.gif)

```javascript
function accessLevelIncludes(string) {
	var acl = nuAccessLevelCode();
	return acl.toLowerCase().includes(string.toLowerCase())
}


function isEditable() {
    return nuIsNewRecord() ||  accessLevelIncludes("manager") || window.global_access;
}


function nuBeforeSave() {

 if (! isEditable()) {
     nuMessage(['This record cannot be modified anymore.']);
     return false;
  }

  return true;

}

function disableObjects() {
	var objects = JSON.parse(JSON.stringify(nuSERVERRESPONSE)).objects;
	for(var i = 0 ; i < objects.length ; i++){
		nuDisable(objects[i].id);
	}
}


function setReadonly() {
    var readonly = '<font color="#ff0000">(Read-only)</font>';
    nuSetTitle(nuFORM.getProperty('title') + ' ' + readonly);
    
    nuDisable('nuSaveButton');    
    disableObjects();
}


if (nuFormType() == 'edit') {
  if (! isEditable()) {
     setReadonly();
  }
}

```

Since client-side validation is not secure (JavaScript can easily be modified), we are also going to add a server-side validation.

Add this PHP code in the BS (Before Save) event:

```php
function isEditable() {
    return nuHasNoRecordID() || stripos("#ACCESS_LEVEL_CODE#", 'manager') > - 1 || "#GLOBAL_ACCESS#" == '1';
}

if (!isEditable()) {
    nuDisplayError('This record cannot be modified anymore.');
}
```
