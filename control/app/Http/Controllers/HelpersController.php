<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpersController extends Controller
{
    static function compararcontraseñas($password, $repeat_password){
        if ($password == $repeat_password){
            return true;
        }else {
            return false;
        }
    }

    static function objToArray($obj, &$arr){
        if(!is_object($obj) && !is_array($obj)){
            $arr = $obj;
            return $arr;
        }
    
        foreach ($obj as $key => $value){
            if (!empty($value)){
                $arr[$key] = array();
                $this->objToArray($value, $arr[$key]);
            }else{
                $arr[$key] = $value;
            }
        }
        return $arr;
    }

    static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
