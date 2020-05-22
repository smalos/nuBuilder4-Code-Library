### jQuery: Applying nuBuilder functions to multiple objects

How can we apply nuHide(), nuShow(), nuDisable(), nuEnable() etc. to multiple objects?
These function take just one argument / object ID.

We can use jQuery.fn.extend to extend the jQuery prototype ($.fn) object to provide new custom methods that can be chained to the jQuery() function.

☛  Add this JavaScript the Header (❓ [Home ► Setup](/common/setup_header.gif)). Click Save and log in again.

```javascript
jQuery.fn.extend({
  nuEnable: function() {
    return this.each(function(enable) {
      nuEnable(this.id);
    });
  },
  nuDisable: function() {
    return this.each(function(enable) {
      nuDisable(this.id);
    });
  },
  nuShow: function() {
    return this.each(function(show) {
        nuShow(this.id);
    });
  }, 
  nuHide: function() {
    return this.each(function(show) {
        nuHide(this.id);
    });
  }  
});
```
### Usage

#### ✪ Example 1: Disable all text fields
```javascript
$('input[type="text"]').nuDisable();
```

#### ✪ Example 2: Disable all fields that start with ID cus_billing
```javascript
$('[id^=cus_billing]').nuDisable();
```

#### ✪ Example 3: Hide all fields that end with the ID billing
```javascript
$('[id$=billing]').nuHide();
```

#### ✪ Example 4: Disable all form elements 
```javascript
$(":input") .nuDisable();  
```

#### ✪ Example 5: Hide all <button> and <input> elements of type="button"   
```javascript
$(":input") .nuHide();  
```

#### ✪ Example 6: Enable all <div> elements that contain the text 'teacher'    
```javascript
$("div:contains('teacher')").nuEnable();
```
