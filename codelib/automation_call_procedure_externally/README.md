## Automation: How to run a PHP procedure from outside nuBuilder?

In nuBuilderPro (v3) it was possible to run a [Procedure](https://wiki.nubuilder.net/nubuilderforte/index.php/Procedures) from outside nuBuilder. 
([By setting "Allow Non Secure Access"](https://wiki.nubuilder.net/nubuilderv3/index.php/Creating_PHP_Code#Allow_Non_Secure_Access)). Unfortunately, this is no longer possible with nuBuilder 4.

Therefore, I created nucall_ext.php which makes this possible again.

☛ Place [nucall_ext.php](nucall_ext.php) in a *subfolder* of your nuBuilder root directory (e.g. /libs)

☛ Next, create a new [Procedure](https://wiki.nubuilder.net/nubuilderforte/index.php/Procedures) if you do not have one already or check out this [sample Procedure](sample_procedure.php). 

☛ Create a new [Access Level](https://wiki.nubuilder.net/nubuilderforte/index.php/User_Access#Creating_an_Access_Level). For security reasons, do not assign that Access Level to a user. 

<p align="left">
  <img src="screenshots/create_access_level.png">
</p>

☛ Add the Procedure to the Access Level.

#### ✪ Example

Call nucall_ext.php and pass these two parameters:

* **p** (Procedure): Replace *test* in the URL with your Procedure Code.
* **acc** (Access Level): Replace *acl_cron_job* in the URL with your Access Level Code.

E.g. http://localhost/nubuilder/libs/nucall_ext.php?p=test&acc=acl_cron_job

Now you may want to set up a cron job to call the script on a scheduled basis.
A cron job in PHP powered systems, in particular, is often used to ensure timely execution of important tasks including executing or scheduling a code 
snippet. 

They are often used for system maintenance, to send automated reminder emails etc.
