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
        'linked_ticket_url',
        'title',
        'description',
        'pm_id',
        'property_id',
        'agency_id',
        'tenant_id',
        'owner_id',
        'tradie_id',
        'snapshot',
        'tasks',
    ];

    /**
     * Get the user associated with the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the team associated with the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
