## Select Object: How to get the text value of a selected option?

Select elements typically have two values that you want to access. 
First there's the (bound) value that is stored in the database, the second is the text (display) value of the select object. 


#### ✪ Example

As an example, this delimited list is used in the SQL field:

```
0|This is the first value|1|This is the second value
```

To access the value of the selected option, you would write:

```javascript
$( "#myselect" ).val();  // returns 0 or 1
```

If you wanted to get the string "This is the second value" if the second option was selected (instead of just "1") you would do that in the following way:

```javascript
$( "#myselect option:selected" ).text();
```


#### ✪ Bonus

If you wanted to access the selected text in PHP (eg. AS event), you could store the text value in a Hash Cookie by using nuSetProperty().

```javascript
function nuBeforeSave() {
    var t = $("#myselect option:selected").text();
    nuSetProperty('myselect_text', t);
    return true;
}
```

Then, in PHP, you would access the text value (Hash Cookie) like this:

```php
$my_selected_text = "#myselect_text#";
```


