<?php

namespace App\Console\Commands;

use App\Models\InspeksiLaptop;
use App\Models\InvLaptop;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ImportInventoryToInspeksiLaptop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspeksiLaptop:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from inventory to inspeksi laptop every year';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Retrieve data from inventory
        $inventories_laptop = InvLaptop::get();
        $currentDate = Carbon::now();

        // Insert data into inspeksi
        foreach ($inventories_laptop as $inventory_laptop) {
            $cek = InspeksiLaptop::where('inv_laptop_id',  $inventory_laptop->id)
            ->where('year', $currentDate->format('Y'))
            ->get();

            if($cek->isEmpty())
            {
                InspeksiLaptop::create([
                    'inv_laptop_id' => $inventory_laptop->id,
                    'created_date' => $currentDate->format('Y-m-d H:i:s'),
                    'year' => $currentDate->format('Y'),
                    'inspection_status' => 'N',
                    'inventory_status' => $inventory_laptop->status,
                    'created_at' => $currentDate->format('Y-m-d H:i:s')
                ]);
            }
        }

        $this->info('Data successfully imported from inventory to inspeksi.');
    }
}
