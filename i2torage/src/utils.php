<?php

class Utils
{
    #http://php.net/manual/es/function.com-create-guid.php
    function GUID(){
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }
    
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', 
                        mt_rand(0, 65535), 
                        mt_rand(0, 65535), 
                        mt_rand(0, 65535), 
                        mt_rand(16384, 20479), 
                        mt_rand(32768, 49151), 
                        mt_rand(0, 65535), 
                        mt_rand(0, 65535), 
                        mt_rand(0, 65535));
    }

    function save_image_in_server($data){

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $new_id = $this->GUID();
        $image_name = date("o-m-d") . "_" . $new_id;
        $target_file = "./image/" . $image_name.'.jpg';
        $file = file_put_contents($target_file , $data);

        if(!$file){
            $retu = false;
        }else{
            $retu = $image_name;
        }

        return $retu;
    }
}