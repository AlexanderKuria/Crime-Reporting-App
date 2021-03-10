<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crime extends Model
{
    protected  $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function assignedPolice()
    {
        return $this->belongsTo(Police::class);
    }
    public function police()
    {
        return $this->belongsTo(Police::class);
    }
    public function progresses()
    {
        return $this->hasMany(Progress::class);
    }
}
