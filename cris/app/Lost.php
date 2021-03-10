<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Lost extends Model
{
    protected $guarded = [];

    /**
     *  Invoked when CRUD operation is made
     */
    protected static function boot()
    {
        parent::boot();
        static::deleting(function($item){
            Storage::disk('public')->delete($item->image);
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
