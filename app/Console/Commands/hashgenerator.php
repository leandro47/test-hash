<?php

namespace App\Console\Commands;

use App\Http\Controllers\HashController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class hashgenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hash:generator {string} {--request=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $string = $this->argument('string');
        for ($i = 0; $i < $this->option('request'); $i++) {
            $searchHash = Http::post(
                env('APP_URL') . 'store',
                ['text' => $string]
            );

            if ($searchHash->failed()) {
                dd($searchHash->body());
            }
            $string = $searchHash->body();
            $this->error($searchHash->body());
        }
        
        dd($searchHash->body());
    }
}
