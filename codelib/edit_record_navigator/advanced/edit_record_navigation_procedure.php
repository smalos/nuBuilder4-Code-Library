
$eri = json_decode(base64_decode('#EDIT_RECORD_INFO#'));
$pk = $eri->primary_key;
$action = $eri->_action;

$goto_pk = "";
$cr = "";

if ($action == 'next' || $action == 'back') {
    $t = nuRunQuery($eri->browse_sql);

    while ($r = db_fetch_object($t)) {

        if ($eri->record_id == $r->$pk) {
            if ($action == "next") {
                $r = db_fetch_object($t);
                $goto_pk = $r->$pk;
                break;
            }
            else {
                $goto_pk = $cr;
                break;
            }
        }

        $cr = $r->$pk;
    }
}

$j = " onOpenRecord('$goto_pk','$action'); ";

nuJavascriptCallback($j);
