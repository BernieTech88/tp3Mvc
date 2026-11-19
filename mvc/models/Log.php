<?php

namespace App\Models;

class Log extends CRUD
{
    protected $table = 'logs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'ip_address',
        'page'
    ];


//sauvegarde journalisation
public static function saveLog($page)
    {
        $log = new self();

        $log->insert([
            'username' => $_SESSION['user_name'] ?? 'Visiteur',
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'page' => $page
        ]);
    }



}