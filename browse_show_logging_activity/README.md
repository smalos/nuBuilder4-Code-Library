### Browse Screen: Show Logging Activity

As explained in this [Wiki article](https://wiki.nubuilder.net/nubuilderforte/index.php/Logging_Activity), 
nuBuilder Forte can track when records are Added, Accessed, Edited. 

But how do we retrieve this information and show it in a Browse Screen? 

We can use *JSON_EXTRACT()* to extract information from the JSON string.
To get rid of the double-quotes, we can use *JSON_UNQUOTE()* and FROM_UNIXTIME() returns a datetime from a unix_timestamp.


☛ Add this SQL to the SQL field (Browse Tab). 

☛ Replace *my_table* with your table name.

☛ Replace *my_table_id* with the table's primary key!

```mysql
SELECT
    my_table_id, 
    added_user,
    added_time,
    viewed_user,
    viewed_time,
    edited_user,
    edited_time
FROM 
(   
	SELECT  	
		my_table_id, 
		JSON_UNQUOTE(JSON_EXTRACT(my_table_nulog, '$.added.user')) as added_user,
		FROM_UNIXTIME(JSON_EXTRACT(my_table_nulog, '$.added.time')) as added_time,

		JSON_UNQUOTE(JSON_EXTRACT(my_table_nulog, '$.viewed.user')) as viewed_user,
		FROM_UNIXTIME(JSON_EXTRACT(my_table_nulog, '$.viewed.time')) as viewed_time,

		JSON_UNQUOTE(JSON_EXTRACT(my_table_nulog, '$.edited.user')) as edited_user,
		FROM_UNIXTIME(JSON_EXTRACT(my_table_nulog, '$.edited.time')) as edited_time	
	FROM my_table
) T
```

#### ⓘ Note:    

JSON functions were added in MariaDB 10.2.3 and MySQL 5.7.8
