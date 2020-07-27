### Subform: Copy data to clipboard

This code snippet shows how to copy all data of a subform to the clipboard as tab-separated data, so you can easily paste the information into a spreadsheet (e.g. Excel) or elsewhere. 

☛Add this JavaScript Code to your form’s Custom Code field. (Or in the (Setup -> Header), if the function is used in several forms)

❓ [How to add Custom Code](/codelib/common/form_add_custom_code_javascript.gif)


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


function headerToSeparatedString(fields, delimiter, includeId) {

    var start = includeId == true ? 0 : 1;
    var h = '';

    for (var i = start; i < fields.length - 1; i++) {
        h += fields[i] + delimiter;
    }
    return h + '\n';
}

function rowToSeparatedString(rows, delimiter, includeId) {

    var processRow = function (row, includeId) {

        var finalVal = '';

        var start = includeId == true ? 0 : 1;
        for (var j = start; j < row.length - 1; j++) {
            var innerValue = row[j] === null ? '' : row[j].toString();
            if (row[j] instanceof Date) {
                innerValue = row[j].toLocaleString();
            };
            var result = innerValue.replace(/"/g, '""');
            if (result.search(/("|,|\n)/g) >= 0)
                result = '"' + result + '"';
            if (j > start)
                finalVal += delimiter;
            finalVal += result;
        }
        return finalVal + '\n';
    };

    var output = "";

    for (var i = 0; i < rows.length - 1; i++) {
        output += processRow(rows[i], includeId);
    }

    return output;
}


/**
 * Copy the data of a Subform to the Clipboard
 *
 * @param {string}  sfId                - Subform Object ID
 * @param {string}  delimiter       	- Delimiter for the data. Default: \t  (tabulator)
 * @param {bool}    [includeHeader]     - true to include the header (titles)
 * @param {bool}    [includeId]  	    - true to include the Id (Primary Key)
 *
 */

function subformToClipboard(sfId, delimiter, includeHeader, includeId) {

    var obj = nuSubformObject(sfId);

    var s = "";

    if (typeof delimiter === "undefined") {
        var delimiter = '\t';
    }

    if (typeof includeId === "undefined") {
        var includeId = false;
    }

    if (includeHeader === true) {
        s = headerToSeparatedString(obj.fields, delimiter, includeId);
    }

    s += rowToSeparatedString(obj.rows, delimiter, includeId);

    copyToClipboard(s);
}
```

#### ✪ Example

Add a button object to your form with an onclick event. Replace "subform_id" with your Subform Object ID.

```javascript
subformToClipboard('subform_id', '\t');
```
