## addBrowseColumnTotal()

The function [addBrowseColumnTotal()](browse_total_rows.js) can be added to a form's Custom Code to add a total row (or multiple total rows) at the bottom of a Browse Table.

```
addBrowseColumnTotal(columns, op, number, title); 
```

Parameters:

- columns: array of columns. E.g. ['1','2']
- op (operation): Sum: totalOperations.SUM, Average: totalOperations.AVG, Weighted Average: totalOperations.AVG_W
- (total row) number: number of the total column
- (total row) title: Title of the total column

### Example 1:  Add a total row (sum)

```
  addBrowseColumnTotal(['1','2','3','4'], totalOperations.SUM, 1, 'Total');  
```

<p align="left">
  <img src="screenshots/Total Row.png" width="450">
</p>

### Example 2: Adding multiple total rows

```
  addBrowseColumnTotal(['1','2','3','4'], totalOperations.SUM, 1, 'Sum');
  addBrowseColumnTotal(['1','2','3','4'], totalOperations.AVG, 2, 'Average');
```

<p align="left">
  <img src="screenshots/Total sum_average.png" width="450">
</p>

