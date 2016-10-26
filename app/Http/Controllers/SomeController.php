<?php

namespace App\Http\Controllers;

use App\Helper\url;
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

    public function test($p1='', $p2='')
    {
        (new url())->getFullUrl($p1, $p2);
//storage/app/public/20161026/5d9dca2ca5844768883dd080da84e49010456e07
        $img_info = getimagesize('storage/20161026/5d9dca2ca5844768883dd080da84e49010456e07');

        dd($img_info);
    }
}
