<?php

namespace App\Imports;

use App\Models\InvLaptop;
use App\Models\UserAll;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportLaptop implements ToModel, WithStartRow
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
        $inventoryNumber = $row[2] ?? '';
        $codeDept = $this->extractDept($inventoryNumber);
        $codeSite = $this->extractSite($inventoryNumber);
        $codeMaxId = $this->extractNumber($inventoryNumber);

        // dd($codeDept);
        $aduan_get_data_user = UserAll::where('nrp', $row[20])->first();
        $existingDataSn = InvLaptop::where('serial_number', $row[13])->first();

        if ($aduan_get_data_user) {
            if ($existingDataSn) {
                $this->duplicateRecords[] = [
                    'number_asset_ho' => $existingDataSn->number_asset_ho,
                    'laptop_code' => $existingDataSn->laptop_code,
                    'serial_number' => $existingDataSn->serial_number,
                    'site' => $existingDataSn->site,
                ];
                return null;
            }
            return new InvLaptop([
                'max_id' => $codeMaxId,
                'laptop_name' => $row[3],
                'laptop_code' => $row[2],
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
                'user_alls_id' => $aduan_get_data_user['id'],
                'site' => $codeSite,
                'dept' => $codeDept
            ]);
        }
    }

    private function extractDept($inventoryNumber)
    {
        preg_match('/^BIB-NB-([A-Z]+)-\d+$/', $inventoryNumber, $matches);
        
        return $matches[1] ?? null; // Mengembalikan dept jika ada, jika tidak null
    }

    private function extractSite($inventoryNumber)
    {
        // Ambil "BIB" dari awal string jika ada
        preg_match('/^BIB/', $inventoryNumber, $matches);
        return $matches[0] ?? null;
    }

    private function extractNumber($inventoryNumber)
    {
        // Ambil 3 digit angka terakhir dari inventory_number
        preg_match('/(\d{3})$/', $inventoryNumber, $matches);

        // Ubah menjadi integer agar menghilangkan leading zero
        return isset($matches[1]) ? (int) $matches[1] : null;
    }

    public function getDuplicateRecords()
    {
        return $this->duplicateRecords;
    }
}
