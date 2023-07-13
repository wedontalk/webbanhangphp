<?php
    class ReturnView{
        const VIEW_FOLDER_NAME = 'views';


        protected function view($filePath, $data = []){
            require_once(self::VIEW_FOLDER_NAME . '/' . str_replace('.' ,'/' , $filePath) . '.php');
        }
    } 
?>