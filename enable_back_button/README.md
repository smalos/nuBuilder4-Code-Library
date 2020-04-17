## Enable the Browser’s Back Button

### nuBuilder's default behaviour
The browser’s back button doesn’t take one to the previous screen.

### Expected behaviour
Hitting the browser’s back button takes one back to the previous website page / nuBuilder Breadcrumb.

This will make the browser’s back button work. It will detect if the back button is clicked and take you back to the previous Breadcrumb.

☛  Add this JavaScript code in the Header under Home ► Setup. Click Save and log in again.

```javascript
function gotoPreviousBreadcrumb() {
    
    / If a popup is open, close it
    if (parent.$('#nuModal').length > 0) {
        nuClosePopup();
        return;
    }
 
    var l = window.nuFORM.breadcrumbs.length;
    if (l > 1) {
        nuGetBreadcrumb(l - 2);
    }
}
 
function enableBrowserBackButton() {
    window.history.pushState({page: 1}, "", "");
    window.onpopstate = function(event) {
      if(event){
         gotoPreviousBreadcrumb();
      }
      else{
        // do nothing
      }
    }
}
 
function nuOnLoad() {
  enableBrowserBackButton();
}
```
