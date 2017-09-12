<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use Exception;

class ImportDealRoomCompanies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @param max:integer Number of maximum record to retrieve from source     
     * @var string
     */
    protected $signature = 'dealroom:import {max  : Number of maximum record to retrieve from source}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import All data from companies provided by DealRoom Service';


    /**
     * List of fields to retrieve
     *
     * Hint: industries and last_updated needs casting
     *
     * @var array
     */
    protected $fields = ['id','name','path','tagline','url','website_url','twitter_url','facebook_url','linkedin_url','google_url','crunchbase_url','angellist_url','playmarket_app_id','appstore_app_id','address','employees','twitter_followers','industries','last_updated'];


    /**
     * DealRoom API endpoint
     *
     * @var string
     */
    private $endpoint = 'https://api.dealroom.co/api/v1/companies';

    /**
     * DealRoom API token
     *
     * @var string
     */
    private $token;

    /**
     * DealRoom API password
     *
     * @var string
     */
    private $password;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->token = env('DEALROOM_TOKEN');
        $this->password = env('DEALROOM_PWD');
    }

    public function execute_curl($url)
    {
        $ch = curl_init($url);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $this->token);
        $output = curl_exec ($ch);
        //$info = curl_getinfo($ch);
        //$http_result = $info ['http_code'];
        curl_close ($ch);

        return $output;
    }

    public function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {    

        $this->info('Start import...');

       
    }
}
