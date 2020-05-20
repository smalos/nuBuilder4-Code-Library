## Automation: How to run a PHP procedure from outside nuBuilder?

☛ Place [nucall_ext.php](nucall_ext.php) in a subfolder of your nuBuilder root directory (e.g. /libs)

☛ Create a new [Procedure](https://wiki.nubuilder.net/nubuilderforte/index.php/Procedures)

☛ Create a new [Access Level](https://wiki.nubuilder.net/nubuilderforte/index.php/User_Access#Creating_an_Access_Level). For security reasons, do not assign that Access Level to a user. 

☛ Add the Procedures to the Access Level.

#### ✪ Example

Call nucall_ext.php and pass these two parameters:

* *p* (Procedure): replace test with your Procedure name.
* *acc* (Access Level): replace acl_cron_job with your Access Level.

E.g. http://localhost/nubuilder/nucall_ext.php?p=test&acc=acl_cron_job

Now you may want to set up a cron job to call the script on a scheduled basis.
A cron job in PHP powered systems, in particular, is often used to ensure timely execution of important tasks including executing or scheduling a code 
snippet. They are often used for system maintenance.
