<?php
// here we should add all validity checks on $_GET and $_POST
// before processing the files
$res = array();
foreach ($_FILES["files"]["error"] as $key => $error)
{
    if ($error == UPLOAD_ERR_OK)
    {
        $name = $_FILES["files"]["name"][$key];
        if(file_exists('uploads/'.$name))
        {
            unlink('uploads/'.$name);
        }
        move_uploaded_file( $_FILES["files"]["tmp_name"][$key], "uploads/" . $name);
        $res[] = $name;
    }
    else
    {
        echo json_encode(array('res'=>FALSE,'data'=>'Error uploading '.$name));
        exit(1);
    }
}
echo json_encode(array('res'=>TRUE,'data'=>$res));
exit(0);
