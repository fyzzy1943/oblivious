<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpdateRule extends Model
{
    protected $fillable = [
        'serial',
        'url',
        'url_area',
        'url_rule',
        'content_area',
        'title_rule',
        'date_rule',
        'article_rule',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'serial', 'serial');
    }
}
