<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use App\Models\Football\Location;
use DB;
use Schema;

class UpdateNationalities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:nations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'loads nations from storage folder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $locations = scandir(Storage::path('locations'));
        if ($locations){
            DB::transaction(function () use($locations){
                Schema::disableForeignKeyConstraints();
                Location::truncate();
                Schema::enableForeignKeyConstraints();
                foreach ($locations as $location){
                    $name = substr($location, 0, strpos($location, '.png'));
                    if (!$name){
                        continue;
                    }
                    Location::create([
                     'name' => $name,
                     'flagURL' => Storage::url("locations/$location")
                    ]);
                    $this->info("$name was saved");
                }
            });
        }
    }
}
