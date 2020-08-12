// *******************************************************************

// Settings. Please modify if different.

//Use nuBuilder DB settings. Path to nuconfig.php
$path_nuconfig_php = __DIR__ . '/nuconfig.php';

// Path to Mysqldump.php
$path_mysqldump_php = __DIR__ . '/libs/Mysqldump/Mysqldump.php';

// Directory to write the sql dump to
$path_sql_dump = __DIR__ . '/libs/Mysqldump/dumps/';

// Save dump to file:
$file_name =  date('m-d-Y_H:i:s') . '_' . 'nuBuilder_backup' . '.sql.gzip';

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

// Dump Settings
$dumpSettings = [];
$dumpSettings['single-transaction'] = false;
$dumpSettings['no-create-info'] = false;
$dumpSettings['lock-tables'] = false;
$dumpSettings['add-locks'] = false;
$dumpSettings['extended-insert'] = false;
$dumpSettings['compress'] = Ifsnop\Mysqldump\Mysqldump::GZIP;

// Create Mysqldump
$dumper = new Ifsnop\Mysqldump\Mysqldump("mysql:host=$nuConfigDBHost;dbname=$nuConfigDBName", $nuConfigDBUser, $nuConfigDBPassword, $dumpSettings);

$dump_file = $path_sql_dump . sanitizeFilename($file_name);

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

$dump_file = base64_encode($path_sql_dump . $file_name);

$js = "
   nuMessage(['<h2>Export completed!</h2><br>SQL Dump saved in ' + atob('$dump_file')]);
";

nuJavascriptCallback($js);

function sanitizeFilename($file) {
    $file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $file);
    return mb_ereg_replace("([\.]{2,})", '', $file);
}
