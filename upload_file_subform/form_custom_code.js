var fileField;

function upload(event) {
    var td = $(event.target);
    var t = td.attr('data-nu-prefix');

    fileField = t + 'plantd_beschreibung';
    fileId = t + 'plantd_beschreibung';

    $("#fileToUpload").click();

}
