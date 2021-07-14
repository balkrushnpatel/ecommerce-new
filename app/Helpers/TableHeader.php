<?php
if (! function_exists('tableHeader')) {
    function tableHeader($key) {  
        return config('language.english.header')[$key];
    } 
}