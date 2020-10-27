### PHP: Get a shareable link to a record

When sending a notification email to users that involves a review of a nuBuilder record, it is always handy to include a direct link to the record itself within the notification email, so that the user can open the record directly from the email instead of doing a search in the system, etc.

```php
function getHttpOrigin() {
    if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
        $origin = $_SERVER['HTTP_ORIGIN'];
    }
    else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
        $origin = $_SERVER['HTTP_REFERER'];
    }
    else {
        $origin = $_SERVER['REMOTE_ADDR'];
    }
    return $origin;
}

function getRecordURL($subFolder, $homepageId) {
  $urlRecord = getHttpOrigin() . $subFolder . '/index.php?f=' . nuHash() ['form_id'] . '&r=' . nuHash() ['RECORD_ID'] . '&h='.$homepageId;
  return "<br><br><a href=\"$urlRecord\">Edit Record</a>"; 
}


$recordURL = getRecordURL('', 'nuuserhome'); // 1. argument: leave blank is index.php is in the root.
$r = nuSendEmail('to@test.com', 'from@test.com', 'From Name', 'Body' . $recordURL, 'Subject', [], true, '', '');
```
