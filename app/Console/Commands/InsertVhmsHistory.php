<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HistoricalVhmsDownload;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class InsertVhmsHistory extends Command
{
    protected $signature = 'vhms:insert-history';
    protected $description = 'Insert daily historical VHMS data into database';

    public function handle()
    {
        $sites = ['ba', 'mifa', 'mhu', 'adw', 'ami', 'pik', 'bge', 'bib', 'ipt', 'mlp', 'mip', 'vib', 'sbs', 'sks'];
        // $sites = ['ba', 'mifa', 'bib'];

        foreach ($sites as $site) {
            $url = "https://api50.ppa-{$site}.net/vhms/downloader/monitoring";

            try {
                $response = Http::get($url);

                if (!$response->successful()) {
                    // log bad HTTP status if needed
                    logger()->warning("VHMS HTTP error", [
                        'site' => $site,
                        'status' => $response->status(),
                    ]);
                    continue;
                }

                $data = $response->json('data');
                $now = Carbon::now();
                $date = $now->toDateString();

                foreach ($data as $category => $units) {
                    foreach ($units as $unit) {
                        $status = match ($unit['color']) {
                            0 => 'update',
                            1 => 'waiting',
                            2 => 'not_update',
                            default => 'unknown'
                        };

                        HistoricalVhmsDownload::create([
                            'sn' => $unit['sn'],
                            'cn' => $unit['cn'],
                            'model' => $unit['model'],
                            'status' => $status,
                            'last_download' => !empty($unit['last_download']) ? $unit['last_download'] : null,
                            'last_operation' => !empty($unit['last_operation']) ? $unit['last_operation'] : null,
                            'pld_last_record' => !empty($unit['pld_last_record']) ? Carbon::parse($unit['pld_last_record']) : null,
                            'trend_last_record' => !empty($unit['trend_last_record']) ? Carbon::parse($unit['trend_last_record']) : null,
                            'fault_last_record' => !empty($unit['fault_last_record']) ? Carbon::parse($unit['fault_last_record']) : null,
                            'his_last_record' => !empty($unit['his_last_record']) ? Carbon::parse($unit['his_last_record']) : null,
                            'last_histori' => isset($unit['created_date']) ? Carbon::parse($unit['his_last_record']) : null,
                            'date' => $date,
                            'month' => (int) $now->format('m'),
                            'year' => (int) $now->format('Y'),
                            'site' => strtoupper($site),
                        ]);

                    }
                }

            } catch (\Throwable $e) {
                // Handles cURL error 6 and ANY network failure
                logger()->error("VHMS request failed", [
                    'site' => $site,
                    'error' => $e->getMessage(),
                ]);

                continue; // IMPORTANT: do not fail the command
            }
        }

    }
}
