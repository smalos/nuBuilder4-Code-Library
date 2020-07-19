## JavaScript: Get the current Date (and Time)

### Get the current date (Format: YYYY-MM-DD)

```javascript
function getCurrentDate() {
    var d = new Date();
    var df = d.getFullYear() + '-' + nuPad2(d.getMonth() + 1) + '-' + nuPad2(d.getDate());
    return df;
}
```
#### ✪ Example: 
getCurrentDate() returns a date value like 2020-07-19


### Get the current date and time (Format: YYYY-MM-DD hh:mm:ss)

```javascript
function getCurrentDateTime() {
    var d = new Date();
    var df =
        d.getFullYear() + '-' +
        nuPad2(d.getMonth() + 1) + '-' +
        nuPad2(d.getDate()) + ' ' +
        nuPad2(d.getHours()) + ':' +
        nuPad2(d.getMinutes()) + ':' +
        nuPad2(d.getSeconds());
    return df;
}
```

#### ✪ Example: 
getCurrentDateTime() returns a date/time value like 2020-07-19 15:04:24
