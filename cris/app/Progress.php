<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $guarded = [];

    public function filledBy()
    {
        return $this->belongsTo(Police::class);
    }
    public function filledFor()
    {
        return $this->belongsTo(Crime::class);
    }
}
