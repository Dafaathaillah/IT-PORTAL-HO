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
        // return dd($row);
        return new UserAll([
            'nrp' =>  strtoupper($row[1]),
            'username' =>  strtoupper($row[2]),
            'department' =>  strtoupper($row[3]),
            'position' =>  strtoupper($row[4]),
            'email' =>  strtoupper($row[5]),
        ]);
    }
}
