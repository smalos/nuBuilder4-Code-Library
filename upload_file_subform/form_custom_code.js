// ** Change accordingly:
// *****************************************

var uploadFolder = 'libs/upload/documents/';
var fileNameId = 'files_file_name';
var fileIdId = 'files_file_id';
var subFormId = 'sample_files';

// *****************************************

var fileNameRowId;
var fileIdRowId;

function uploadFile(event) {
    var td = $(event.target);
    var t = td.attr('data-nu-prefix');

    fileNameRowId = t + fileNameId;
    fileIdRowId = t + fileIdId;

    $("#fileToUpload").click();

}

function createDownloadLink(field, folder, fileId, fileName) {
debugger;
    $('#' + field)
        .css({
            "text-decoration": "underline"
        })
        .css('cursor', 'pointer')
        .off('click')
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


function addDownloadLinks(subform) {
   
    var sf = nuSubformObject(subform);
    var cId = sf.fields.indexOf(fileIdId);
	var cName = sf.fields.indexOf(fileNameId);

    for (var i = 0; i < sf.rows.length; i++) {

            var fileId = sf.rows[i][cId];
			var fileName = sf.rows[i][cName];

			if (fileName !== '') {
				createDownloadLink(subFormId + nuPad3(i) + fileNameId, uploadFolder, fileId, fileName);
			}
    }
}


function downloadFile(url, filename) {
    var a = document.createElement("a");
    a.href = url;
    a.setAttribute("download", filename);
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}

if(nuFormType() == 'edit') {
    addDownloadLinks(subFormId);
} else
{
    nuStopBrowserResize();
}
