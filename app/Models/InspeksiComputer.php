<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspeksiComputer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'inv_computer_id',
        'pica_number',
        'created_date',
        'month',
        'year',
        'inspection_status',
        'inspection_image',
        'triwulan',
        'inspector',
        'conditions',
        'physique_condition_cpu',
        'physique_condition_monitor',
        'software_license',
        'software_standaritation',
        'software_clear_cache',
        'software_system_restore',
        'defrag',
        'hard_maintenance',
        'change_user_pass',
        'autolock',
        'enter_password',
        'crew',
        'findings',
        'findings_image',
        'findings_action',
        'action_image',
        'findings_status',
        'remarks',
        'due_date',
        'inventory_status',
        'ip_address',
        'location',
        'approved_by',
        'status_approval',
        'site',
        'last_edited_by'
    ];

    
    public function computer()
    {
        return $this->belongsTo(InvComputer::class, 'inv_computer_id', 'id')->withDefault([
            'computer_code' => 'Data komputer tidak ditemukan !',
        ]);
    }
}
