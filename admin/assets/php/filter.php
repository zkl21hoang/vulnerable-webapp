<?php
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $type = finfo_file($finfo, $_FILES["fileToUpload"]["tmp_name"]);
        finfo_close($finfo);
        if (strpos($type, "image/jpeg") !== false){
                $uploadFail = False;
        }
        else{
                $uploadFail = True;
        }
?>
