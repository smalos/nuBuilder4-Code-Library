<?php
// Upload directory
$uploaddir = './documents/';
//$uploaddir = $_SERVER['DOCUMENT_ROOT']."/documents/";
// Allowed file extensions
$allowed = array(
    'pdf',
    'docx'
);

// Maximum file size
$maxfilesize = 5 * 1024 * 1024; // (5 MB)
try
{
    $data = array();

    if (!isset($_FILES['file']) || !is_uploaded_file($_FILES['file']['tmp_name']) || $_FILES['file']['error'] != UPLOAD_ERR_OK)
    {
        $data['error'] = $_FILES['file']['error'];
    }
    else
    {

        $record_id = isset($_POST['record_id']) ? $_POST['record_id'] : "";
        $filename = $_FILES["file"]["name"];
        $filesize = $_FILES["file"]["size"];

        if ($filesize > $maxfilesize)
        {
            $data['error'] = 'FILE_TOO_LARGE';
        }
        else
        {
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if (!in_array($ext, $allowed))
            {
                $data['error'] = 'INVALID_FILE_TYPE';
            }
            else
            {

                $file_name = sanitizeFilename(basename($filename));

                // Create a unique file id
                $file_id = time() . '_' . uniqid() . '_' . $record_id;

                $uploaddir = rtrim($uploaddir, '/') . '/';
                $file = $uploaddir . $file_id . '_' . $file_name;

                // Create directory if does not exist
                if (!is_dir($uploaddir))
                {
                    mkdir($uploaddir, 0755);
                }

                // Move the file to the destination directory
                if (move_uploaded_file($_FILES['file']['tmp_name'], $file))
                {
                    $data['error'] = '';
                    $data['file_name'] = $file_name;
                    $data['file_id'] = $file_id;
                }
                else
                {
                    $data['error'] = 'ERROR_MOVING_FILE';
                }
            }
        }
    }

    echo json_encode($data);
}

catch(Exception $e)
{
    $data['error'] = $e->getMessage();
    echo json_encode($data);
}

function sanitizeFilename($file)
{
    $file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $file);
    return mb_ereg_replace("([\.]{2,})", '', $file);
}

?>
