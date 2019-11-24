###  Globeadmin Helper: View an Object ID at a glance

As an administrator, you sometimes want to know the ID of an object at a glance.
By adding this code under Setup -> Header, the Id of an object is displayed when you move the mouse over an object. 

<p align="left">
  <img src="screenshots/globeadmin_view_object_id.gif" width="450">
</p>


```
function nuOnLoad() {

    // Globeadmin Helper: Quickly View the Id for objects
    var acl = nuAccessLevelCode();
    if (acl == '') { // globeadmin

        $("*").each(function() {
            var id = $(this).attr('id');
            if (id !== undefined) {
                $(this).attr('title', 'ID: ' + id);
            }
        });

    }
}
```

