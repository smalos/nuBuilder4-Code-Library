### Object: Show a tooltip on hover 

A tooltip is often used to specify extra information about something when the user moves the mouse pointer over an object.


☛ Add this JavaScript Code to your form’s Custom Code field:

❓ [How to add Custom Code](/common/form_add_custom_code_javascript.gif)


```javascript

/**
* Show tooltip on object hover.
*
* @param  {string}  id           - Object ID
* @param  {string}  message      - Message to show on object hover
* @param  {boolean} [labelHover] - true = show message also on label hover
*/
function showTooltip(id, message, labelHover) {

    // Show tooltip on object hover
    $("#" + id).hover(function() {
        $(this).attr("title", message);
    });

    if (labelHover === true) {
        // Show tooltip on label hover
        $("#label_" + id).hover(function() {
            $(this).attr("title", message);
        });
    }
}
```

#### ✪ Example


```javascript
if (nuFormType() == 'edit') {
  showTooltip("my_object_id", "Show some additional information!", true);
}  
```

