<?php

namespace App\Http\Controllers;

use App\Mail\backup;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;

class SomeController extends Controller
{
    public function backupMysql()
    {
        exec('mysqldump -u'.env('DB_USERNAME').' -p'.env('DB_PASSWORD').' -h127.0.0.1 -P3306 --routines --default-character-set=utf8 --databases oblivious > /home/fyzzy/db.sql');
        exec('gzip /home/fyzzy/db.sql');

        Mail::to(config('mail.mysql_backup'))->send(new backup());
    }
}
