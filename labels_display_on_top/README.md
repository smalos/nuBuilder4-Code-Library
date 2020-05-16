### Display Labels on Top of Objects

This is especially useful when the caption is a little longer and it would take up too much space horizontally.

<p align="left">
  <img src="screenshots/labels_on_top.gif">
</p>

☛</strong>  Add this code to your form’s Javascript section</p>

❓ [How to add Custom Code](/common/form_add_custom_code_javascript.gif)

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

#### ✪ Example 1: 

Place the labels of all fields on top of the input fields:

```javascript
if (nuFormType() == 'edit') {
    var f = nuSubformObject("").fields;          // include all fields of your main form.
    custFieldLabelsOnTop(f, []);
}
```

#### ✪ Example 2</strong>: 
  
Place the labels of all fields above the input fields, but exclude some

```javascript
if (nuFormType() == 'edit') {
    var f = nuSubformObject("").fields;          // include all fields of your form
    var e = ["cus_firstname", "cus_lastname"];   // but exclude these fields
    custFieldLabelsOnTop(f, e);
}
```

#### ✪ Example 3: 

Place the labels of some fields above the input fields

```javascript
if (nuFormType() == 'edit') {
    var f = ["cus_firstname", "cus_lastname"];   // include just these two fields
    custFieldLabelsOnTop(f, []);
}
```
