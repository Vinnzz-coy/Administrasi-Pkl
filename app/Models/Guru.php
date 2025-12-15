<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    

    protected $table = 'guru'; 
    
       protected $primaryKey = 'id_guru'; 

   public function user()
    {
        return $this->belongsTo(User::class, 'nip', 'nip'); 
    }

    protected $fillable = [
        'user_id',
        'nama', 
        'nip', 
        'pangkat', 
        'golongan', 
        'jabatan', 
        'jumlah_jam_mengajar'
       
    ];
}