<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaLinks extends Model
{
    use HasFactory;

    /**
     * The properties that can be assigned in bulk.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'link_name',
        'link_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
