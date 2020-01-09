### Enable the Browser’s Back Button

### nuBuilder's default behaviour
The browser’s back button doesn’t return one to the previous screen.

### Expected behaviour
Hitting the browser’s back button takes one back to the previous website page / Breadcrumb.

This will make the browser’s back button work. It will detect if the back button is clicked and take you back to the previous Breadcrumb.

☛  Add this Javascript code in the Header under Home ► Setup

```
function custGotoPrevBreadcrumb() {
 
    if (parent.$('#nuModal').length > 0) {
        nuClosePopup();
        return;
    }
 
    var l = window.nuFORM.breadcrumbs.length;
    if (l > 1) {
        nuGetBreadcrumb(l - 2);
    }
}
 
function custEnableBrowserBackButton() {
    window.history.pushState({page: 1}, "", "");
    window.onpopstate = function(event) {
      if(event){
         custGotoPrevBreadcrumb();
      }
      else{
      }
    }
}
 
function nuOnLoad() {
  custEnableBrowserBackButton();
}
```
