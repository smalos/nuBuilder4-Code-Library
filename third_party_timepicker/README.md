## Third party: jQuery UI Timepicker 

This article is going to show you how to include the [jQuery UI Timepicker](https://github.com/fgelinas/timepicker) by François Gélinas.

It is a simple yet flexible jQuery UI Time Picker.
Based on the existing date picker, this plugin will integrate nicely with your form and use your selected jQuery UI theme.
The plugin is very easy to integrate in your form for your time (hours / minutes) inputs.

<p align="left">
  <img src="screenshots/timepicker.gif">
</p>



1. **Download** the Timepicker from https://github.com/fgelinas/timepicker/archive/master.zip

2. **Unzip** the archive. and place the contents in a new subdirectory (e.g. "libs\timepicker") of your nuBuilder installation.

3. ☛  Add this code in the **Header** (❓ [Home ► Setup](/common/setup_header.gif)). Click Save and log in again.


   <details>
     <summary>Click to view the code!</summary>
      
    ```javascript
    </script>

    <link href="libs/jquery.ui.timepicker.css" rel="stylesheet">
  
    <script src='libs/jquery.ui.timepicker.js' type='text/javascript'></script>

    <script>
    ```
    </details>


4. Add this JavaScript to your form's **Custom Code** field.
   ❓ [How to add Custom Code](/common/form_add_custom_code_javascript.gif)


      ☛  Replace *time_obj_id* with the Object Id of the text input Object for which the timepicker should be displayed.

<details>
 <summary>Click to view the code!</summary>

  ```javascript
  //  Init TimePicker
  if (nuFormType() == 'edit') {

      if ($('#time_obj_id').data('timepicker') === undefined) {

          $('#time_obj_id').timepicker({
              //
              // Options
              timeSeparator: ':', // The character to use to separate hours and minutes. (default: ':')
              showLeadingZero: true, // Define whether or not to show a leading zero for hours < 10. (default: true)
              showMinutesLeadingZero: true, // Define whether or not to show a leading zero for minutes < 10.(default: true)

              showPeriodLabels: false, // Define if the AM/PM labels on the left are displayed. (default: true)
              periodSeparator: ' ', // The character to use to separate the time from the time period.
              altField: '#alternate_input', // Define an alternate input to parse selected time to
              //   defaultTime: now,         // Used as default time when input field is empty or for inline timePicker
              // (set to 'now' for the current time, '' for no highlighted time, default value: now)

              // trigger options
              showOn: 'focus', // Define when the timepicker is shown.
              // 'focus': when the input gets focus, 'button' when the button trigger element is clicked,
              // 'both': when the input gets focus and when the button is clicked.
              button: null, // jQuery selector that acts as button trigger. ex: '#trigger_button'

              // Localization
              hourText: 'Hour', // Define the locale text for "Hours"
              minuteText: 'Minute', // Define the locale text for "Minute"
              amPmText: ['AM', 'PM'], // Define the locale text for periods

              // Position
              myPosition: 'left top', // Corner of the dialog to position, used with the jQuery UI Position utility if present.
              atPosition: 'left bottom', // Corner of the input to position

              // Events: Not Implemented

              // custom hours and minutes
              hours: {
                  starts: 7, // First displayed hour
                  ends: 18 // Last displayed hour
              },
              minutes: {
                  starts: 0, // First displayed minute
                  ends: 55, // Last displayed minute
                  interval: 5, // Interval of displayed minutes
                  manual: [] // Optional extra entries for minutes
              },
              rows: 4, // Number of rows for the input tables, minimum 2, makes more sense if you use multiple of 2
              showHours: true, // Define if the hours section is displayed or not. Set to false to get a minute only dialog
              showMinutes: true, // Define if the minutes section is displayed or not. Set to false to get an hour only dialog

              // buttons
              showCloseButton: false, // shows an OK button to confirm the edit
              closeButtonText: 'Done', // Text for the confirmation button (ok button)
              showNowButton: false, // Shows the 'now' button
              nowButtonText: 'Now', // Text for the now button
              showDeselectButton: false, // Shows the deselect time button
              deselectButtonText: 'Deselect' // Text for the deselect button

          });

      }
      nuHasNotBeenEdited();
  }
  ```
</details>

#### Useful links:

* Documentation: http://fgelinas.com/code/timepicker/#usage
* Examples:http://fgelinas.com/code/timepicker 
