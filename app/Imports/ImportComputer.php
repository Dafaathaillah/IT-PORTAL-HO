<?php

namespace App\Imports;

use App\Models\InvComputer;
use App\Models\UserAll;
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
        return 17;
    }

    public $duplicateRecords = [];

    public function model(array $row)
    {

        $inventoryNumber = $row[2] ?? '';
        $codeDept = $this->extractDept($inventoryNumber);
        $codeSite = $this->extractSite($inventoryNumber);
        $codeMaxId = $this->extractNumber($inventoryNumber);


        $aduan_get_data_user = UserAll::where('nrp', $row[20])->first();
        $serialNumber = trim($row[13]); // Hilangkan spasi di awal dan akhir

        // Cek apakah SN kosong, hanya tanda hubung, atau hanya spasi
        if ($serialNumber === '' || $serialNumber === '-' || $serialNumber === null) {
            $existingDataSn = null; // Biarkan lanjut tanpa mendeteksi duplikasi
        } else {
            $existingDataSn = InvComputer::where('serial_number', $serialNumber)->first();
        }
        // $existingDataSn = InvComputer::where('serial_number', $row[13])->first();

        // dd($existingDataSn);
        if ($aduan_get_data_user) {
            if ($existingDataSn) {
                $this->duplicateRecords[] = [
                    'number_asset_ho' => $existingDataSn->number_asset_ho,
                    'computer_code' => $existingDataSn->computer_code,
                    'serial_number' => $existingDataSn->serial_number,
                    'site' => $existingDataSn->site,
                ];
                return null;
            }
            return new InvComputer([
                'max_id' => $codeMaxId,
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
                'user_alls_id' => $aduan_get_data_user['id'],
                'site' => $codeSite,
                'dept' => $codeDept
            ]);
        }
    }

    private function extractDept($inventoryNumber)
    {
        preg_match('/^[A-Z]+-[A-Z]+-([A-Z]+)-\d+$/', $inventoryNumber, $matches);
        
        return $matches[1] ?? null; // Mengembalikan dept jika ada, jika tidak null
    }

    private function extractSite($inventoryNumber)
    {
        preg_match('/^[A-Z]+/', $inventoryNumber, $matches);
        return $matches[0] ?? null;
    }

    private function extractNumber($inventoryNumber)
    {
        preg_match('/(\d{3})$/', $inventoryNumber, $matches);

        // Ubah menjadi integer agar menghilangkan leading zero
        return isset($matches[1]) ? (int) $matches[1] : null;
    }

    public function getDuplicateRecords()
    {
        return $this->duplicateRecords;
    }
}
