### Add a "Download to CSV" button in a Browse Screen

1. Create a Procedure: Builders -> Procedure -> Add
2. Code: BrowseDownloadToCSV
3. Give it a Description
4. Paste this PHP Code
(I could also have used nuBuilder's db connection and PHP functions. But in this way the code can also be used independently from nuBuilder)




5. Save

6. In you form's Custom Code, paste this Javascript:

```
if(nuFormType() == 'browse'){
    nuAddActionButton('nuRunPHPHidden', 'Download to CSV', 'nuSetProperty("browse_sql",nuCurrentProperties().browse_sql); nuRunPHP("DownloadCSV")');
}
```


7. Save

Now you see a new button in your Browse Screen (Download to CSV)!
