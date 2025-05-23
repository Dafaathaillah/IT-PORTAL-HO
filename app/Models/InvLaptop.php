<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvLaptop extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'max_id',
        'laptop_name',
        'laptop_code',
        'number_asset_ho',
        'assets_category',
        'spesifikasi',
        'serial_number',
        'aplikasi',
        'license',
        'ip_address',
        'date_of_inventory',
        'date_of_deploy',
        'location',
        'status',
        'condition',
        'note',
        'link_documentation_asset_image',
        'user_alls_id',
        'site',
        'dept'
    ];

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(UserAll::class, 'user_alls_id', 'id');
    }
}
