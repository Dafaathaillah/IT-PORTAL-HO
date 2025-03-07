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
        return 17;
    }

    public $duplicateRecords = [];

    public function model(array $row)
    {
        $inventoryNumber = trim($row[2]); // Hilangkan spasi di awal dan akhir

        // Cek apakah SN kosong, hanya tanda hubung, atau hanya spasi
        if ($inventoryNumber === '' || $inventoryNumber === '-' || $inventoryNumber === null) {
            $existingDataInvNumber = null; // Biarkan lanjut tanpa mendeteksi duplikasi
        } else {
            $existingDataInvNumber = InvCctv::where('cctv_code', $inventoryNumber)->where('site', auth()->user()->site)->first();
        }

        // return dd($row);
        $maxId = InvCctv::max('max_id');
        if (is_null($maxId)) {
            $maxId = 1;
        }else{
            $maxId = $maxId + 1;
        }
        
        if ($existingDataInvNumber) {
            $this->duplicateRecords[] = [
                'inventory_number' => $existingDataInvNumber->cctv_code,
                'location' => $existingDataInvNumber->location,
                'site' => $existingDataInvNumber->site,
            ];
            return null;
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

    public function getDuplicateRecords()
    {
        return $this->duplicateRecords;
    }

}
