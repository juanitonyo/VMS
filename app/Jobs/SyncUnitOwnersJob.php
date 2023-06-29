<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use App\Events\SyncUnitOwnersEvent;
use App\Models\User;
use App\Models\Host;
use App\Models\UserBuildings;
use Illuminate\Support\Facades\Hash;


class SyncUnitOwnersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->data as $item) {

            if (!User::where('email', $item['email'])->exists()) {
                $building_ids = str_replace(['[',']'], '', $item['project_site_ids']);

                $newRecords = User::updateOrCreate(
                    ['proptech_user_id' => $item['model_id']],
                    [
                        'name' => $item['first_name'] .' '.$item['last_name'],
                        'role_id' => 3,
                        'email' => $item['email'],
                        'contact' => $item['mobile'],
                        'password' => Hash::make('password'),
                        'status' => true
                    ]
                );
            
                Host::updateOrCreate(
                    ['user_id' => $newRecords->id],
                    [
                        'first_name' => $item['first_name'],
                        'last_name' => $item['last_name'],
                        'building_id' => $building_ids,
                        'email' => $item['email'],
                        'contact' => $item['mobile'],
                        'location' => $item['full_address'],
                    ]
                );

                UserBuildings::updateOrCreate(
                    ['user_id' => $newRecords->id],
                    [
                        'building_id' => $building_ids,
                    ]
                );
            } else {
                $user = User::where('email', $item['email'])->first();
                $building_ids = str_replace(['[',']'], '', $item['project_site_ids']);

                Host::where('user_id', $user->id)
                    ->update([
                        'first_name' => $item['first_name'],
                        'last_name' => $item['last_name'],
                        'building_id' => $building_ids,
                        'email' => $item['email'],
                        'contact' => $item['mobile'],
                        'location' => $item['full_address'],
                    ]);

                UserBuildings::where('user_id', $user->id)
                    ->update([
                        'building_id' => $building_ids,
                    ]);
            }
        }
       

    }
}
