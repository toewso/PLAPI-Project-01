<?php

class Util extends DB {


    public function file_upload($target_dir = APP_ROOT."/views/uploads/", $inputNameAttr = "fileToUpload"){

        // return an array of errors, or the filename on success

        $file_upload = array(
            'file_upload_error_status' => 0,
            'errors' => array(),
            'filename' => ''
        );
        
        // check if the $_FILES input exists
        if( !empty($_FILES[$inputNameAttr]['name'])) {

            // Check if user folder exists
            if(!file_exists($target_dir . $_SESSION['user_logged_in'] )){
                //make directory
                mkdir($target_dir . $_SESSION['user_logged_in']);
            }
           
            $filename = time() . basename($_FILES[$inputNameAttr]['name']);
            $target_file = $target_dir . $_SESSION['user_logged_in'] . "/" . $filename; // put the file directly into the folder with the time stamp
           
            // checks the image size, but if not an image(pdf etc), will return an error
            $check = getimagesize($_FILES[$inputNameAttr]['tmp_name']);  // Return image size, literal wxh

            if($check !== false) { 
                // no errors
                $file_upload['file_upload_error_status'] = 0;
            } else {
                // ELSE if it can't return the size that it is or not a image file return error
                $file_upload['file_upload_error_status'] = 1;
                $file_upload['errors'][] = "File is not an image";
            }

            //if file exists
            if(file_exists($target_file)) {
                $file_upload['file_upload_error_status'] = 1;
                $file_upload['errors'][] = "File already exists";
            }

            // Check the file size 
            $allowSize = 5000000;
            if($_FILES[$inputNameAttr]['size'] > $allowSize) { // 5 megabytes
                $file_upload['file_upload_error_status'] = 1;
                $file_upload['errors'][] = "File is too big. Limit is " . ($allowSize / 5000000) . "MB";
            }

            // Check file type
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $valid_file_types = array('jpg', 'png', 'jpeg', 'gif');
            if(!in_array($file_type, $valid_file_types)) {
                $file_upload['file_upload_error_status'] = 1;
                $file_upload['errors'][] = "Only JPG, PNG, or GIF is allowed";
            }

            // if no errors, upload!
            if($file_upload['file_upload_error_status'] == 0) { 
                // if there is no errors check to see if we can move the file onto the server
                if(move_uploaded_file($_FILES[$inputNameAttr]['tmp_name'], $target_file)){
                    $file_upload['filename'] = mysqli_real_escape_string($this->conn(), str_replace(APP_ROOT.'/views','', $target_file));

                    return $file_upload; // return entire array (finishes the function)
                }
            } else {
                // store all file errors
                $_SESSION['errors'] = $file_upload['errors'];
            }
            
            return $file_upload; // this one will have any errors from the error messages above

        }

    }
}


?>