<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceInvite extends Model
{
    use HasFactory;

    protected $fillable = [
        'space_id',
        'inviter_user_id',
        'invitee_user_id',
        'role',
        'accepted'
    ];

    protected $casts = [
        'accepted' => 'boolean'
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

    // Accessors
    public function getStatusAttribute(): string
    {
        if ($this->accepted === null) {
            return 'Pending';
        }

        if ($this->accepted === true) {
            return 'Accepted (' . date('d-m', strtotime($this->updated_at)) . ')';
        }

        if ($this->accepted === false) {
            return 'Denied (' . date('d-m', strtotime($this->updated_at)) . ')';
        }

        return 'Unknown';
    }
}
