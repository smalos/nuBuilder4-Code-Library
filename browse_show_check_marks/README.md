### Make Boolean Fields Show Check Marks

## nuBuilder' default

Boolean values are shown as 1 (true) and 0 (false)

## Custom style

Make boolean fields show check marks or blanks based on value.


☛  Modify the Display field of your Boolean field:

```
REPLACE(REPLACE(cus_active,1,'✔'),0,'')
```
