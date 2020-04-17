### Display Labels on Top of Objects

This is especially useful when the caption is a little longer.

<p align="left">
  <img src="screenshots/labels_on_top.gif" width="408">
</p>

☛</strong>  Add this code to your form’s Javascript section</p>

```javascript
function custFieldLabelsOnTop(f, e) {

    for (var i = 0; i < f.length; i++) {
        if (jQuery.inArray(f[i], e) == -1) {

            var t = $('#' + f[i]).cssNumber("top");
            var l = $('#' + f[i]).cssNumber("left");
            $('#' + 'label_' + f[i]).css({
                'top': t - 18,
                'left': l - 15
            })
        }
    }
}

jQuery.fn.cssNumber = function(prop){
    var v = parseInt(this.css(prop),10);
    return isNaN(v) ? 0 : v;
};
```

<p><strong>Example 1</strong>: Place the labels of all fields on top of the input fields:</p>

```javascript
if (nuFormType() == 'edit') {
    var f = nuSubformObject("").fields;          // include all fields of your main form.
    custFieldLabelsOnTop(f, []);
}
```

<p><strong>Example 2</strong>: Place the labels of all fields above the input fields, but exclude some</p>

```javascript
if (nuFormType() == 'edit') {
    var f = nuSubformObject("").fields;          // include all fields of your form
    var e = ["cus_firstname", "cus_lastname"];   // but exclude these fields
    custFieldLabelsOnTop(f, e);
}
```

<p><strong>Example 3</strong>: Place the labels of some fields above the input fields</p>

```javascript
if (nuFormType() == 'edit') {
    var f = ["cus_firstname", "cus_lastname"];   // include just these two fields
    custFieldLabelsOnTop(f, []);
}
```
