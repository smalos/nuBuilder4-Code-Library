### PHP: How to import a CSV file into a database table

This snippet will show how to read the contents of a CSV file and insert that data into a database table. 
We will start by looking at the contents of the CSV file that we are importing. 

<p align="left">
  <img src="screenshots/csv_sample.png">
</p>

The column headings are not included and each field is delimited by a semicolon <;>.
The database table that we will be importing into is defined with 3 columns (col1,col2,col3) to match the input file. The table is automatically created if it does not exist.


#### Create a Procedure

1. First, create a [Procedure](https://wiki.nubuilder.net/nubuilderforte/index.php/Procedures): *Tab Builders -> Procedure -> Add* 

2. Code: e.g. *csv_upload*

3. Description: Enter a description for the procedure. E.g. *Upload CSV to Table data_csv*

4. Pick "Hidden" from the select.

5. Paste this PHP code

```php

$table = "data_csv";
$separator = ";";
$txt = '#csv_content#';

$q = "
	CREATE TABLE IF NOT EXISTS $table (
		col1 VARCHAR(50),
		col2 VARCHAR(50),
		col3 VARCHAR(50)
	)
";

$t = nuRunQuery($q);
$firstDimension = explode("\n", $txt);

$result = [];
foreach ($firstDimension as $temp) {
    $result[] = explode($separator, $temp);
}

$lines = 0;
foreach ($result as $data) {
    if (isset($data[1])) {
        $lines++;
        $q = "
	   INSERT INTO $table (col1, col2, col3)
	   VALUES(?, ?, ?)
        ";
        $t = nuRunQuery($q, [$data[0], $data[1], $data[2]]);
    }
}

$js = "nuMessage(['<h1>CSV upload completed!<br>Number of lines uploaded: $lines<br>Data stored in the $table table.</h1>']);";
nuJavascriptCallback($js);

```

6. Save

#### Create a HTML object

1. In your form, create a new object of type HTML. Any object ID can be entered.
The HTML object holds code which creates a file upload object and processes the file upload.

   ☛  Add this code in the HTML field (HTML tab).

```javascript
<input type='file' id="csvupload" onChange="readSingleFile(this);"/>

<script>
    function readSingleFile(e) {

        var file = e.files[0];

        if (!file) {
            return;
        }

        var reader = new FileReader();
        reader.onload = function (e) {
            var content = e.target.result;
            $("#csvupload").val(null);
            uploadFile(content);

        };
        reader.readAsText(file);
    }

    function uploadFile(content) {
        nuSetProperty('csv_content', content);
        nuRunPHPHidden('csv_upload', 0);
    }

</script>

```

#### Test it!

Click "Choose File" and pick the csv_sample.csv.

<p align="left">
  <img src="screenshots/file_input.png">
</p>

If the file was successfully imported, a message "CSV upload completed!" is displayed.
