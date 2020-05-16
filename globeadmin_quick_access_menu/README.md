## Globeadmin: Add a Quick Access Menu

This *Quick Access Menu* facilitates the opening of certain forms and functions for the globeadmin no matter which page you are on.

**Advantages**
* Open phpMyAdmin, nuDebug Results, Setup etc. from everywhere.
* The forms are opened in a new tab instead of a popup.
* Open *nuDebug Results* in a new tab so it does not have to be opened and closed again and again while debugging.
* It is easy to add your own menu items.

<p align="left">
  <img src="screenshots/quickAccessMenu.gif">
</p>


☛  Add this JavaScript and CSS code in the Header (❓ [Home ► Setup](/common/setup_header.gif)). Click Save and log in again.

<details>
  <summary>Click to view the code!</summary>
  
```javascript
var quickAccessMenu = `<div class="dropdown">
  <button class="dropbtn"> ⚒ </button>
  <div class="dropdown-content">
      <a id="dropDebug" title="Debug" href="#" onclick="nuForm('nudebug','','','',2);return false;">Debug</a>
	  <a id="dropDB" title="Database" href="#" onclick="window.open('nupmalogin.php?sessid='+window.nuSESSION);return false;">Database</a>  
      <a id="dropSetup" title="Setup" href="#" onclick="nuForm('nusetup','1','','',2); return false;">Setup</a>
      <hr class="dropdown-divider">  
      <a id="dropFormCurrent" title="View Form Properties" href="#" onclick="nuForm('nuform',window.nuFORM.getCurrent().form_id,'','',2);return false;">Form Properties</a>
      <a id="dropObjectsCurrent" title="Browse Form Objects" href="#" onclick="nuForm('nuobject','',window.nuFORM.getCurrent().form_id,'',2);return false;">Form Objects</a>
      <a id="dropFormAll" title="Browse all Forms" href="#" onclick="nuForm('nuform','','','',2);return false;">All Forms</a>
      <a id="dropObjectsAll" title="Browse all Objects" href="#" onclick="nuForm('nuobject','','','',2);return false;">All Objects</a>
      <hr class="dropdown-divider">  
      <a id="dropDuplicateForm" title="Duplicate Form" href="#" onclick="duplicateForm();return false;">Duplicate Form</a>      
      <hr class="dropdown-divider">  
      <a id="dropLogout" title="Logout" href="#" onclick="nuLogout();return false;">Logout</a>
  </div>
</div>`;

function duplicateForm() {
    r = nuFormType() == 'edit' ? "-1" : "";
    nuForm(window.nuFORM.getCurrent().form_id, r, '', '', 2);
}

function create(htmlStr) {
    var df = document.createDocumentFragment()
        , temp = document.createElement('div');
    temp.innerHTML = htmlStr;
    while (temp.firstChild) {
        df.appendChild(temp.firstChild);
    }
    return df;
}

function addquickAccessMenu() {

    if (global_access) {
        var fragment = create(quickAccessMenu);
        if (window.nuFORM.breadcrumbs.length == 1) {
            var options = $('#nuBreadcrumbHolder').find("[id$=nuOptions]");
            $(fragment).insertAfter(options);
        } else {
            $(fragment).insertBefore("#nuBreadcrumb0");
        }
    }

}

function setTabTitle(prefix) {
    var t = window.nuFORM.getProperty('title');
    if (t == "") {
        t = "Properties";
    }
    prefix = (typeof prefix === "undefined") ? "" : prefix + " - ";
    //  document.title = prefix + t;
}

function nuOnLoad() {

    addquickAccessMenu();

    setTabTitle("MyCars");

}

</script>

<style>

/* Start Menu Dropdown */

.dropbtn {
    background-color: #00adef; 
    color: #FFF;
    padding: 0px;
    padding-left: 5px;
    margin-right:15px;
    font-size: 14px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;   
}

.dropdown-content {
    display: none;
    position: absolute;    
    background-color: #fefefe;
    min-width: 250px;
    box-shadow: 0 2px 3px rgba(10,10,10,.1),0 0 0 1px rgba(10,10,10,.1);
    z-index: 999;
    white-space: nowrap;
    border-radius: 4px;
}

.dropdown-content a {
    color: black;
    padding: 5px 16px;
    text-decoration: none;
    font-size: 15px;
    line-height: 1.0;
    font-family:Helvetica;
    display: block;
}

.dropdown-content a:hover {
    background-color: #3572b0;
    color: #FFF;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown-divider {
    background-color: #dbdbdb;
    border: none;
    display: block;
    height: 1px;
    margin: .5rem 0
}

.dropdown:hover .dropbtn {
    color: #d80147;
    background-color:#00adef;
}

</style>

 ```
</details>
