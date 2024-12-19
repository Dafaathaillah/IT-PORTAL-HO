<?php

namespace App\Imports;

use App\Models\InvAp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportAp implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    // public function startCell(): string
    // {
    //     return 'B1'; // Mulai dari sel B3, sesuaikan dengan kebutuhanmu
    // }

    public function startRow(): int
    {
        return 17; // Mulai dari baris kedua
    }

    public function model(array $row)
    {
        // dd($row[0]);
        $maxId = InvAp::max('max_id');
        if (is_null($maxId)) {
            $maxId = 1;
        }else{
            $maxId = $maxId + 1;
        }

        // dd(auth()->user()->site);

        return new InvAp([
            'max_id' => $maxId,
            'device_name' => $row[1],
            'asset_ho_number' => $row[2],
            'inventory_number' => $row[3],
            'serial_number' => $row[4],
            'frequency' => $row[5],
            'ip_address' => $row[6],
            'mac_address' => $row[7],
            'device_brand' => $row[8],
            'device_type' => $row[9],
            'device_model' => $row[10],
            'location' => $row[11],
            'status' => strtoupper($row[12]),
            'note' => $row[13],
            'site' => auth()->user()->site
        ]);
    }
}
