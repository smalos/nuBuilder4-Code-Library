### Globeadmin: Create a Backup of your nuBuilder Database

It is important to keep backups of your nuBuilder database to ensure you are able to restore them in the event of data loss. 
Downloading copies in the form of .sql files, can save you unnecessary stress and prevent future headaches. 

You can accomplish this using the [mysqldump](https://dev.mysql.com/doc/refman/8.0/en/mysqldump.html) command-line function or with phpMyAdmin by exporting your database to an sql file.
However mysqldump is not always available (for example in production server environment or on a shared hosting)

This snippet is going to show a third possibility that uses the open source library [Mysqldump.php](https://github.com/ifsnop/mysqldump-php).
This is a php version of mysqldump cli that comes with MySQL, without dependencies, output compression and sane defaults.

#### Download Mysqldump.php

Download [Mysqldump.php](https://github.com/ifsnop/mysqldump-php/blob/master/src/Ifsnop/Mysqldump/Mysqldump.php) and place it in a folder */libs/upload/Mysqldump* of your nuBuilder root directory.

#### Create a Procedure

Create a [Procedure](https://wiki.nubuilder.net/nubuilderforte/index.php/Procedures): *Tab Builders -> Procedure -> Add*d.

Code: e.g. *create_backup*

<p align="left">
  <img src="screenshots/procedure_create_backup.png">
</p>

Paste the PHP code from the file [procedure_create_backup.php](procedure_create_backup.php) to the PHP field.

Click save.

#### Run the Procedure
In nuBuilder, go to the Setup Tab, click on the button "Run Procedure", choose the Procedure *create_backup* and run it.


#### Automate the Export Process

To automate the export process (e.g. create a nightly backup), you can use the procedure from this snippet.
https://github.com/smalos/nuBuilder4-Code-Library/tree/master/codelib/automation_call_procedure_externally
