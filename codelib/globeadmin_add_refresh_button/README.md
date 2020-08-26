
###  Globeadmin Helper: Add a Refresh Button

While creating and designing forms and objects, you often need to perform a refresh to see the changes. In order to make the refreshing a little easier, the function globeadminAddRefreshButton() adds a new Action Button to every Edit Screen. The Refresh Button will only be shown when the globeadmin is logged in.

☛  Add this JavaScript code in the Header (❓ [Home ► Setup](/codelib/common/setup_header.gif)). Click Save and log in again.

```javascript
function globeadminAddRefreshButton() {

    if (window.global_access && nuFormType() != 'browse') {
        nuAddActionButton('custRefreshBtn', nuTranslate('Refresh'), 'nuGetBreadcrumb()');
    }

}

function nuOnLoad() {
    globeadminAddRefreshButton();
}
```
