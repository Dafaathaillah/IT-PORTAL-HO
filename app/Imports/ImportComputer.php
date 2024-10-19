<?php

namespace App\Imports;

use App\Models\InvComputer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportComputer implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 25;
    }

    public function model(array $row)
    {
        // dd($row);
        return new InvComputer([
            'max_id' => $row[0],
            'computer_name' => $row[3],
            'computer_code' => $row[2],
            'number_asset_ho' => $row[1],
            'assets_category' => $row[4],
            'spesifikasi' => $row[5] . ', ' . $row[6] . ', ' . $row[7] . ', ' . $row[8] . ', ' . $row[9] . ', ' . $row[10] . ', ' . $row[11] . ', ' . $row[12],
            'serial_number' => $row[13],
            'aplikasi' => $row[14],
            'license' => $row[15],
            'ip_address' => $row[16],
            'location' => $row[17],
            'status' => $row[18],
            'condition' => $row[19],
            'note' => $row[21],
            // 'date_of_inventory' => $row[22],
            // 'date_of_deploy' => $row[23],
            'user_alls_id' => null,
        ]);
    }
}