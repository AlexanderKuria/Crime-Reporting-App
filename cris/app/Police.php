<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Police extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignedCrimes()
    {
        return $this->hasMany(Crime::class);
    }

    /**
     * @param Police $police
     * @param $email
     * @return bool
     */
    public static function isValidEmail(Police $police, $email)
    {
        $officer = Police::where(['email' => $email])->first();
        if (!$officer)
            return true;
        if ($officer->id == $police->id)
            return true;
        return false;
    }
}
