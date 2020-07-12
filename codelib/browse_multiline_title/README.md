## Setting up multi-line column headers

Long column names are not visually appealing in one line. Also they cause a lot of horizontal empty space in the rows.
To display more than one line of text in a column header, call setBrowseMultiLine() in a Browse Screen.
The column title will automatically wrap over two lines when the width of the column is reduced.

### nuBuilder's default

<p align="left">
  <img src="screenshots/browse_title_single_line.png">
</p>

### With Multi-line

<p align="left">
  <img src="screenshots/browse_title_multi_line.png">
</p>


☛  Paste this JavaScript into your form's Custom Code field


```javascript
function setBrowseMultiLine() {

    // Increase holder height
    $('#nuActionHolder').css({'height': '40px'});
	
    // Increase title height
    $('.nuBrowseTitle').not('#nuBrowseFooter').css('top', "-20px");
	
}   

if (nuFormType() == 'browse') {
   setBrowseMultiLine();
}

```

