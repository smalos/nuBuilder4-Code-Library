## JavaScript: Sanitize a filename

The sanitizeFileName() function returns a filename which replaced invalid character(s). 

```javascript
// Credits: https://github.com/parshap/node-sanitize-filename/blob/master/index.js#L33-L47
function sanitizeFileName(obj) {

	var illegalRe = /[\?<>:\*\|":]/g;
	var controlRe = /[\x00-\x1f\x80-\x9f]/g;
	var reservedRe = /^\.+$/;
	var windowsReservedRe = /^(con|prn|aux|nul|com[0-9]|lpt[0-9])(\..*)?$/i;
	var windowsTrailingRe = /[\. ]+$/;

	return obj
		.replace(/\//g, "\\")
		.replace(illegalRe, "")
		.replace(controlRe, "")
		.replace(reservedRe, "")
		.replace(windowsReservedRe, "")
		.replace(windowsTrailingRe, "").trim();
}
```

#### ✪ Example: 

Add an *onblur* event to a Text Object to call onFileNameBlur(event) when the object loses focus:

```javascript
ffunction onFileNameBlur(event) {
    var o = $('#' + event.target.id);	
	var n = sanitizeFileName(o.val());
	if (o.val() !== n) {
		o.val(n).change();
	}
}
```
