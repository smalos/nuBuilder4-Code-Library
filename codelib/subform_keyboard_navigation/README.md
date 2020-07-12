###  Subform: Enable keyboard navigation

The function initShortcutHandler() enables the Up and Down Arrow keys to be used to navigate quickly from one row to another without having to move your mouse at all!

<p align="left">
  <img src="screenshots/keyboard_navigation.gif">
</p>

☛  Add this JavaScript code in the Header (❓ [Home ► Setup](/common/setup_header.gif)). Click Save and log in again.

```javascript
function subformMoveFocus(i) {

    var ae = $(document.activeElement);
    var p = ae.parent().parent();

    var result = p.hasClass('nuSubformScrollDiv') == true && !ae.is("textarea") && !ae.hasClass('nuScroll');
    if (result) {
    
        var row = ae.attr('data-nu-prefix').slice(-3);
        $('#' + ae.attr('data-nu-form') + nuPad3(Number(row) + i) + ae.attr('id').substr(ae.attr('data-nu-form').length + 3)).focus();
    }
    return result;
}

function initShortcutHandler() {

    document.onkeydown = function(e) {

        if (nuFormType() == 'edit') {

            e = e || window.event;
            var keyCode = e.keyCode || e.which,
                keys = { up: 38, down: 40 };

            var result = false;
            switch (keyCode) {
                case keys.up:
                    result = subformMoveFocus(-1);
                    break;
                case keys.down:
                    result = subformMoveFocus(1);
                    break;
                default:
                    return;
            }
            
            if (result) e.preventDefault();

        }
    }
}

function nuOnLoad() {

    $(function() {
    	initShortcutHandler();
    });
}
```
