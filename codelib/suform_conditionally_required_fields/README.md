## Subform: Make a Conditionally Required Field

How to make a subform field required based on another field's value?

#### ✪ Example:

A Subform contains select fields with IDs "status" and "reason". 
If the value "done" is selected from the "status" select then the "reason" field is required. 

In this example, we are using server side validation because JavaScript validations are not secure.


☛ Add this PHP Code to your form's BS (Before Save) field:


```php

// Get Hash Cookies: Replace with your field Object IDs.
$sfId = "my_subform_id"; // subform object id
$field1 = "#status#"; // field 1
$field2 = "#reason#"; // field 2
if (checkConditionalMandatory($sfId, $field1, $field2, 'done') > 0) {
    nuDisplayError('Field Reason ' . nuTranslate('cannot be left blank'));
}

function checkConditionalMandatory($sfId, $field1, $field2, $value1) {

    $sf = nuSubformObject($sfId);

    $col1 = array_search($field1, $sf->fields);
    $col2 = array_search($field1, $sf->fields);

    $r = 0;
    for ($i = 0;$i < count($sf->rows);$i++) {

        $v1 = $sf->rows[$i][$col1];
        $v2 = $sf->rows[$i][$col2];

        $notDeleted = $sf->deleted[$i] == 0;

        if ($notDeleted && $v1 == $value1 && trim($v2) == '') {
            $r++;
        }
    }

    return $r;

}
```
