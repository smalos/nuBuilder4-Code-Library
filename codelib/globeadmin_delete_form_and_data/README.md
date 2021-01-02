## Globeadmin: Delete a Form with its associated data.

When deleting a form within nuBuilder, its objects and other associated data (like JS & PHP Events, Tabs etc.) remain in the database.
If you want to delete a form completely with all linked data, you can execute the SQL below.

To do so,

☛  Open phpMyAdmin or a similar database tool.

☛  In the query below, replace *5f2eaff5eada6d5* with your Form Id.
You can retrieve it by executing *nuCurrentProperties().form_id* in the Developer Console (F12) or by looking in database table `zzzzsys_form`, column zzzzsys_form_id.

☛  Make sure to create a backup of your database before running the SQL query in order to have a version of the database to revert to in case of any problems.

<details>
 <summary>Click to view the SQL!</summary>
  
```mysql
SET @form_id = '5f2eaff5eada6d5'; --  Form id to delete
SET @form_id_like = CONCAT(@form_id,'%');

-- Events
DELETE FROM zzzzsys_event WHERE sev_zzzzsys_object_id in 
(SELECT zzzzsys_object_id FROM zzzzsys_object where sob_all_zzzzsys_form_id = @form_id);

-- PHP
DELETE FROM zzzzsys_php WHERE 
zzzzsys_php_id LIKE @form_id_like
OR sph_zzzzsys_form_id = @form_id
OR LEFT(zzzzsys_php_id,length(zzzzsys_php_id)-3)  
IN (SELECT zzzzsys_object_id FROM `zzzzsys_object` WHERE sob_all_zzzzsys_form_id = @form_id);

-- Browse
DELETE FROM zzzzsys_browse WHERE sbr_zzzzsys_form_id = @form_id ;

-- Select
DELETE FROM zzzzsys_select WHERE zzzzsys_select_id  LIKE @form_id ;

-- Select Clause
DELETE FROM zzzzsys_select_clause WHERE ssc_zzzzsys_select_id LIKE @form_id_like ;

-- Form Tabs
DELETE FROM zzzzsys_tab WHERE syt_zzzzsys_form_id  = @form_id;

-- Form objects
DELETE FROM zzzzsys_object WHERE sob_all_zzzzsys_form_id = @form_id OR sob_run_zzzzsys_form_id = @form_id;

-- Finally, delete the form
DELETE FROM zzzzsys_form WHERE zzzzsys_form_id = @form_id ;
```
</details>
