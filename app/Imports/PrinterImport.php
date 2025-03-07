<?php

namespace App\Imports;

use App\Models\InvPrinter;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class PrinterImport implements ToModel, WithStartRow
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

    public function model(array $row)
    {

        $row = array_slice($row, 0, 14); 

        $currentDate = Carbon::now();
        $year = $currentDate->format('y');
        $month = $currentDate->month;
        $day = $currentDate->day;

        $maxId = InvPrinter::max('max_id');
        if (is_null($maxId)) {
            $maxId = 1;
        }else{
            $maxId = $maxId + 1;
        }

        return new InvPrinter([
            'max_id' => $maxId,
            'item_name' => $row[1],
            'asset_ho_number' => $row[2],
            'printer_code' => $row[3],
            'serial_number' => $row[4],
            'ip_address' => $row[5],
            'mac_address' => $row[6],
            'printer_brand' => $row[7],
            'printer_type' => $row[8],
            'division' => $row[9],
            'department' => $row[10],
            'location' => $row[11],
            'status' => strtoupper($row[12]),
            'note' => $row[13],
            'date_of_inventory'=> $currentDate->format('Y-m-d H:i:s'),
            'site' => auth()->user()->site
        ]);
    }
}
