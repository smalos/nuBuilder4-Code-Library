### Edit Screen: Disable/Enable all Objects

The function disableAllObjects() will disable all objects on a form. nuEnableAllObjects() will enable all objects.

Provide the optional argument excludeTypes (array) to exclude certain object types.


☛  Add the following JavaScript Code to your form’s Custom Code field. Or add it under Setup -> Header, if the functions are going to be used in several forms.
(They are already included in nuBuilder v4.5)

❓ [How to add Custom Code](/codelib/common/form_add_custom_code_javascript.gif)

<details>
  <summary>Click to view the code!</summary>
  
```javascript

function nuEnableDisableAllObjects(v, excludeTypes, excludeIds) {

	if (typeof excludeTypes === 'undefined') {
		let excludeTypes = [];
	}

	if (typeof excludeIds === 'undefined') {
		let excludeIds = [];
	}

	var r = JSON.parse(JSON.stringify(nuSERVERRESPONSE));
	for (var i = 0; i < r.objects.length; i++) {
		let obj = r.objects[i];

		if ($.inArray(obj.type, excludeTypes) == -1 && $.inArray(obj.id, excludeIds) == -1 ) {
			nuEnable(obj.id, v);
		}
	}

}

function nuEnableAllObjects(excludeTypes, excludeIds) {

	 nuEnableDisableAllObjects(true, excludeTypes, excludeIds);
 
}

function nuDisableAllObjects(excludeTypes, excludeIds) {

	nuEnableDisableAllObjects(false, excludeTypes, excludeIds);

}

```
</details>

#### ✪ Example 1: Disable all objects
```javascript
nuDisableAllObjects();
```

#### ✪ Example 2: Enable all objects
```javascript
nuEnableAllObjects();
```

#### ✪ Example 3: Disable all objects but exclude some types.
```javascript
nuDisableAllObjects(['html', 'display', 'word']);
```

#### ✪ Example 4: Disable all objects but exclude the object with id "cus_name"
```javascript
nuDisableAllObjects([],['cus_name']);
```

#### ✪ Example 5: Disable all objects but not for globeadmin and the Access Level "manager"
```javascript
if (nuFormType() == 'edit') {
    var alc = nuAccessLevelCode();
    if (!window.global_access || !alc == 'manager') {
        nuDisableAllObjects();
    }
}
```
