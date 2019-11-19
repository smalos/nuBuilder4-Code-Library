// ** Configuration: Modify if necessary
// *****************************************

var uploadFolder = 'libs/upload/documents/';
var idFileName = 'files_file_name';
var idFileId = 'files_file_id';
var idSubForm = 'sample_files';

// *****************************************

var idRowFileName;
var idRowFileId;

function uploadFile(event) {
    var td = $(event.target);
    var t = td.attr('data-nu-prefix');

    idRowFileName = t + idFileName;
    idRowFileId = t + idFileId;

    $("#fileToUpload").click();

}

function createDownloadLink(field, folder, fileId, fileName) {

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

	var cName = sf.fields.indexOf(idFileName);
    var cId = sf.fields.indexOf(idFileId);

    for (var i = 0; i < sf.rows.length; i++) {

            var fileId = sf.rows[i][cId];
			var fileName = sf.rows[i][cName];

			if (fileName !== '') {
				createDownloadLink(idSubForm + nuPad3(i) + idFileName, uploadFolder, fileId, fileName);
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
    addDownloadLinks(idSubForm);
} else
{
    
    if (typeof nuStopBrowserResize == 'function') { 
        nuStopBrowserResize();
    }

}
