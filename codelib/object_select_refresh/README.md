### Select Object: Refresh on Button Click

This code snippets shows how to refresh a [Select Object](https://wiki.nubuilder.net/nubuilderforte/index.php/Objects#Form_Tab) without refreshing the whole form.
This can be useful when using Hash Cookies in the SQL and to implement cascaded dropdowns.

#### 1. Create a [Procedure](https://wiki.nubuilder.net/nubuilderforte/index.php/Procedures)  (*Tab Builders -> Procedure -> Add*):

☛ **Code**: refreshSelectObject

☛ **Description**: Refreshes a Select Object

☛ **Launch from**: Keep blank

☛ **Run**: Hidden

☛ **PHP**: Paste this PHP code:

```php
function getSelectValues($obj) {

    $sql = "SELECT sob_select_sql FROM `zzzzsys_object` WHERE sob_all_id = ?";
    $t = nuRunQuery($sql, [$obj]);

    $a = [];
    if (db_num_rows($t) == 1) {

        $r = db_fetch_row($t);
        if ($r != false) {
            $disS = nuReplaceHashVariables($r[0]);
            $t = nuRunQuery($disS);

            while ($row = db_fetch_row($t)) {
                $a[] = $row;
            }

            return json_encode($a);
        }

    }

    return $a;

}

$obj = '#refreshSelectObject#';
$j = getSelectValues($obj);

$js = "
	function populateSelectObject() {
		var p = $j;

		$('#$obj').empty();
		$('#$obj').append('<option value=\"\"></option>');

		if (p != '') {
			for (var i = 0; i < p.length; i++) {

				$('#$obj').append('<option value=\"' + p[i][0] + '\">' + p[i][1] + '</option>');
			}
		}
	}

	populateSelectObject();
";


nuJavascriptCallback($js);
```

☛ Save

#### 2. In you form's Custom Code, paste this JavaScript:

```javascript
function refreshSelectObject(obj) {
    nuSetProperty('refreshSelectObject', obj);
    nuRunPHPHidden("refreshSelectObject", 1);
}
```

☛ Save


#### 3.  Example

For example, a select object can be refreshed if this JavaScript code is added to an onchange event of another select object.
☛  Replace objId with the Object Id of your Select Object.

```javascript   
refreshSelectObject('objId');    
```
