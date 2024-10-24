<?php

namespace App\Imports;

use App\Models\InvCctv;
use App\Models\UserAll;
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
        return 2;
    }


    public function model(array $row)
    {
        return dd($row);
        return new UserAll([
            'nrp' => $row[1],
            'username' => $row[2],
            'department' => $row[3],
            'position' => $row[4],
            'position' => $row[6],
        ]);
    }
}
