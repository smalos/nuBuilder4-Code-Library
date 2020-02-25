## Browse Screen: Show pagination info

Showing pagination info in the footer of a Browse Screen:

<p align="left">
  <img src="screenshots/pagination_info.png" width="175">
</p>


☛  Add this Javascript code in the Header under Home ► Setup

```
function getPaginationInfo() {

    r = $("div[id^='nucell_']" + "[id$='_1']").length // Number of Rows per page

    with(nuFORM.getCurrent()) {
        c = page_number; // Current page number
        f = browse_filtered_rows; // Number of records in the table after filtering
        p = pages; // Total number of pages
    }

    var e; // Row number of the last record on the current page
    var s; // Row number of the first record on the current page

    if (p == c + 1 || f == 0) {
        s = f == 0 ? 0 : (c + 1) * r + 1;
        e = f
    } else
    if (c == 0 && p > 1) {
        s = 1;
        e = r;
    } else
    if (c > 0 && c < p) {
        e = (c + 1) * r;
        s = e - r + 1;
    };

    return {
        startRow: s,
        endRow: e,
        filteredRows: f
    };

}

function showPaginationInfo() {
    if (nuFormType() == 'browse') {
        var {
            startRow,
            endRow,
            filteredRows
        } = getPaginationInfo();
        var p = "Showing " + startRow + " to " + endRow + " of " + filteredRows + " entries";
        $('#nuBrowseFooter').append('<span style="float:left;vertical-align: middle;line-height: 25px;padding-left:5px">' + p + '</span>');
    }
}
```

```
function showPaginationInfo() {
    if (nuFormType() == 'browse') {
        var {
            startRow,
            endRow,
            filteredRows
        } = getPaginationInfo();
        var p = "Showing " + startRow + " to " + endRow + " of " + filteredRows + " entries";
        $('#nuBrowseFooter').append('<span style="float:left;vertical-align: middle;line-height: 25px;padding-left:5px">' + p + '</span>');
    }
}

function nuOnLoad() {
   showPaginationInfo();
}
```
