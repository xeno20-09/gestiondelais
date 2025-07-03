<?php

namespace App\Models;

use App\Models\Partie;
use App\Models\Section;
use App\Models\Structure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recours extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'structure_id',
        'section_id',
        'numero_dossier',
        'objet',
        'etat_dossier',
        'dossier_clos',
        'date_enregistrement',
        'date_clos',
        'observation',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }
    public function partie()
    {
        return $this->hasOne(Partie::class);
    }
    public function mouvements()
    {

        return $this->hasMany(Mouvement::class);
    }

    public function lastMouvement()
    {
        return $this->hasOne(Mouvement::class)->latest();
    }
}
