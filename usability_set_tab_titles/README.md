###  Usability: Set individual tab titles

Having multiple tabs open with the same titles makes it hard to find the right tab when you need it, and jumping from tab to tab is hardly a productive activity
This code will set a tab title for each tab.

<p align="left">
  <img src="screenshots/setting_tabs_titles.png" >
</p>

☛  Add this JavaScript code in the Header under Home ► Setup. Click Save and log in again.

```javascript

/**
 * Set individual tab titles
 *
 * @param {string}  [prefix]   - Optional tab prefix
 */
function setTabTitle(prefix) {
    var t = window.nuFORM.getProperty('title');
    if (t == "") {
        t = "Properties";
    }
    prefix = (typeof prefix === "undefined") ? "" : prefix + " - ";
  //  document.title = prefix + t;
}    

function nuOnLoad() {
    setTabTitle("MyCars");   
}
```
