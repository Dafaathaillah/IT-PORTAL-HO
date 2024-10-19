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
        return 25;
    }


    public function model(array $row)
    {
        return new InvCctv([
            //
        ]);
    }
}
