### Object: Create a datalist

The HTML `<datalist>` tag is is used to provide an auto complete feature on form element. 
These suggested values will appear in the input control as a dropdown list and the available options will be filtered as the user enters data into the input control.
It also allows users to enter a custom value that is not in the list.

The function addDatalist() will turn a Text Input Object into a datalist Element.

☛ Add this JavaScript Code to your form’s Custom Code field:

❓ [How to add Custom Code](/common/form_add_custom_code_javascript.gif)


```javascript
/**
 * Add a datalist to a Text Input Element
 *
 * @param  {string}  f     - Object ID of the Text Input
 * @param  {array}   a     - Array of strings
 */
function addDatalist(f, a) {
    var datalist = document.createElement('datalist');
    datalist.id = "datalist";
    document.body.appendChild(datalist);
    a.forEach(function (data) {
        var option = document.createElement('option')
        option.value = data
        datalist.appendChild(option);
    });
    $('#' + f).attr('list', "datalist").attr('autocomplete', 'off');
}

```

#### ✪ Example

Add a datalist to the Text Input Object with ID *my_city*

```javascript
if (nuFormType() == 'edit') {
    var cities = ["Seattle", "Las Vegas", "New York", "Salt lake City"];
    addDatalist('my_city', cities);
}
```

