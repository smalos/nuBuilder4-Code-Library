## Browse Screen: Translate data

Translate data in the specified columns into the user's language.

<p align="left">
  <img src="screenshots/translate_columns.gif">
</p>

☛  Add this JavaScript code to your form's Custom Code field:

```javascript
function translateColumns(columns) {

    $("div[id^='nucell_']").each(function(index) {

        if ($.inArray(this.getAttribute("data-nu-column"), columns)) {
            var e = $(this);
            var v = e.html();
            if (v != '') {
                e.html(nuTranslate(v));
            }
        }

    })
}	

// Call the function translateColumn() when the Browse Screen is loaded

if(nuFormType() == 'browse'){

   // to translate the 1st column
   translateColumn([0]); 
   
   // to translate the 1st,  2nd columns
   // translateColumn([0,1]); 
   
}

```
