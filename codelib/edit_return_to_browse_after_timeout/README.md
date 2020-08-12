## Edit Screen: Return to the Browse Screen after an inactivity timeout period

This snippet will (forcefully) redirect the user back to the Browse Screen after a pre-determined period of inactivity. A countdown timer will show the time left.
When the mouse is moved, the timer is reset.

<p align="left">
  <img src="screenshots/countdown.gif">
</p>


If you just want to try the sample, go ahead and import [countdownBE.sql.gzip](/codelib/db_dump_countdownBE.sql.gzip) into your existing nuBuilder Database (using phpMyAdmin).
The dump contains a form, objects and a table. It will not overwrite/modify/delete any other data.


☛ This script expects a "Word" Object with an ID "counter" on your form.

☛ You can change that to what ever you want. (Also rename the variable *counter_id* in the code.)

☛ Change the timeout period (*countdown_time* variable)

☛ Add this JavaScript to your form's *Custom Code* field:

 ❓ [How to add Custom Code](/codelib/common/form_add_custom_code_javascript.gif)


<details>
 <summary>Click to view the code!</summary>
  
```javascript
// This script expects a "Word" Object with an ID "counterObjId" on your form.
// You can change that to what ever you want. (Also change the variable counterObjId in the code)

// *** Settings ****

var trackMousemove = true;
var trackKeypress = true;
var counterObjId = "counter";
var countdown_time = 1; // number of minutes


var form_id;
var timer;
var counter;

function countdown(minutes) {

    var sec = 60;
    var mins = minutes;

    function displayCounter(min, sec) {
        counter.html(min.toString() + ":" + nuPad2(sec));
    }

    function tick() {

        checkStopTimer();

        var min = mins - 1;
        sec--;

        displayCounter(min, sec);
        checkTimeOutEnd(sec, mins);

        if (sec > 0) {
            if (timer === 0) return;
            timer = setTimeout(tick, 1000);
        } else {
            if (mins > 1) countdown(mins - 1);
        }

    }
    tick();
}

function onActivity() {
    stopTimer();
    startTimer();
}

function startActivityTracker() {
    $(document).ready(function () {
        if (trackMousemove)  $(document).mousemove(onActivity);
        if (trackKeypress)  $(document).keypress(onActivity);
    });
}

function stopActivityTracker() {
    if (trackMousemove)  $(document).off('mousemove');
    if (trackKeypress)  $(document).off('keypress');    
}

function startTimer() {
    timer = -1;
    countdown(countdown_time);
}

function stopTimer() {
    clearTimeout(timer);
    timer = 0;
}

function gotoPrevBreadcrumb() {
    if (parent.$('#nuModal').length > 0) {
        nuClosePopup();
        return;
    }

    var l = window.nuFORM.breadcrumbs.length;
    if (l > 1) {
        nuGetBreadcrumb(l - 2);
    }
}

function checkTimeOutEnd(sec, min) {
    if (sec === 0 && min === 1) {
        stopTimer();
        stopActivityTracker();
        nuHasNotBeenEdited();
        gotoPrevBreadcrumb();
    }
}

function checkStopTimer() {
    if (nuCurrentProperties().form_id != form_id || nuFormType() != 'edit') {
        stopTimer();
        stopActivityTracker();
    }
}

if (nuFormType() == 'edit') {
    form_id = nuCurrentProperties().form_id;
    
    var counter = $('#' + counterObjId);
    counter.css('font-size', '20px');

    startActivityTracker();
    startTimer();
}```

</details>
