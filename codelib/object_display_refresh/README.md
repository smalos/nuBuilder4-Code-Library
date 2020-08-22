### Refresh a Display Object on button click

This code snippets shows how to refresh a [Display Object](https://wiki.nubuilder.net/nubuilderforte/index.php/Objects#Form_Tab) without refreshing the whole form.

#### 1. Create a [Procedure](https://wiki.nubuilder.net/nubuilderforte/index.php/Procedures)  (*Tab Builders -> Procedure -> Add*):

☛ **Code**: refreshDisplayObject

☛ **Description**: Refreshes a Display Object

☛ **PHP**: Paste this PHP code:

```php
function getDisplayValue($obj) {

    $sql = "SELECT sob_display_sql FROM `zzzzsys_object` WHERE sob_all_id = ?";
    $t = nuRunQuery($sql, [$obj]);

    if (db_num_rows($t) == 1) {
        $r = db_fetch_row($t);
        if ($r != false) {

            $disS = nuReplaceHashVariables($r[0]);
            $disT = nuRunQuery($disS);
            $disR = db_fetch_row($disT);

            return ($disR != false) ? $disR[0] : false;
        }
    }

    return false;
}

$obj = '#refreshDisplayObject#';
$value = getDisplayValue($obj);
if ($value == false) {
    $j = "nuMessage([nuTranslate('Failed to refresh the Display Object: ') + '$obj']); ";
} else {
    $j = "$('#$obj').val('$value').change();";
}

nuJavascriptCallback($j);
```

☛ Save

#### 2. In you form's Custom Code, paste this JavaScript:

```javascript
function refreshDisplayObject(obj) {
    nuSetProperty('refreshDisplayObject', obj);
    nuRunPHPHidden("refreshDisplayObject", 1);
}
```

☛ Save


#### 3.  Example

For example, a display object can be refreshed if this JavaScript code is added to a button's onclick event:
☛  Replace objId with your Display's Object Id.

```javascript   
refreshDisplayObject('objId');
```
