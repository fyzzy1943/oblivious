<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected function rule()
    {
        $this->belongsTo(Rule::class);
    }
}
