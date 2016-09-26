<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    public function setSerial()
    {
        while (true) {
            $serial = uniqid('zd_', true);
            if (!static::where('serial', $serial)->exists()) {
                $this->serial = $serial;
            }
            break;
        }
    }
}
