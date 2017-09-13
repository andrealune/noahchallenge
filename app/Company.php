<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name','path','tagline','url','website_url','twitter_url','facebook_url','linkedin_url','google_url','crunchbase_url','angellist_url','playmarket_app_id','appstore_app_id','address','employees','twitter_followers','industries'];

    public $timestamps = false;
}
