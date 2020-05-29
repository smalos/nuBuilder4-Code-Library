### Hide a Column in a Browse Screen

This code snippet shows how to hide a column in a Browse Screen. 
Possible applications are, for example, if columns should not be displayed for certain access levels or if the object is displayed in an iFrame and you do not want to show one or more columns.

The function setBrowseColumnSize(), as its name says, also allows to resize columns.

☛ In you form's Custom Code, paste this JavaScript (❓ [How to add Custom Code](/common/form_add_custom_code_javascript.gif))

```javascript
function iniFrame() {
    return window.location !== window.parent.location;
}

 * Set the column size of a Browse Screen
 *
 * @param  {int}  column     - Column number (first column = 0, second column = 1 etc.)
 * @param  {int}  size       - Size in pixels
 */
function setBrowseColumnSize(column, size) {
    var cw = this;
    if (iniFrame()) {
        cw = parent.$("#" + window.frameElement.id)[0].contentWindow;
    }
    cw.nuFORM.breadcrumbs[cw.nuFORM.breadcrumbs.length - 1].column_widths[column] = size;
    cw.nuSetBrowserColumns(cw.nuFORM.breadcrumbs[cw.nuFORM.breadcrumbs.length - 1].column_widths)
}

// Example, Hide the first column by setting it column width to 0.
$(function () {
    setBrowseColumnSize(0, 0);
});
```
