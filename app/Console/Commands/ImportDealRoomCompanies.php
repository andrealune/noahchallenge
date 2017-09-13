<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use Exception;
use App\Company;

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

        $response = $this->execute_curl($this->endpoint);

        $response = json_decode($response);

        if (! isset($response->items)) {
            $this->info('No items avalaible for this call');
            die();
        }

        $companies = $response->items;

        // Iterate each company received
        foreach($companies as $company) {
            // Start a manual intersect for company fields
            $companyData = [
                "name" => $company->name ? : null,
                "path" => $company->path ? : null,
                "tagline" => $company->tagline ? : null,
                "address" => isset($company->hq_locations[0]->address) ? $company->hq_locations[0]->address : null,
                "employees" => $company->employees ? : null,
                "last_updated" => $company->last_updated ? : null,
            ];

            // Here we insert a new company with retrieved fields first checking if already exists
            // We use "find()" instead "firstOrCreate()" because some fields could be different than
            // the one already saved, so we just compare id. 
            // A possible update could be done here.
            if (Company::find($company->id)) continue;
            $company = Company::create($companyData);

            // Append here the id to the saved model since this field is not mass assignable
            $company->id = $company->id;
            $company->save();

            $this->info("Company {$company->name} successfully inserted");
        }

        $this->info(PHP_EOL);
        $this->info("Your requested {$this->argument('max')} companies were successfully inserted!");
    }
}
