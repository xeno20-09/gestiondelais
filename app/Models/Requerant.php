<?php

namespace App\Models;

use App\Models\Partie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Requerant extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom_complet',
        'domicile',
        'type_personne',

    ];
    public function requerant()
    {
        return $this->hasMany(Partie::class);
    }
}
