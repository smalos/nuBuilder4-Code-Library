var fileField;
var fileId;

function uploadFile(event) {

    var td = $(event.target);
    var t = td.attr('data-nu-prefix');

    fileField = t + 'files_file_name';
    fileId = t + 'files_file_id';

    $("#fileToUpload").click();

}

function createDownloadLink(field, folder, fileId, fileName) {

    $('#' + field)
        .css({
            "text-decoration": "underline"
        })
        .css('cursor', 'pointer')
        .off('click') //.prop('onclick',null).off('click');
        .attr({
            fileName: fileName,
            fileId: fileId,
            folder: folder
        })
        .attr('readonly', 'readonly')
        .click(function(event) {
            downloadFile($(this).attr('folder') + $(this).attr('fileid') + '_' + $(this).attr('fileName'), $(this).attr('fileName'));
        });
}


function downloadFile(url, filename) {
    
    var a = document.createElement("a");
    a.href = url;
    a.setAttribute("download", filename);
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    
}


nuStopBrowserResize();
