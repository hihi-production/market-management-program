<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisToko extends Model
{
    use HasFactory;

    protected $table = 'jenis_tokos';
    protected $fillable = [
        'name',
    ];

    // Relations
    public function kontrak()
    {
        return $this->hasMany(Kontrak::class);
    }
}
