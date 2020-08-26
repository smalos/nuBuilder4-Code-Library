### UX: Display the Logged in User Name

showLoggedInUser() will display the logged in username instead of the nubuilder.com link.
This is especially useful if you log in with different users (to test functionality from the user perspective) and want to know with which user you are logged in.
 
<p align="left">
  <img src="screenshots/logged_in_user.png">
</p>

☛  Add this JavaScript code in the Header (❓ [Home ► Setup](/codelib/common/setup_header.gif)). Click Save and log in again.

```javascript
function showLoggedInUser() {
	$('.nuBuilderLink').html(window.global_access ? nuCurrentProperties().user_id : nuUserName()).attr('href', '').css({
		'cursor': 'pointer'
		, 'pointer-events': 'none'
	});
}

function nuOnLoad() {
	showLoggedInUser();
}
```
