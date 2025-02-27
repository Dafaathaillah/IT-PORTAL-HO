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

    public function model(array $row)
    {
        $maxId = InvLaptop::max('max_id');
        if (is_null($maxId)) {
            $maxId = 1;
        } else {
            $maxId = $maxId + 1;
        }

        $dept = explode('-', $row[2]);

        $aduan_get_data_user = UserAll::where('nrp', $row[20])->first();
        $existingDataSn = InvLaptop::where('serial_number', $row[13])->exists();

        // dd(aduan_get_data_user);
        if ($aduan_get_data_user) {
            if ($existingDataSn) {
                return null;
            }
            return new InvLaptop([
                'max_id' => $maxId,
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
                'site' => auth()->user()->site,
                'dept' => $dept[2]
            ]);
        }
    }
}
