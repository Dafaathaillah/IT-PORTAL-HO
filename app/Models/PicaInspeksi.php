<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Concerns\HasUuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicaInspeksi extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'pica_number',
        'inspeksi_id',
        'temuan',
        'foto_temuan',
        'tindakan',
        'foto_tindakan',
        'status_pica',
        'due_date',
        'close_by',
        'remark',
        'site',
    ];
}
