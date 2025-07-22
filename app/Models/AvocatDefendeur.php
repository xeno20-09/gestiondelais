<?php

namespace App\Models;

use App\Models\Partie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AvocatDefendeur extends Model
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom_complet',
        'email',
        'type',

    ];

    public function parties()
    {
        return $this->hasMany(Partie::class);
    }
}
