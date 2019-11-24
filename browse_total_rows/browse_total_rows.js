var totalOperations = {
    SUM: 0 // sum 
    , AVG: 1 // average
    , AVG_W: 2  // weighted average
}

function colSumProd(arr, c1, c2) {

    var sum = 0;
    var prod = 0;
    for(var i = 0; i < arr.length; i++) {
        prod += arr[i][c1 + 1] * arr[i][c2 + 1];
        sum += parseFloat(arr[i][c2 + 1]);
    }
    return prod / sum;

}

function colSum(arr, c) {

    var sum = 0;
    var count = 0;
    c = parseFloat(c) + 1;

    for(var i = 0; i < arr.length; i++) {
        if(arr[i][c] != '') {
            var f = parseFloat(arr[i][c]) || 0;
            sum += f;
            count++;
        }
    }
    return [sum, count];
}

function addBrowseTotalRow(number, title) {

    var current = window.nuFORM.getCurrent();
    var totalRow = parseInt(current.rows) + parseInt(number) - 1;

    // If the total row already exists, exit
    if ($('#nucell_' + totalRow + '_0').length !== 0) {
        return;
    }

    // Increase the height of the footer
    var footer = $('#nuBrowseFooter');
    footer.css('top', (parseInt(footer.css('top')) + 28) + 'px');

    var columns = current.browse_columns;

    for (var column = 0; column < current.browse_columns.length; column++) {

        var id = 'nucell_' + totalRow + '_' + column;
        var div = document.createElement('div');
        div.setAttribute('id', id);
        $('#nuRECORD').append(div);

        var lastCell = $('#nucell_' + (parseInt(totalRow) - 1).toString() + '_' + column);

        $('#' + id)
            .addClass('nuBrowseTable nuBrowseTotalRow')
            .css({
                'text-align': nuAlign(columns[column].align),
                'overflow': 'hidden',
                'width': parseInt(columns[column].width) - 8,
                'top': parseInt(lastCell.css('top')) + 28,
                'left': parseInt(lastCell.css('left')),
                'height': 20,
                'position': 'absolute',
                'border-style': 'none'
            })
            .attr('data-nu-column', column);

        if (column == 0) {
            $('#nucell_' + totalRow + '_0').html(title == undefined ? "" : title).css("font-weight", "bold");
        }

    }

}

function addBrowseColumnTotal(columns, op, number, title) {

    addBrowseTotalRow(number, title);

    var current = window.nuFORM.getCurrent();
    var col = current.browse_columns;
    var result = 0;

    columns.forEach(function(c) {
        if (op < 2) { // SUM, AVG
            var values = colSum(current.browse_rows, c);
            var sum = values[0];
            var count = values[1];

            if (op == totalOperations.SUM) {
                result = sum;
            } else
            if (op == totalOperations.AVG) {
                result = sum / count;
            }
            f = col[c].format;

        } else if (op == totalOperations.AVG_W) {
            result = colSumProd(current.browse_rows, c[0], c[1]);
            f = col[c[0]].format;
        }

        var x = parseInt(current.rows) + number - 1;
        var tCell = $('#nucell_' + x + '_' + c);
        tCell.html('<b>' + nuFORM.addFormatting(result, f) + '</b>');
    });

}

if (nuFormType() == 'browse') {
  addBrowseColumnTotal(['1','2','3','4'], totalOperations.SUM, 1, 'Sum');
  addBrowseColumnTotal(['1','2','3','4'], totalOperations.AVG, 2, 'Average');
}
