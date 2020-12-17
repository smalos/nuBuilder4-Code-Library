### Edit Screen: Disable all Objects

The function disableAllObjects() will disable all objects on a form.
Provide the optional argument excludeTypes (array) to exclude certain object types.


Add this JavaScript to your form's **Custom Code** field.
   ❓ [How to add Custom Code](/codelib/common/form_add_custom_code_javascript.gif)


```javascript

function disableAllObjects(excludeTypes, excludeIds) {

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
            nuDisable(obj.id);
        }
    }
	
}

```

#### ✪ Example 1: Disable all objects
```javascript
disableAllObjects();
```

#### ✪ Example 2: Disable all objects but exclude some types.
```javascript
disableAllObjects(['html', 'display', 'word']);
```

#### ✪ Example 3: Disable all objects but exclude the object with id "cus_name"
```javascript
disableAllObjects([],['cus_name']);
```
#### ✪ Example 3: Disable all objects but not for globeadmin and the Access Level "manager"
```javascript
if (nuFormType() == 'edit') {
    var alc = nuAccessLevelCode();
    if (!window.global_access || !alc == 'manager') {
        disableAllObjects();
    }
}
```
