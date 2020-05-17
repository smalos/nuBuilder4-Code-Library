###  Globeadmin Helper: View an Object ID at a glance

As an administrator, you sometimes want to know the ID of an object at a glance.
By adding this code under Setup -> Header, the ID of an object is displayed when you move the mouse over an object. 
The tooltip text will only be shown when the globeadmin is logged in.

<p align="left">
  <img src="screenshots/globeadmin_view_object_id.gif">
</p>


```javascript
function globeadminViewObjectId() {
    
    if (window.global_access) {

        $("*").each(function() {
            var id = $(this).attr('id');
            if (id !== undefined) {
                $(this).attr('title', 'ID: ' + id);
            }
        });

    }
}

function nuOnLoad() {
    globeadminViewObjectId();
}
```
