## How to install this sample database

* Download the nuBuilder 4 files from [GitHub](https://github.com/steven-copley/nubuilder4/archive/master.zip)
* Unzip the files into a directory on your server.
* [Create](https://www.wikihow.com/Create-a-Database-in-phpMyAdmin) a new MySQL or Maria DB database. 
* [Import](https://www.inmotionhosting.com/support/website/phpmyadmin/import-database-using-phpmyadmin/) nuBuilder4_sample_database_upload_file_subform.sql into the new database.
* Update the following variables in nuconfig.php:

  + nuConfigDBHost <br />
  + nuConfigDBName <br />
  + nuConfigDBUser <br />
  + nuConfigDBPassword <br />
  + nuConfigDBGlobeadminUsername - globeadmin username <br />
  + nuConfigDBGlobeadminPassword - globeadmin password <br />
  
* Do the steps 4 + 5 from [this article](../README.md)

