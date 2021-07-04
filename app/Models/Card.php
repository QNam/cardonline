<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Card extends Authenticatable {
    use HasFactory;

    protected $table = 'card';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $dateFormat = 'U';
    protected $fillable = [
        'id',
        'descr',
        'theme',
        'position',
        'userName',
        'email',
        'password',
        'phoneNumber',
        'created_at',
        'updated_at',
        'background_img',
        'background_color',
        'iconTheme',
        'avatar_img',
        'confirm_code'
    ];

    public function links()
    {
        return $this->hasMany(CardLinks::class);
    }

    static public function checkCardExists($cardId, $confirm_code = null) {
        if(!$confirm_code) {
            return Card::where('id', $cardId)->exists();
        }

        return Card::where('id', $cardId)->where('confirm_code', $confirm_code)->exists();
        
    }

    static public function checkEmailExists($email) {
        return Card::where('email', $email)->exists();
    }
}
