<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    use HasFactory;

    protected $table = 'clearances'; 

    protected $fillable = [
        'instansi',
        'nama_kegiatan',
        'tanggal',
        'nomor_surat',
        'sifat_surat',
        'lampiran',
        'hal',
        'nama_penelaah',
        'jabatan_penelaah',
    ];
}
