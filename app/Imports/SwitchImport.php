<?php

namespace App\Imports;

use App\Models\InvSwitch;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SwitchImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    // public function startCell(): string
    // {
    //     return 'B3';
    // }

    public function startRow(): int
    {
        return 17;
    }

    public $duplicateRecords = [];

    public function model(array $row)
    {
        $row = array_slice($row, 0, 13);

        $inventoryNumber = trim($row[3]); // Hilangkan spasi di awal dan akhir
        // Cek apakah SN kosong, hanya tanda hubung, atau hanya spasi
        if ($inventoryNumber === '' || $inventoryNumber === '-' || $inventoryNumber === null) {
            $existingDataInvNumber = null; // Biarkan lanjut tanpa mendeteksi duplikasi
        } else {
            $existingDataInvNumber = InvSwitch::where('inventory_number', $inventoryNumber)->where('site', auth()->user()->site)->first();
        }

        $maxId = InvSwitch::max('max_id');
        if (is_null($maxId)) {
            $maxId = 1;
        } else {
            $maxId = $maxId + 1;
        }

        if ($existingDataInvNumber) {
            $this->duplicateRecords[] = [
                'inventory_number' => $existingDataInvNumber->inventory_number,
                'location' => $existingDataInvNumber->location,
                'site' => $existingDataInvNumber->site,
            ];
            return null;
        }

        return new InvSwitch([
            'max_id' => $maxId,
            'device_name' => $row[1],
            'asset_ho_number' => $row[2],
            'inventory_number' => $row[3],
            'serial_number' => $row[4],
            'ip_address' => $row[5],
            'mac_address' => $row[6],
            'device_brand' => $row[7],
            'device_type' => $row[8],
            'device_model' => $row[9],
            'location' => $row[10],
            'status' => strtoupper($row[11]),
            'note' => $row[12],
            'site' => auth()->user()->site
        ]);
    }

    public function getDuplicateRecords()
    {
        return $this->duplicateRecords;
    }
}
