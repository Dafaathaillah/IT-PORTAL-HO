<?php

namespace App\Console\Commands;

use App\Models\InspeksiComputer;
use App\Models\InvComputer;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ImportInventoryToInspeksiComputer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspeksiComputer:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from inventory to inspeksi computers every quarter';


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Retrieve data from inventory
        $inventories_computer = InvComputer::get();

        foreach ($inventories_computer as $inventory_computer) {

            $triwulan = Carbon::now()->quarter;

            $cek = InspeksiComputer::where('inv_computer_id',  $inventory_computer->id)
            ->where('triwulan', $triwulan)
            ->get();

            if ($cek->isEmpty()) {
                InspeksiComputer::create([
                    'inv_computer_id' => $inventory_computer->id,
                    'created_date' => Carbon::now()->format('Y-m-d H:i:s'),
                    'triwulan' => $triwulan,
                    'month' => Carbon::now()->format('m'),
                    'year' => Carbon::now()->format('Y'),
                    'inspection_status' => 'N',
                    'inventory_status' => $inventory_computer->status,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'site' => $inventory_computer->site
                ]);
            }
        }

        $this->info('Data successfully imported from inventory to inspeksi.');
    }
}
