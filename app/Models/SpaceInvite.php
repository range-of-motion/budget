<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpaceInvite extends Model
{
    protected $fillable = [
        'space_id',
        'inviter_user_id',
        'invitee_user_id',
        'role'
    ];

    // Relations
    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function invitee()
    {
        return $this->belongsTo(User::class, 'invitee_user_id');
    }

    public function inviter()
    {
        return $this->belongsTo(User::class, 'inviter_user_id');
    }
}
