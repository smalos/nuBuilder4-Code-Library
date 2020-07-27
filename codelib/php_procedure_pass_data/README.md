### PHP: How to pass data to a PHP Procedure

nuRunPHPHidden() runs a [Procedure](https://wiki.nubuilder.net/nubuilderforte/index.php/Procedures) on the server that contains PHP code.
To pass data to the procedure, use nuSetProperty(). This sets the current Form's property and is retrieved as a [Hash Cookie](https://wiki.nubuilder.net/nubuilderforte/index.php/Hash_Cookies) when the Procedure runs.

1. First, create a [Procedure](https://wiki.nubuilder.net/nubuilderforte/index.php/Procedures): *Tab Builders -> Procedure -> Add* if you don't have one at hand.

2. Code: e.g. Procedure_Test

3. Description: Enter a description for the procedure (E.g. Testing )

4. Paste this PHP code

```php

// Retrieve a single hash cookie (see Example 1)
$param = "#param#"; // 'test single parameter'

// Retrieve a hash cookie that contains multiple data (see Example 2)
$params = json_decode(base64_decode('#params#'));

$info1 = $params->info1; // 'a'
$info2 = $params->info2; // 'b'
$info3 = $params->info3; // 'c'
```

5. Save

6. Add this JavaScript Code to your form’s *Custom Code* field:

❓ [How to add Custom Code](/codelib/common/form_add_custom_code_javascript.gif)

```javascript
function base64encode(str) {
	let encode = encodeURIComponent(str).replace(/%([a-f0-9]{2})/gi, (m, $1) => String.fromCharCode(parseInt($1, 16)))
	return btoa(encode)
}

function runPHPHiddenWithParams(procedure, params) {
	nuSetProperty('params', base64encode(JSON.stringify(params)));
	nuRunPHPHidden(procedure, 1);
}

```

### Example 1: Passing a single value

Create a Button with a custom click event to run the Procedure *Procedure_Test*.
At the same time the property *param* with value *'test single parameter'* is set.

```javascript
nuSetProperty('param', 'test single parameter'); nuRunPHPHidden('Procedure_Test', 1);
```

### Example 2: Passing multiple data

Create a Button with a custom click event to run the Procedure *Procedure_Test*.
Multiple "parameters" are passed to the Procedure.


```javascript
runPHPHiddenWithParams('Procedure_Test', {info1: 'a', info2: 'b', info3: 'c'});
```
