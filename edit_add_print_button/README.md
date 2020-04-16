### Edit Screen: Add a Print Button


☛Add this JavaScript Code to your form’s Custom Code section:

```
if (nuFormType() == 'edit') {
    nuAddActionButton('nuPrintEditForm', 'Print', 'custPrintEditForm();'); 
}

// hide some elements before calling the print dialog 
function custPrintEditForm() {

  $('#nuBreadcrumbHolder').hide();
  $('#nuTabHolder').hide();
  $('.nuActionButton').hide();

  window.onafterprint = function(e){
        $(window).off('mousemove', window.onafterprint);
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
