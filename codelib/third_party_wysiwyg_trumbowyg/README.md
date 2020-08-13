## Third party: How to include a WYSIWYG Editor

This article is going to show you how to include the [Trumbowyg](http://alex-d.github.io/Trumbowyg/) WYSIWYG editor in nuBuilder.

Trumbowyg.js is a lightweight, customizable, extendable, semantic, cross-browser and jQuery based HTML5 WYSIWYG rich text editor for modern web/mobile applications.

<p align="left">
  <img src="screenshots/trumbowyg.png">
</p>



1. Download Trumbowyg from https://codeload.github.com/Alex-D/Trumbowyg/zip/master

2. Unzip the archive. and place the contents of the subfolder \dist in a new subdirectory (e.g. "libs\trumbowyg") of your nuBuilder installation (Only files in the dist directory are required)


<p align="left">
  <img src="screenshots/unzip.png">
</p>



3. ☛  Add this code in the Header (❓ [Home ► Setup](/codelib/common/setup_header.gif)). Click Save and log in again.


<p align="left">
  <img src="screenshots/header.png">
</p>


<details>
 <summary>Click to view the code!</summary>
  
```javascript
</script>

<link rel="stylesheet" href="libs/trumbowyg/ui/trumbowyg.min.css">

<script src="libs/trumbowyg/trumbowyg.min.js"></script>

<script>
```
</details>



If you want to see it in action right away, import the [sample](sample/2020-08-13_013904_trumbowyg_sample.zip) into your existing nuBuilder database. 

❓ [Instructions to import the sample](/codelib/common/import_sample_sql_file.md) 

Otherwise continue with the steps below:


4. In your form, create a new object of type HTML. Any object ID can be entered.

   ☛  Add this code in the HTML field (HTML tab).
   
```html   
<style>
li {
    display: list-item;
}
</style>

<div id="cus_notes_tr" placeholder="Placeholder here..." style="background:white"></div>
```

The DIV *cus_notes_tr* is going to be converted into a WYSIWYG editor as soon as your form loads (Step 6)

5. Create a Textarea object with (e.g.) the ID *cus_notes*. Set its access to Hidden.
   
   Also create this column in your table (Type text)
   
     
6. Add this JavaScript to your form's Custom Code field
   ❓ [How to add Custom Code](/codelib/common/form_add_custom_code_javascript.gif)

<details>
  <summary>Click to view the code!</summary>

```javascript

if (nuFormType() == 'edit') {

    // init the trumbowyg plugin
    $("div[id='cus_notes_tr']").trumbowyg({
        btns: [
            ['viewHTML']
            , ['undo', 'redo']
            , ['formatting']
            , ['strong', 'em', 'del']
            , ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull']
            , ['unorderedList', 'orderedList']
            , ['horizontalRule']
            , ['removeformat']
            , ['fullscreen']
        ]
        , semantic: false
        , resetCss: true
        , removeformatPasted: false
    });

    $('.trumbowyg-button-pane').css('z-index', '1');

    // Get the html code of the nuBuilder object and assign it to the trumbowyg editor
    var html = $('#cus_notes').val();
    $('#cus_notes_tr').trumbowyg('html', html);
}

function nuBeforeSave() {

    // Get the html code of the trumbowyg editor and assign it to the nuBuilder object
    var html = $('#cus_notes_tr').trumbowyg('html');
    $('#cus_notes').val(html).change();
    return true;

}
```
</details>

#### Useful links:

* http://alex-d.github.io/Trumbowyg/documentation/
* https://www.jqueryscript.net/text/Lightweight-HTML5-WYSIWYG-Editor-Plugin-jQuery-Trumbowyg-js.html
