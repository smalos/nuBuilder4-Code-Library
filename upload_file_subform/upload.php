<?php

// Upload directory
$uploaddir = './documents/';

// Allowed file extensions
$allowed = array(
    'pdf',
    'docx'
);

try
{
    $data = array();
    $data['status'] = 'error';

    if (!isset($_FILES['file']) || !is_uploaded_file($_FILES['file']['tmp_name']) || $_FILES['file']['error'] != UPLOAD_ERR_OK)
    {
        $data['error'] = $_FILES['file']['error'];
    } else
		{	

		$filename = $_FILES['file']['name'];
		$record_id = isset($_POST['record_id']) ? $_POST['record_id'] : "";

		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if (!in_array($ext, $allowed))
		{
			$data['error'] = 'INVALID_FILE_TYPE';			
		} else 
			{	

			$file_name = sanitizeFilename(basename($_FILES['file']['name']));
			$file_id = time() . '_' . uniqid() . '_' . $record_id;
			$file = $uploaddir . $file_id . '_' . $file_name;

			if (move_uploaded_file($_FILES['file']['tmp_name'], $file))
			{
				$data['status'] = 'success';
				$data['file_name'] = $file_name;
				$data['file_id'] = $file_id;
			}
			else
			{
				$data['error'] = 'ERROR_MOVING_FILE';
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
