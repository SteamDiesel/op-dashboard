<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'team_id',
        'is_open',
        'linked_ticket_id',
        'title',
        'description',
        'pms',
        'users',
        'properties',
        'agencies',
        'tenants',
        'owners',
        'tradies',
        'snapshot',
        'tasks',
    ];

    /**
     * Get the user associated with the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the team associated with the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    /**
     * Get the Activity associated with the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }
}
