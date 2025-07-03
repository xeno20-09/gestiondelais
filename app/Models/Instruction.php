<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom',
        'delais',
    ];
    public function mouvements()
    {
        return $this->hasMany(Mouvement::class, 'instruction_id');
    }
}
