## Third party: How to send sms with Twilio?

Using [Twilio](https://www.twilio.com/)'s REST API, you can send outgoing SMS messages from your Twilio phone number to mobile phones making an HTTP POST.

```php
function sendSMSTwilio($from, $to, $body) {   

	// Find your Account Sid and Auth Token at twilio.com/console
	$sid    = "ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
	$token  = "your_auth_token";
	$url = "https://api.twilio.com/2010-04-01/Accounts/$id/Messages.json";

	$data = array (
		'From' => $from,
		'To' => $to,  
		'Body' => $body
	);      

	$post = $data;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, "$id:$token");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

	$retval = curl_exec($ch);
	curl_close($ch);

	$obj = json_decode($retval);    

	$errorMsg = "";         
	$uri = "";

	if ($obj) {
		if (property_exists($obj, "error_message")) {
			$errorMsg = $obj->error_message;
		}
		if (property_exists($obj, "uri")) {
				$uri = $obj->uri;
		}
	}

	return array($errorMsg, $uri);

}
```

#### ✪ Example 

Send an sms after saving a form if a condition is true. Place the code in the AS (after save) event:

```php
if ("#emp_status#" == "critical") {
	$phone = "#emp_phone#"; 				// retrieve the phone from a Hash Cookie
	$body = "Hello from nuBuilder!";
	$body = str_replace("\t", " ", $body);  // remove tabulators

	$result = sendSMSTwilio("Something", $phone,  $body);
	$errorMsg = $result[0];
	$uri = $result[1];
}
```

#### Useful links:    

https://www.twilio.com/docs/sms/send-messages
