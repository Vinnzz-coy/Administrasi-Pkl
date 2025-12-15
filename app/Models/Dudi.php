<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dudi extends Model
{
    use HasFactory;

    protected $table = 'dudi';
    protected $primaryKey = 'id_dudi';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama',
        'alamat',
        'pimpinan',
        'pembimbing',
        'jabatan',
        'daya_tampung',
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'id_dudi');
    }
}
