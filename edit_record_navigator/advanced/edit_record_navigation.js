// #region Record Navigation

/**
 * Calls a Procedure named get_edit_record that retrieves the previous/next record
 * @param  {string}  action   - either "back" or "next"
 **/
function openEditRecord(action) {

    if (!nuIsSaved()) {
        nuMessage([nuTranslate('The changes must first be saved before you can navigate to another record.')]);
        nuDisable('btnback');
        nuDisable('btnnext');
        return;
    }

    // Set a Hash Cookie that is passed to the PHP Procedure
    var browseSQL = nuFORM.breadcrumbs[nuFORM.breadcrumbs.length - 2].browse_sql;
    var eri = {
        browse_sql: browseSQL,
        primary_key: nuSERVERRESPONSE.primary_key,
        record_id: nuCurrentProperties().record_id,
        _action: action
    };

    nuSetProperty('EDIT_RECORD_INFO', base64encode(JSON.stringify(eri)));
    nuRunPHPHidden('get_edit_record', 1);
}

function base64encode(str) {
    let encode = encodeURIComponent(str).replace(/%([a-f0-9]{2})/gi, (m, $1) => String.fromCharCode(parseInt($1, 16)))
    return btoa(encode)
}

// Add Back and Next Action Buttons in an Edit Screen
function addNavigationButtons(captionBack = 'Back', captionNext = 'Next') {

    if (nuFormType() == 'edit' && !nuIsNewRecord()) {

        var browseSQL = nuFORM.breadcrumbs[nuFORM.breadcrumbs.length - 2].browse_sql;
        if (browseSQL !== null && !browseSQL.includes('___nu')) {

            $('#nuActionHolder').append("<button id='btnback' type='button' class='nuActionButton'  onclick='openEditRecord(\"back\")'><i class='fa fa-step-backward'></i>&nbsp;" + nuTranslate(captionBack) + "</button>");

            $('#nuActionHolder').append("<button id='btnnext' type='button' class='nuActionButton'  onclick='openEditRecord(\"next\")'>" + nuTranslate(captionNext) + "&nbsp;<i class='fa fa-step-forward'></i></button>");

        }
    }
}

// This function is called from the PHP Procedure get_edit_record and returns 
// the primary key (pk) to be opened and the action (back or next)
function onOpenRecord(pk, action) {
    pk !== '' ? nuForm(nuGetProperty('form_id'), pk, '', '', '1') : nuDisable('btn' + action);    
}

// #endregion Record Navigation