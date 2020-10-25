### PHP: Execute a Stored Procedure

This example shows how to create a stored procedure on a MySQL server and execute it by passing parameters to it.


#### What is a Stored Procedure? 

>A stored procedure is a prepared SQL code that you can save, so the code can be reused over and over again.
>So if you have an SQL query that you write over and over again, save it as a stored procedure, and then just call it to execute it.
>You can also pass parameters to a stored procedure, so that the stored procedure can act based on the parameter value(s) that is passed.
>(Source: w3schools.com)

For the purpose of this example we will need a stored procedure named "Update_userpassword" that will update a user's password.

To begin with, open phpMyAdmin and select the database where you wish to create the stored procedure from the left-side menu.
This will open up a blank SQL query window. In this window, run the following query:

```mysql
DELIMITER $$
CREATE PROCEDURE `Update_userpassword`(IN p_user_id VARCHAR(15), IN p_password VARCHAR(50))
BEGIN
	UPDATE `zzzzsys_user` SET sus_login_password = p_password WHERE zzzzsys_user_id = p_user_id;
END$$
DELIMITER ;
```

Now use the PHP function callStoredProcedure to invoke the stored procedure with the values we want to update.

```php
function callStoredProcedure($name, $params) {

    global $DBCharset;
    $db = nuRunQuery('');

    try {

        $cn = new PDO("mysql:host=$db[0];dbname=$db[1];charset=$DBCharset", $db[2], $db[3], array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $DBCharset"
        ));

        $p = implode(",", array_keys($params));
        $stmt = $cn->prepare("CALL $name($p)");

        foreach ($params as $key => & $val) {
            $stmt->bindParam($key, $val);
        }

        $stmt->execute();

    }
    catch(PDOException $ex) {
        nuDisplayError($ex->getMessage());
    }
}
```

### Example: 

Update the password of the user with ID 5f954b8f98f689d.

```php
   $params = array(':p_user_id' => '5f954b8f98f689d', ':p_password' => md5("hello$$nubuilder!"));
   callStoredProcedure("Update_userpassword", $params);
```
