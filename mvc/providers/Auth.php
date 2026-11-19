<?php

namespace App\Providers;
use App\Providers\View;

class Auth
{
    public static function session()
    {
        if (!isset($_SESSION['user_id'])) {

            View::redirect('login');
            exit;
        }
    }

    public static function admin()
    {
        self::session();

        if ($_SESSION['privilege_id'] != 1) {

            View::redirect('home');
            exit;
        }
    }
}