<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'location', 'event_date', 'status', 'thumbnail', 'documentations'];

    protected $casts = [
        'event_date' => 'datetime',
        'documentations' => 'array',
    ];

    public function documentations()
    {
        return $this->hasMany(EventDocumentation::class);
    }
}
