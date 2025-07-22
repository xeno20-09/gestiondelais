<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partie extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'recours_id',
        'auditeur_id',
        'requerant_id',
        'avocat_defendeur_id',
        'avocat_requerant_id',
        'defendeur_id',
        'greffier_id',
        'conseiller_id',
    ];

    public function recours()
    {
        return $this->belongsTo(Recours::class, 'recours_id');
    }
    public function avocats_defendeurs()
    {
        return $this->belongsTo(AvocatDefendeur::class, 'avocat_defendeur_id');
    }
    public function avocats_requerants()
    {
        return $this->belongsTo(AvocatRequerant::class, 'avocat_requerant_id');
    }
    public function defendeur()
    {
        return $this->belongsTo(Defendeur::class, 'defendeur_id');
    }
    public function requerant()
    {
        return $this->belongsTo(Requerant::class, 'requerant_id');
    }
    public function greffier()
    {
        return $this->belongsTo(User::class, 'greffier_id');
    }
    public function conseiller()
    {
        return $this->belongsTo(User::class, 'conseiller_id');
    }
    public function auditeur()
    {
        return $this->belongsTo(User::class, 'auditeur_id');
    }
}
