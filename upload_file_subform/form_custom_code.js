var fileField;

function upload(event) {
    var td = $(event.target);
    var t = td.attr('data-nu-prefix');

    fileField = t + 'sample_file_name';
    fileId = t + 'sample_file_id';

    $("#fileToUpload").click();

}
