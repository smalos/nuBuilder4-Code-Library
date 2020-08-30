## Browse Screen: Improve the Browse Navigator

The functionaddBrowseAdditionalNavButtons() will add two additional icons in the record navigator of any Browse Screen: 

* "Go to the first record" 
* "Go to the last record"

In addition, this will also disable the Previous and Next buttons on the record navigator if you are at the beginning or end of a page.

<p align="left">
  <img src="screenshots/improve_navigator.gif">
</p>

☛  Add this JavaScript code in the Header (❓ [Home ► Setup](/codelib/common/setup_header.gif)).  Save the changes and log in again.

```javascript
function addBrowseAdditionalNavButtons() {
    
    if (nuFormType() == 'browse') {

        var disabled = {
            'opacity': '0.3',
            'pointer-events': 'none'
        };

        var currentPage = Number($('#browsePage').val());
        var lastPage = nuCurrentProperties().pages;

        var html = '<span id="nuFirst" class="nuBrowsePage"><i class="fa fa-step-backward" onclick="nuGetPage(0)">&nbsp;&nbsp;&nbsp;&nbsp;</i></span>';
        $(html).insertBefore("#nuLast");

        html = '<span id="nuEnd" class="nuBrowsePage">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-step-forward ml-5 mr-5" onclick="nuGetPage(' + lastPage + ')"></i></span>';
        $(html).insertAfter("#nuNext");


        if (currentPage == 1) {
            $('#nuFirst').css(disabled);
            $('#nuLast').css(disabled);
        }

        if (currentPage == lastPage) {
            $('#nuNext').css(disabled);
            $('#nuEnd').css(disabled);
        }
    }

}
```

Call the function addBrowseAdditionalNavButtons() in  nuOnLoad()

```javascript
function nuOnLoad() {
   addBrowseAdditionalNavButtons();
}
```
