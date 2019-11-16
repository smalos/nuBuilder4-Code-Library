var fileField;
var fileId;

function upload(event) {
    var td = $(event.target);
    var t = td.attr('data-nu-prefix');

    fileField = t + 'files_file_name';
    fileId = t + 'files_file_id';

    $("#fileToUpload").click();

}
