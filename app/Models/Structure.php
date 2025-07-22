<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Structure extends Model
{
    /** @use HasFactory<\Database\Factories\StructuresFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom_structure',
        'code_structure',
        'email',
    ];


    // Structure.php
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
