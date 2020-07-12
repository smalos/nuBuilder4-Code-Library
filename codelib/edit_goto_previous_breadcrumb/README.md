### Edit Screen: Return to another form after saving

After saving a record, you might want the user to take back to the previous Breadcrumb/Screen or any other (launch) form.

☛Add this JavaScript Code to your form’s Custom Code field:

### Return to the previous Breadcrumb/Screen:

```javascript
if (nuFormType() == 'edit') {
    if (nuHasBeenSaved() === 1) {
        goToPreviousBreadcrumb();
    }
}

function goToPreviousBreadcrumb() {
    var l = window.nuFORM.breadcrumbs.length;
    if (l > 1) {
        nuGetBreadcrumb(l - 2);
    }
}

```

### Return to a specific (launch) form:

```javascript
if (nuFormType() == 'edit') {
    if (nuHasBeenSaved() === 1) {
        goToBreadcrumb();
    }
}

function goToBreadcrumb(formId) {

    if (typeof formId == 'undefined') {
           formId = 'nuuserhome';
    }
		
    if (nuFORM.getCurrent().form_code == formId) {
        return;
    }
	
    var b = window.nuFORM.breadcrumbs.length;
    for (var i = 0; i < b; i++) {
        if (window.nuFORM.breadcrumbs[i].form_code == formId) {
            nuGetBreadcrumb(i);
            return;
        }
    }
}
```
