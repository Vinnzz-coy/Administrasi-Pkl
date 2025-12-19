<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    use HasFactory;
    protected $table = 'pembimbing';
    protected $primaryKey = 'id_pembimbing';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'nama',
        'nip',
        'pangkat',
        'golongan',
        'jabatan',
        'jumlah_jam_mengajar'
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'id_pembimbing','id_pembimbing');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
