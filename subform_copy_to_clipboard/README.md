### Subform: Copy data to clipboard

This code snippet shows how to copy subform data to clipboard.

☛Add this JavaScript Code to your form’s Custom Code field:


```javascript
var copyToClipboard = str => {
    const el = document.createElement('textarea');
    el.value = str;
    el.setAttribute('readonly', '');
    el.style.position = 'absolute';
    el.style.left = '-9999px';
    document.body.appendChild(el);
    const selected =
        document.getSelection().rangeCount > 0 ? document.getSelection().getRangeAt(0) : false;
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
    if (selected) {
        document.getSelection().removeAllRanges();
        document.getSelection().addRange(selected);
    }
};


function headerToSeparatedString(fields, delimiter) {
    var h = '';
    for (var i = 0; i < fields.length - 1; i++) {
        h += fields[i] + delimiter;
    }
    return h + '\n';
}

function rowToSeparatedString(rows, delimiter) {

    var processRow = function (row) {
        var finalVal = '';
        for (var j = 0; j < row.length - 1; j++) {
            var innerValue = row[j] === null ? '' : row[j].toString();
            if (row[j] instanceof Date) {
                innerValue = row[j].toLocaleString();
            };
            var result = innerValue.replace(/"/g, '""');
            if (result.search(/("|,|\n)/g) >= 0)
                result = '"' + result + '"';
            if (j > 0)
                finalVal += delimiter;
            finalVal += result;
        }
        return finalVal + '\n';
    };

    var output = "";

    for (var i = 0; i < rows.length - 1; i++) {
        output += processRow(rows[i]);
    }

    return output;
}


function subGridToClipboard(sfId, delimiter, includHeader) {

    var obj = nuSubformObject(sfId);
    var separatedString = headerToSeparatedString(obj.fields, delimiter);

	if (includHeader === true) {
		separatedString += rowToSeparatedString(obj.rows, delimiter);
	}
    copyToClipboard(separatedString);
}
```

#### ✪ Example

Add a button object to your form with an onclick event. Replace "subform_id" with your Subform Object ID.

```javascript
subGridToClipboard('subform_id', '\t', true);
```
