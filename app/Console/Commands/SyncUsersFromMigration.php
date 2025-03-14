<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncUsersFromMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:user_alls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting sync process...');

        $users = DB::table('migration_user')
            ->whereNull('nonactive_date')
            ->get();

        foreach ($users as $user) {
            $existingUser = DB::table('user_alls')->where('nrp', $user->nrp)->first();

            if ($existingUser) {
                // Update jika sudah ada
                DB::table('user_alls')
                    ->where('nrp', $user->nrp)
                    ->update([
                        'username' => $user->nama,
                        'department' => $user->dept,
                        'position' => $user->jabatan,
                        'email' => $user->email,
                        'site' => $user->site,
                        'updated_at' => now(),
                    ]);

                $this->info("Updated user: {$user->nrp} - {$user->nama}");
            } else {
                // Insert jika belum ada
                DB::table('user_alls')->insert([
                    'nrp' => $user->nrp,
                    'username' => $user->nama,
                    'department' => $user->dept,
                    'position' => $user->jabatan,
                    'email' => $user->email,
                    'site' => $user->site,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $this->info("Inserted new user: {$user->nrp} - {$user->nama}");
            }
        }

        $this->info('Sync process completed.');
    }
}
