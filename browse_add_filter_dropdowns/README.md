## Browse Screen: Add Dropdowns to Filter Columns

This snippet will show you how to add Dropdowns in Columns of a Browse Screen to filter the corresponding columns.

<p align="left">
  <img src="screenshots/browse_filter_dropdowns.gif">
</p>


☛Add this JavaScript Code to your form’s Custom Code field. (Or in the (Setup -> Header), if the function is going to be used in several forms)

<details>
  <summary>Click to view the code!</summary>
  
```javascript
// Function to add a dropdown to a title of a Browse Screen
// * @param {number} index - Column (Index), where the dropdown will be displayed
// * @param {object} data -  String array to populate the dropdown
function addBrowseTitleDropDown(index, data) {

	var dropId = "nuBrowseTitle" + index + "_dropdown";
	var list = document.createElement('select');
	list.setAttribute("id", dropId);
	
	var w = nuCurrentProperties().column_widths[index] - 10;
	list.setAttribute('style', 'width:' + w + 'px');


	for (var i = 0; i < data.length; i++) {
		var opt = document.createElement('option');
		opt.innerHTML = data[i];
		opt.value = data[i];
		list.appendChild(opt);
	}

	// append select to the browse title
	$('#nuBrowseTitle' + index).append('<br/>').append(list);

	$('#' + dropId).on('change', function(e) {
		nuSetProperty(this.id, this.value);
		nuSearchAction();
	});

	$('#nuBrowseTitle' + index).on('mousedown', '> select', function(e) {
		e.stopPropagation();
	});

	var dropValue = nuGetProperty(dropId);
	$("#" + dropId).val(dropValue);
}

function browseTitleMultiLine() {

   // Increase holder height
   $('#nuActionHolder').css({'height': '60px'});
    // Increase title height
   var t = -20;
   $('.nuBrowseTitle').not('#nuBrowseFooter').css('top',t );
}
```
</details>




### Example 1: 

Add two Dropdowns containing static values

☛Add this JavaScript Code to your form’s Custom Code field. 

```javascript
if (nuFormType() == 'browse') {

	browseTitleMultiLine();

	// Add a Dropdown in Column 1 (index 0) to filter a column with name *sob_all_type*
	var data0 = ["", "calc", "display", "html", "image", "input", "lookup", "run", "select", "subform", "textarea", "word"];
	addBrowseTitleDropDown(0, data0);

	// Add a Dropdown to Column 2 (index 1) to filter a column with name *sob_input_type*
	var data1 = ["", "button", "text", "nuDate", "nuScroll"];
	addBrowseTitleDropDown(1, data1);

}
```

Add a Where Clause in the Browse SQL:

```sql
WHERE
((sob_all_type = '#nuBrowseTitle0_dropdown#' AND LOCATE('#', '#nuBrowseTitle0_dropdown#') <> 1 )
OR '#nuBrowseTitle0_dropdown#' = '' OR LOCATE('#', '#nuBrowseTitle0_dropdown#') = 1)

AND
((sob_input_type = '#nuBrowseTitle1_dropdown#' AND LOCATE('#', '#nuBrowseTitle1_dropdown#') <> 1 )
OR '#nuBrowseTitle1_dropdown#' = '' OR LOCATE('#', '#nuBrowseTitle1_dropdown#') = 1)

```


### Example 2: 

Add a Dropdown in Column 6 (index 5) containing distinct values of that column. The values are retrieved by PHP.

☛Add this JavaScript Code to your form’s Custom Code field. 

```javascript
if (nuFormType() == 'browse') {

	browseTitleMultiLine();

	// Add a Dropdown to Column 6 (index 5) to filter a column with name *sfo_description*   
	var data5 = JSON.parse(getForms());
	addBrowseTitleDropDown(5, data5);
}
```

Add a Where Clause in the Browse SQL:

```sql
WHERE
((sfo_description = '#nuBrowseTitle5_dropdown#' AND LOCATE('#', '#nuBrowseTitle5_dropdown#') <> 1 )
OR '#nuBrowseTitle5_dropdown#' = '' OR LOCATE('#', '#nuBrowseTitle5_dropdown#') = 1)
```



☛ Add this PHP Code to your form's BB (Before Browse) field:

<details>
  <summary>Click to view the code!</summary>
  
```php
// Get a unique list with form names
function getForms() {
    $sql = "
		SELECT DISTINCT sfo_description FROM zzzzsys_object
		JOIN zzzzsys_tab ON zzzzsys_tab_id = sob_all_zzzzsys_tab_id
		JOIN zzzzsys_form ON zzzzsys_form_id = syt_zzzzsys_form_id
		WHERE sob_all_zzzzsys_form_id NOT LIKE 'nu%' ORDER BY sfo_description	
	";
    return $sql;
}

function getBase64JsonDTString($sql) {
   $result = nuRunQuery($sql);
   $a = [];
   $a[] = '';
   while ($row = db_fetch_row($result)) {
     $a[] = $row;
   }
   return base64_encode(json_encode( $a ));
}

$w = getBase64JsonDTString(getForms());


$js = "
   function getForms() {
      return atob('$w');
   }
";

nuAddJavascript($js);
```

</details>
