<?php

namespace App\Imports;

use App\Models\UserAll;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UserPenggunaImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function startRow(): int
    {
        return 12; // Mulai dari baris kedua
    }

    public function model(array $row)
    {
        // Ambil nilai NRP dari data row
        $nrp = strtoupper($row[1]);

        // Periksa apakah NRP sudah ada di database
        $existingUser = UserAll::where('nrp', $nrp)->exists();

        // Jika NRP sudah ada, lewati proses penyimpanan
        if ($existingUser) {
            return null; // Atau logik lain jika diperlukan
        }
        // return dd($row);
        return new UserAll([
            'nrp' =>  $nrp,
            'username' =>  strtoupper($row[2]),
            'department' =>  strtoupper($row[3]),
            'position' =>  strtoupper($row[4]),
            'site' =>  strtoupper($row[5]),
            'email' =>  strtoupper($row[6]),
        ]);
    }
}
