<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom',
        'prenoms',
        'role_id',
        'titre_id',
        'section_id',
        'structure_id',
        'sexe',
        'email',
        'password',
    ];
    // Relation avec une structure (1 user → 0 ou 1 structure)
    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

    // Relation avec une section (1 user → 0 ou 1 section)
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function titre()
    {
        return $this->belongsTo(UserTitre::class);
    }


    public function role()
    {
        return $this->belongsTo(UserRole::class);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
