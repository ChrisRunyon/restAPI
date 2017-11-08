<?php

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 12/23/2015
 * Time: 10:47 PM
 */
class MultiFileUploader
{

    public function multiFileUpload($files, $user_id, $name) {
        if(isset($files['files'])){
            $errors= array();
            foreach($files['files']['tmp_name'] as $key => $tmp_name ){
                $file_name = $files['files']['name'][$key];
                $file_size = $files['files']['size'][$key];
                $file_tmp = $files['files']['tmp_name'][$key];
                $file_type = $files['files']['type'][$key];
                if($file_size > 8388608){
                    $errors[]='File size must be less than 8 MB';
                }
                //$query="INSERT into upload_data (`USER_ID`,`FILE_NAME`,`FILE_SIZE`,`FILE_TYPE`) VALUES('$user_id','$file_name','$file_size','$file_type'); ";
                $desired_dir="assets";
                $user_dir="$user_id";
                $name_dir="$name";
                if(empty($errors)==true){
                    if(is_dir($desired_dir)==false){
                        mkdir("$desired_dir", 0700); // Create directory if it does not exist
                    }
                    if(is_dir("$desired_dir/"."$user_dir")==false) {
                        mkdir("$desired_dir/"."$user_dir", 0700);
                    }
                    if(is_dir("$desired_dir/"."$user_dir/"."$name_dir")==false) {
                        mkdir("$desired_dir/"."$user_dir/"."$name_dir", 0700);
                    }
                    //if(is_dir("$desired_dir/".$file_name)==false){
                    move_uploaded_file($file_tmp,"$desired_dir/"."$user_dir/"."$name_dir/".$file_name);
                    //}else{ //rename the file if another one exist
                    //    $new_dir="user_data/".$file_name.time();
                    //    rename($file_tmp,$new_dir) ;
                    //}
                    //mysql_query($query);
                }else{
                    print_r($errors);
                }
            }
            if(empty($error)) {
            }
        }
    }
}