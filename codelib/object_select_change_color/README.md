## Select Object: Change the Background Color of the selected Option

This snippet will show you how to conditionally change the color of the selected option in reference to the displayed text.
E.g. setting a blue selection color when the selected option text is "Pending".

<p align="left">
  <img src="screenshots/select_selected_color.gif">
</p>


☛ Add this JavaScript to your form's Custom Code field:
 ❓ [How to add Custom Code](/codelib/common/form_add_custom_code_javascript.gif)

```javascript
function initChangeSelectColor(t, arr) {

    $("#" + t).change(function () {
        changeSelectColor($(this), arr);
    });
    if (!nuIsNewRecord()) {
        changeSelectColor($("#" + t), arr);
    }

}

function changeSelectColor(t, arr) {

    t.children("option").css("background", "");
    var option = t.children("option:selected");

    for (status in arr) {
        if (option.text() === status) {
            bgColor = arr[status]['bg'];
            option.css("background", "linear-gradient(0deg, " + bgColor + " 0%, " + bgColor + " 100%)");
            break;
        }
    }
}
```

#### ✪ Example

☛ Add a Select Object (E.g. with ID my_select) to your form with the following List values: New|New|Closed|Closed|Pending|Pending

```javascript
if (nuFormType() == 'edit') {

	var statusArr = {
		'New':      {'bg': '#F0B27A'},  // orange
		'Closed':   {'bg': '#58D68D'},  // green
		'Pending':  {'bg': '#85C1E9'}   // blue
	};
	initChangeSelectColor('my_select', statusArr); 
	
}
```
