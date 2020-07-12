## Globeadmin Helper: An easy way to set the Column Widths in a Browse Screen.

It is relatively tedious to set the column widths in a browse screen. In principle, you guess the column width and then set the values.
This helper provides an easier solution: Use the mouse to set the column widths, then call the dialog "Form Properties" and click on the link "Width". 
Now all column widths are automatically applied.

<p align="left">
  <img src="screenshots/setbrowsecolumnwidths.gif">
</p>

☛  Add this JavaScript in the Header (❓ [Home ► Setup](/common/setup_header.gif)). Click Save and log in again.
  
```javascript
function setBrowseColumnWidths() {
    if (confirm("Copy Column Widths from the Browse Table (Overwrite existing values)?")) {

        var sf = nuSubformObject('zzzzsys_browse_sf');
        for (var i = 0; i < sf.rows.length; i++) {

            if (sf.deleted[i] == 0) {
                var c = $("div[id='nuBrowseTitle" + i + "']", window.parent.document);
                var w = Math.ceil(roundNearest(parseFloat(c[0].style.width), 5)).toString();
                $('#' + 'zzzzsys_browse_sf' + nuPad3(i) + 'sbr_width').val(w.replace('px', '')).change();
            }

        }
    }

}

function roundNearest(n, v) {
    n = n / v;
    n = Math.round(n) * v;
    return n;
}

function initSetBrowseWidthHelper() {
    var p = nuCurrentProperties();
    if ((p.form_id == 'nuform' && p.form_type == 'browseedit')) {
        if (window.location != window.parent.location) {

            // Add href Link that calls setBrowseColumnWidths()
            var w = $('#title_zzzzsys_browse_sfsbr_width');

            if (w.length == 1) {
                w.css({
                    "text-decoration": "underline",
                    "text-decoration-style": "dashed",
                    "color": "blue"
                });

                w.prop('onclick', null).off('click');
                w.click(function (e) {
                    setBrowseColumnWidths();
                });
            }
        }
    }
} 

function nuOnLoad() {

    initSetBrowseWidthHelper();

}
```
