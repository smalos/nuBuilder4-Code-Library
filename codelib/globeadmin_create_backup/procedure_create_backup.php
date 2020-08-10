// *******************************************************************

// Settings. Please modify if different.

//Use nuBuilder DB settings. Path to nuconfig.php
$path_nuconfig_php = __DIR__ . '/nuconfig.php';

// Path to Mysqldump.php
$path_mysqldump_php = __DIR__ . '/libs/Mysqldump/Mysqldump.php';

// Directory to write the sql dump to
$path_sql_dump = __DIR__ . '/libs/Mysqldump/dumps/';

// *******************************************************************

try {
    require_once ($path_mysqldump_php);
} catch (Exception $e) {
    nuDisplayError('require_once failed! Error: '.$e);
}

try {
    require $path_nuconfig_php;
} catch (Exception $e) {
    nuDisplayError('require failed! Error: '.$e);
}

// Get Parameters (Hash Cookies)
$params = json_decode(base64_decode('#export_params#'));
$file_name = sanitizeFilename($params->file_name) ;

if ($params->file_prefix) {
    $file_name = date('m-d-Y_H:i:s') . '_' . $file_name;
}

$file_extension = '.sql';

$form_id = $params->form_id;
$change_ids = $params->change_ids;

$table_struct = $params->table_struct;
$table_data = $params->table_data;
$table_name = $params->table_name;
$skip_comments = $params->skip_comments;
$compression = $params->compression;

// Dump Settings
$dumpSettings = [];
$dumpSettings['single-transaction'] = false;
$dumpSettings['no-create-info'] = false;
$dumpSettings['lock-tables'] = false;
$dumpSettings['add-locks'] = false;
$dumpSettings['extended-insert'] = false;
$dumpSettings['no-autocommit'] = false;
$dumpSettings['if-not-exists'] = true;

switch($compression)
{
    case 'GZIP':  $dumpSettings['compress'] = Ifsnop\Mysqldump\Mysqldump::GZIP; $file_extension .= '.gzip'; break;
	case 'BZIP2': $dumpSettings['compress'] = Ifsnop\Mysqldump\Mysqldump::BZIP2; $file_extension .= '.bzip2'; break;
}

$dumpSettings['include-tables'][] = 'zzzzsys_form';
$dumpSettings['include-tables'][] = 'zzzzsys_object';
$dumpSettings['include-tables'][] = 'zzzzsys_browse';
$dumpSettings['include-tables'][] = 'zzzzsys_php';
$dumpSettings['include-tables'][] = 'zzzzsys_select';
$dumpSettings['include-tables'][] = 'zzzzsys_select_clause';
$dumpSettings['include-tables'][] = 'zzzzsys_tab';
$dumpSettings['include-tables'][] = 'zzzzsys_event';

if ($table_struct == '1') {
    $dumpSettings['include-tables'][] = $table_name;    
}

if ($skip_comments == '1') {
    $dumpSettings['skip-comments'][] = true;    
}

$dumper = new Ifsnop\Mysqldump\Mysqldump("mysql:host=$nuConfigDBHost;dbname=$nuConfigDBName", $nuConfigDBUser, $nuConfigDBPassword, $dumpSettings);

$GLOBALS["form_id"] = $form_id;
$GLOBALS["new_form_id"] = $change_ids == '1' ? nuID() : '';
$GLOBALS["objects_array"] = [];
$GLOBALS["lookup_array"] = [];


if ($table_data == '0') {
    $dumper->setTableLimits(array(
        $table_name => 0,
    ));
}


// Include Tables
$dumper->setTableWheres(array(
    "zzzzsys_form" => "zzzzsys_form_id = '$form_id' ",
    "zzzzsys_object" => "sob_all_zzzzsys_form_id = '$form_id' OR (sob_all_zzzzsys_form_id = 'nuuserhome' AND sob_run_zzzzsys_form_id = '$form_id') ",
    "zzzzsys_browse" => "sbr_zzzzsys_form_id = '$form_id' ",
    "zzzzsys_php" => "zzzzsys_php_id  like '$form_id%' OR sph_zzzzsys_form_id = '$form_id' OR LEFT(zzzzsys_php_id,length(zzzzsys_php_id)-3)  in (SELECT zzzzsys_object_id FROM `zzzzsys_object` WHERE sob_all_zzzzsys_form_id = '$form_id')  ",
    "zzzzsys_select" => "zzzzsys_select_id  like '$form_id%' ",
    "zzzzsys_select_clause" => "ssc_zzzzsys_select_id  like '$form_id%' ",
    "zzzzsys_tab" => "syt_zzzzsys_form_id  = '$form_id' ",
    "zzzzsys_event" => "sev_zzzzsys_object_id in (SELECT zzzzsys_object_id FROM zzzzsys_object where sob_all_zzzzsys_form_id = '$form_id') "
));

if ($change_ids == '1') {
    // Include only rows that are related to our form
    $dumper->setTransformTableRowHook(function ($tableName, array $row) {

        $form_id = $GLOBALS["form_id"];
        $new_form_id = $GLOBALS["new_form_id"];

        if ($tableName === 'zzzzsys_form') {
            $row['zzzzsys_form_id'] = $new_form_id;
            $row['sfo_code'] = $new_form_id;
        }
        else if ($tableName === 'zzzzsys_object') {
            $row['sob_all_zzzzsys_form_id'] = $new_form_id;

            $id = nuID();
            array_push($GLOBALS["objects_array"], array(
                $row['zzzzsys_object_id'] => $id
            ));
            $row['zzzzsys_object_id'] = $id;
        }
        else if ($tableName === 'zzzzsys_browse') {
            $row['sbr_zzzzsys_form_id'] = $new_form_id;
            $row['zzzzsys_browse_id'] = nuID();
        }
        else if ($tableName === 'zzzzsys_php') {
            $row['zzzzsys_php_id'] = str_replace($form_id, $new_form_id, $row['zzzzsys_php_id']);
            $row['sph_zzzzsys_form_id'] = str_replace($form_id, $new_form_id, $row['sph_zzzzsys_form_id']);
            $row['sph_code'] = str_replace($form_id, $new_form_id, $row['sph_code']);
        }
        else if ($tableName === 'zzzzsys_select') {
            $row['zzzzsys_select_id'] = str_replace($form_id, $new_form_id, $row['zzzzsys_select_id']);
        }
        else if ($tableName === 'zzzzsys_select_clause') {
            $row['ssc_zzzzsys_select_id'] = str_replace($form_id, $new_form_id, $row['ssc_zzzzsys_select_id']);
            $row['zzzzsys_select_clause_id'] = nuID();
        }
        else if ($tableName === 'zzzzsys_tab') {
            $row['syt_zzzzsys_form_id'] = $new_form_id;
            $row['zzzzsys_tab_id'] = nuID();
        }
        else if ($tableName === 'zzzzsys_event') {
            $row['zzzzsys_event_id'] = nuID();
            $row['sev_zzzzsys_object_id'] = getNewObjectId($row['sev_zzzzsys_object_id']);
        }

        return $row;
    });
}


$file_name .= $file_extension;
$dump_file = $path_sql_dump . $file_name;

// Start the dump
try {
    
    if (!is_dir($path_sql_dump))
    {
        mkdir($path_sql_dump, 0755);
    }
    
    $dumper->start($dump_file);
}
catch(\Exception $e) {
    nuDisplayError('Export Error: ' . $e->getMessage());
}

$path_sql_dump = base64_encode($path_sql_dump);

$js = "

    if(window.exportCompleted){
        exportCompleted(atob('$path_sql_dump'),'$file_name');
    } else
    {
        nuMessage(['<h2>Export completed!</h2><br>SQL Dump saved in $dump_file']);
    }

";

nuJavascriptCallback($js);

function sanitizeFilename($file) {
    $file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $file);
    return mb_ereg_replace("([\.]{2,})", '', $file);
}

function getNewObjectId($oldId) {
    foreach ($GLOBALS["objects_array"] as $key => $value) {
        if ($key = $oldId) return $value;
    }
}