// Use nuBuilder config file for db settings
include("nuconfig.php");

// Set the CSV delimiter
$delimiter = ';';
// Default file name if no has cookie (browse_export_filename) passed
$default_file_name = 'browse-export.csv';

// Setup the filename that our CSV will have when it is downloaded.
$fileName = "#browse_export_filename#";
if (strpos(fileName, '#') === false) {
   $fileName = $default_file_name;
}

//Connect to the DB using PDO.
try {
    $pdo = new PDO("mysql:host=$nuConfigDBHost;dbname=$nuConfigDBName", $nuConfigDBUser, $nuConfigDBPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
}

//Retrieve Browse SQL from hash cookie

$sql = "#browse_sql#";
// Test with: $sql = "SELECT * FROM `zzzzsys_user` LIMIT 20";

//Prepare the SQL query.
$statement = $pdo->prepare($sql);

//Execute the SQL query.
$statement->execute();

//Fetch all of the rows from our table
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

//Get the column names.
$columnNames = array();
if(!empty($rows)){
    //We only need to loop through the first row of our result
    //in order to collate the column names.
    $firstRow = $rows[0];
    foreach($firstRow as $colName => $val){
        $columnNames[] = $colName;
    }
}

//Set the Content-Type and Content-Disposition headers to force the download.
header('Content-Type: application/excel');
header('Content-Encoding: UTF-8');
header('Content-Disposition: attachment; filename="' . $fileName . '"');

//Open up a file pointer
$fp = fopen('php://output', 'w');

//Start off by writing the column names to the file.
fputcsv($fp, $columnNames, $delimiter);

//Then, loop through the rows and write them to the CSV file.
foreach ($rows as $row) {
    fputcsv($fp, $row, $delimiter);
}

//Close the file pointer.
fclose($fp);
