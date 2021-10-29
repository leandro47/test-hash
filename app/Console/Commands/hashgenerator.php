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
    protected $signature = 'hash:search {text} {--requests=}';

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
     * @return void
     */
    public function handle(): void
    {
        $text = $this->argument('text');
        $option = $this->option('requests');

        $url = env('APP_URL') . 'hash/build';
        
        for ($i = 0; $i < $option; $i++) {
            $data = ['text' => $text];

            $response = Http::post(
                $url, $data
            );

            if ($response->failed()) {
                $this->error($response->status() . ' ' . $response->body());
                break;
            }

            $text = $response->json('hash_found');
        }
        
        $this->info('Command executed!');
    }
}
