## Make Boolean Fields Show Check Marks

### nuBuilder's default

Boolean values are shown as 1 (true) and 0 (false)

<p align="left">
  <img src="screenshots/browse_boolean_default.png" width="342">
</p>

### Custom style

Make boolean fields show check marks or blanks based on their value.

<p align="left">
  <img src="screenshots/browse_boolean_custom_ticks.png" width="342">
</p>


☛  Modify the Display field of your Boolean field:

<p align="left">
  <img src="screenshots/browse_boolean_custom_column.png" width="498">
</p>


```
REPLACE(REPLACE(cus_active,1,'✔'),0,'')
```

