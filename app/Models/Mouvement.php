<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mouvement extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'recours_id',
        'instruction_id',
        'communique_au',
        'date_debut_instruction',
        'date_fin_instruction',
        'date_debut_notification',
        'etat_instruction',
        'observation',

    ];

    // Mouvement.php
    public function recours()
    {
        return $this->belongsTo(Recours::class, 'recours_id');
    }

    public function instruction()
    {
        return $this->belongsTo(Instruction::class, 'instruction_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'mouvement_id');
    }
}
