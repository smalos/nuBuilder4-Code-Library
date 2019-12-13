### Adding a "Download to CSV" button in a Browse Screen

1. Create a Procedure: Builders -> Procedure -> Add

2. Code: BrowseDownloadToCSV

3. Give it a Description

4. Paste the PHP code from the file [BrowseDownloadToCSV.php](BrowseDownloadToCSV.php) to the PHP field.

<p align="left">
  <img src="screenshots/BrowseDownloadToCSV.png" width="450">
</p>

5. Save

6. In you form's Custom Code, paste this Javascript:

```
if(nuFormType() == 'browse'){
    nuAddActionButton('nuRunPHPHidden', 'Download to CSV', 'nuSetProperty("browse_sql",nuCurrentProperties().browse_sql); nuRunPHP("BrowseDownloadToCSV")');
}
```

7. Save

Now you see a new button "Download to CSV" in your Browse Screen!
