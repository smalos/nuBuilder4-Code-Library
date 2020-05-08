## Object: Conditionally Change the Color

This snippet will show you how to conditionally change the color of an object (e.g. Display Object) in reference to the content.
E.g. setting a red background color with a bold font if the display text is "danger".

<p align="left">
  <img src="screenshots/change_colors.png">
</p>


☛ Add this JavaScript code to your form's _Custom Code_ field


```javascript

// bg: background color, fg: foreground color, weight: font feight
var colorConditions = {
    'danger':  {'bg': 'red', 'fg': 'white', 'weight': 'bold'},
    'fine':    {'bg': 'green', 'fg': 'white', 'weight': 'normal'},
    'other':   {'bg': 'black', 'fg': 'white', 'weight': 'normal'}
};

function setConditionalColors(id, conditions) {
    obj = $('#' + id);
    for (cond in conditions) {
        if (obj.val() === cond) {
            obj.css('background-color', conditions[cond]['bg']);
            obj.css('color', conditions[cond]['fg']);
            obj.css('font-weight', conditions[cond]['weight']);
            break;
        }
    }
}
```

Example: Call the function when the edit Screen is loaded:

```javascript
if (nuFormType() == 'edit') {
   setConditionalColors('objId ', colorConditions);  // replace objId with your object id
}
```
