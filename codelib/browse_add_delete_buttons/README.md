## Browse Screen: Add Delete Buttons

This snippet will show you how to add delete buttons in each row of a Browse Column. 
This allows a user to delete records directly from the Browse Screen without having to open the Edit Screen first.

<p align="left">
  <img src="screenshots/delete_row_demo.gif">
</p>

The following steps are carried out:

1) JavaScript: Add delete buttons to each row of a Browse Screen.
2) JavaScript: On clicking a delete button, a PHP procedure is executed.
3) PHP Procedure: Checks if the user has the delete permission for the form.
4) PHP Procedure: Delete the record.
5) PHP Procedure: Call the JavaScript function afterDeleteRow()
5) JavaScript afterDeleteRow() function: Refresh the Browse Screen

<p align="left">
  <img src="screenshots/browse_delete_buttons.png">
</p>


☛ Add this JavaScript code to your form's _Custom Code_ field.

❓ [How to add Custom Code](/codelib/common/form_add_custom_code_javascript.gif)

<details>
  <summary>Click to view the code!</summary>
  
  ```javascript
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

   // Call the PHP procedure deleteRow if the confirm dialog is accepted
   
   if (confirm(nuTranslate("Delete This Record?"))) {
        
        // Set hash cookies: form id and record id. They will be used in the PHP procedure.
        nuSetProperty('deleteRow_form_id', getFormId());
        nuSetProperty('deleteRow_record_id', pk);

        nuRunPHPHidden("deleteRow", 1);
    }

}

// This function is called after a successful delete operation.
function afterDeleteRow() {    
    // Refresh the Browse Screen
    nuSearchAction();    
}

// Creates a new button and assigns click event
function createDeleteButton(target, pk) {

  var btn = $('<button type="submit" style="height:21px; border: none; vertical-align: top; background-color: #d54d49; transform: translateY(-10%); color:white" value="✖">✖</button>');
  $(target).html(btn).attr('title',nuTranslate('Delete Row'));
  btn.on('click',function(){
    deleteRow(pk);
  });
  
}

function addDeleteButtons(column) {
    
    $("[data-nu-column='" + column + "']").each(function(index) {

        // Create delete buttons if the row is not empty / primary key attribute exists
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
</details>


### Create a PHP procedure

☛ Create a [Procedure](https://wiki.nubuilder.net/nubuilderforte/index.php/Procedures): Tab Builders -> Procedure -> Add

<p align="left">
  <img src="screenshots/procedure_deleteRow.png">
</p>

☛ Code: deleteRow

☛ Enter a *Description*

☛ Add this code to the PHP field:


<details>
  <summary>Click to view the code!</summary>
  
  ```php
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
        
        // The function afterDeleteRow() must be declared in the form's Custom Code 
        $j = "afterDeleteRow();";
        nuJavascriptCallback($j);

    } else {
        nuDisplayError(nuTranslate("Delete is disabled for this Access Level"));
    }
    
}

deleteRow("#deleteRow_form_id#", "#deleteRow_record_id#");
  ```
</details>
