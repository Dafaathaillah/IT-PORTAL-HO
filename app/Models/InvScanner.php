<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvScanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'max_id',
        'item_name',
        'scanner_code',
        'asset_ho_number',
        'serial_number',
        'ip_address',
        'mac_address',
        'scanner_brand',
        'scanner_type',
        'division',
        'department',
        'location',
        'date_of_inventory',
        'status',
        'note',
    ];
}
