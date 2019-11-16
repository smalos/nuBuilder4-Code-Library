<?php

$uploaddir = './documents/';
$allowed = array(
    'pdf',
    'docx'
);

$filename = $_FILES['file']['name'];
$record_id = isset($_POST['record_id']) ? $_POST['record_id'] : die("record_id missing");

$ext = pathinfo($filename, PATHINFO_EXTENSION);
$data = array();
if (!in_array($ext, $allowed))
{
    $data['status'] = 'error';
    $data['error_message'] = 'Invalid file type';
    echo "invalid";
}
else
{
    $file_name = sanitizeFilename(basename($_FILES['file']['name']));
    $file_id = time() . '_' . uniqid() . '_' . $record_id;
    $file = $uploaddir . $file_id . '_' . $file_name;

    if (is_uploaded_file($_FILES['file']['tmp_name']) && move_uploaded_file($_FILES['file']['tmp_name'], $file))
    {
        $data['status'] = 'success';
        $data['file_name'] = $file_name;
        $data['file_id'] = $file_id;
    }
    else
    {
        $data['status'] = 'error';
    }

    echo json_encode($data);
}

function sanitizeFilename($file)
{
    $file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $file);
    return mb_ereg_replace("([\.]{2,})", '', $file);
}

?>
