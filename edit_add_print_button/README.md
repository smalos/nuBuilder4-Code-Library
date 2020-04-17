### Edit Screen: Add a Print Button


☛Add this JavaScript Code to your form’s Custom Code field:


```javascript
if (nuFormType() == 'edit') {
    nuAddActionButton('nuPrintEditForm', 'Print', 'custPrintEditForm();'); 
}


function custPrintEditForm() {

 // hide some elements before calling the print dialog 
  $('#nuBreadcrumbHolder').hide();
  $('#nuTabHolder').hide();
  $('.nuActionButton').hide();

  window.onafterprint = function(e){
        $(window).off('mousemove', window.onafterprint);
        
        // Show the elements again when the dialog closes
        $('#nuBreadcrumbHolder').show();
        $('#nuTabHolder').show();
        $('.nuActionButton').show();
    };

    window.print();

    setTimeout(function(){
        $(window).one('mousemove', window.onafterprint);
    }, 1);
}
```
