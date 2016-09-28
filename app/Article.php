<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public static function allUnderReview($serial = '')
    {
        if (empty($serial)){
            return static::where('review', 0)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            return static::where(['review'=>0, 'serial'=>$serial])
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }

    public static function allReviewed($serial = '')
    {
        if (empty($serial)){
            return static::where('review', 1)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            return static::where(['review'=>1, 'serial'=>$serial])
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }

    protected function rule()
    {
        $this->belongsTo(Rule::class);
    }
}
