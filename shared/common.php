<?php 
    // class definition
    class Common{

        // member variables

        // member functions
        public function uploadAnyFile($dest, $size, $ext){

            // create variables for file upload
            $filename = $_FILES['myfile']['name'];
            $filesize = $_FILES['myfile']['size'];
            $fileerror = $_FILES['myfile']['error'];
            $filetype = $_FILES['myfile']['type'];
            $tmpname = $_FILES['myfile']['tmp_name'];

            // check if file is uploaded and the file is okay
            if ($fileerror > 0) {
                $uploadresponse['error'] = "You've not uploaded any file!";
                return $uploadresponse;
            }

            // check the file size
            if ($filesize > $size) {
                $uploadresponse['error'] = "File cannot be more than $size";
                return $uploadresponse;
            }

            // pick the file type by file Extension
            $filename_arr = explode(".", $filename);
            $file_ext = end($filename_arr);

            // check if extensions is allow
            if (!in_array(strtolower($file_ext), $ext)) {
                $uploadresponse['error'] = "File not allowed";
                return $uploadresponse;
            }

            // destination folder
            $newfilename = "ch".rand().time().".".$file_ext;
            $destination = $dest.$newfilename;

            // check if file upload was successfull
            if (move_uploaded_file($tmpname, $destination)) {
                $uploadresponse['success'] = $newfilename;
                return $uploadresponse;
            }else{
                $uploadresponse['error'] = "Could not be uploaded";
                return $uploadresponse;

            }

            // move file from the tmp dir to finale destination
        }
    }
?>