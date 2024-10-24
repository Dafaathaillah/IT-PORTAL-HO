<?php

namespace App\Imports;

use App\Models\InvCctv;
use App\Models\UserAll;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportCctv implements ToModel, WithStartRow, WithLimit
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function startRow(): int
    {
        return 2;
    }


    public function model(array $row)
    {
        return new UserAll([
            'nrp' => $row[1],
            'username' => $row[2],
            'department' => $row[3],
            'position' => $row[4],
            'email' => $row[6],
        ]);
    }

    public function limit(): int
    {
        return 113; // Menghentikan impor setelah 100 baris
    }
}
