## JavaScript: Add Days to a Date

Extend the Date object with a new method addDays()
```javascript
Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}
```

#### ✪ Example: 

Create a new date
```javascript
myDate = new Date();
console.log(myDate); 
```

Create a new date in future based on the first date
```javascript
var dateInFiveDays = myDate.addDays(5);
console.log(dateInFiveDays); 
```


#### ⓘ Note:   

This method can also used to subtract a number of days from a date. Just pass a negative value to the method.
