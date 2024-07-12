<?php

namespace Core;

class Session
{
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value,$key2=null)
    {
        if($key2!=null){
            $_SESSION[$key][$key2] = $value;
        }else{
            $_SESSION[$key] = $value;
        }
    }

    public static function get($key,$key2=null)
    {
        if($key2!=null){
            return isset($_SESSION[$key][$key2])? $_SESSION[$key][$key2] : null;
        }
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function destroy()
    {
        session_destroy();
    }
}
