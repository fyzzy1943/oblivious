<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'first',
        'second',
    ];

    protected function setSerialAttribute()
    {
        while (true) {
            $serial = uniqid('zd_', true);
            if (!static::where('serial', $serial)->exists()) {
                $this->attributes['serial'] = $serial;
            }
            break;
        }
    }

    public function updateRule()
    {
        $this->hasOne('App\UpdateRule', 'serial', 'serial');
    }
}
