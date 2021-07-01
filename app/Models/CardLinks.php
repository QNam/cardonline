<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardLinks extends Model
{
    use HasFactory;

    protected $table = 'card_links';
    protected $primaryKey = 'link_id';
    protected $fillable = [
        'type',
        'link',
        'card_id',
        'link_id',
        'sort',
    ];
}
