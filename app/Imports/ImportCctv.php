<?php

namespace App\Imports;

use App\Models\InvCctv;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportCctv implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function startRow(): int
    {
        return 20;
    }


    public function model(array $row)
    {
        // return dd($row);
        $maxId = InvCctv::max('max_id');
        if (is_null($maxId)) {
            $maxId = 1;
        }else{
            $maxId = $maxId + 1;
        }
        // return dd($maxId);
        return new InvCctv([
            'max_id' => $maxId,
            'asset_ho_number' => $row[1],
            'cctv_code' => $row[2],
            'cctv_name' => $row[3],
            'cctv_brand' => $row[4],
            'type_cctv' => $row[5],
            'ip_address' => $row[6],
            'mac_address' => $row[7],
            'location' => $row[8],
            'location_detail' => $row[9],
            'vlan' => $row[10],
            'uplink' => $row[11],
            'status' => $row[12],
            'note' => $row[13],
            'nvr_id' => null,
            'switch_id' => null,
            'site' => auth()->user()->site
        ]);
    }
}
