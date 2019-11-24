### Add a "Download to CSV" button in a Browse Screen

1. Create a Procedure: Builders -> Procedure -> Add
2. Code: BrowseDownloadToCSV
3. Give it a Description
4. Add the PHP code from this file: [BrowseDownloadToCSV.php](BrowseDownloadToCSV.php).

<p align="left">
  <img src="screenshots/BrowseDownloadToCSV.png" width="450">
</p>

5. Save

6. In you form's Custom Code, paste this Javascript:

```
if(nuFormType() == 'browse'){
    nuAddActionButton('nuRunPHPHidden', 'Download to CSV', 'nuSetProperty("browse_sql",nuCurrentProperties().browse_sql); nuRunPHP("DownloadCSV")');
}
```


7. Save

Now you see a new button in your Browse Screen (Download to CSV)!
