## Browse Screen: Add Delete Buttons (DRAFT)

This will add delete buttons in a column of a Browse Screen. This allows a user to delete a row directly from the Browse Screen
without having to open the Edit Screen first.

<p align="left">
  <img src="screenshots/browse_delete_buttons.png">
</p>


☛ Add this JavaScript code to your form's _Custom Code_ field


```
function getFormId() {
    return nuCurrentProperties().form_id;
}

function nuSelectBrowse(e) {
    
    // If a delete button is clicked, don't open the Edit Screen. 
    var col = $(e.target).attr('data-nu-column');
    if (col !== '0' && typeof col !== "undefined") {
        var r = $(e.target).attr('data-nu-primary-key');
        nuForm(getFormId(), r);
    }

    return false;
}


function deleteRow(pk) {

    if (confirm(nuTranslate("Delete This Record?"))) {

        nuSetProperty('deleteRow_form_id', getFormId());
        nuSetProperty('deleteRow_record_id', pk);

        nuRunPHPHidden("deleteRow", 1);
    }

}

function afterDeleteRow() {    
    // refresh the Browse Screen after deleting a row
    nuSearchAction(1);    
}

function createDeleteButton(target, pk) {

  var btn = $('<button type="submit" style="height:21px; border: none; vertical-align: top; background-color: #d54d49; transform: translateY(-10%); color:white" value="✖">✖</button>');
  $(target).html(btn).attr('title',nuTranslate('Delete Row'));
  btn.on('click',function(){
    deleteRow(pk);
  });
  
}


function addDeleteButtons(column) {

    // Create delete buttons if row is not empty
    $("[data-nu-column='" + column + "']").each(function(index) {

        var pk = $(this).attr('data-nu-primary-key');
        if (typeof pk !== "undefined") {
            createDeleteButton(this, pk);
        }
    })

}

if (nuFormType() == 'browse') {
    // Add delete buttons in the first column 
    addDeleteButtons(0);
}
```



### Create a PHP procedure

☛ Create a Procedure: Builders -> Procedure -> Add

☛ Code: deleteRow

☛ Give it a Description

```
function getFormTableInfo($formId)    {

    $sql = "SELECT sfo_table, sfo_primary_key FROM `zzzzsys_form` WHERE `zzzzsys_form_id` = ?";
    
    $t        = nuRunQuery($sql, [$formId]);
    $r        = db_fetch_object($t);
    
    return array($r->sfo_table, $r->sfo_primary_key);
    
}


function hasDeletePermission($formId)    {

    $groupId        = $_POST['nuHash']['USER_GROUP_ID'];

    if($groupId == ''){            //-- globeadmin
        return true;
    }

    $sql = "SELECT * FROM zzzzsys_access_form WHERE slf_zzzzsys_access_id = ? AND slf_zzzzsys_form_id = ?";

    $t        = nuRunQuery($sql, [$groupId, $formId]);
    $r        = db_fetch_object($t);
    
    return $r->slf_delete_button == 1;
}    
    
function deleteRow($formId, $recordId){

    if (hasDeletePermission($formId)) {
        
        $tableInfo = getFormTableInfo($formId);
        $tableName = $tableInfo[0];
        $tablePk = $tableInfo[1];

        $qry = "DELETE FROM `$tableName` WHERE `$tablePk` = ? ";

        nuRunQuery($qry, [$recordId]);
    } else {
        nuDisplayError(nuTranslate("Delete is disabled for this Access Level"));
    }
    
}

deleteRow("#deleteRow_form_id#", "#deleteRow_record_id#");


// The function afterDeleteRow() must be declared in the form's Custom Code 
$j = "afterDeleteRow();";
nuJavascriptCallback($j);
```
