<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'status_id',
        'starts_at',
        'ends_at',
        'started_at',
        'ended_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'status_id' => 'integer',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];


    public function todoStatus()
    {
        return $this->belongsTo(\App\Models\TodoStatus::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function status()
    {
        return $this->belongsTo(\App\Models\TodoStatus::class);
    }
}
