### Browse Screen: Disable column resizing

To prevent users from resizing columns widths, you can use this code.
This can be useful if the form is embedded in an iframe.

☛Add this JavaScript Code to your form’s Custom Code field:


### Return to the previous Breadcrumb/Screen:

```javascript
if (nuFormType() == 'browse') {
				
   disableBrowseResize();
	
}

function disableBrowseResize() {

   $(document).ready(function(){   
    $("div[id^='nuBrowseTitle']")
        .off('mousedown.nuresizecolumn')
        .off('touchstart.nuresizecolumn')
        .off('touchmove.nuresizecolumn')
        .off('touchstart.nuresizecolumn');
   });
   
};

```

