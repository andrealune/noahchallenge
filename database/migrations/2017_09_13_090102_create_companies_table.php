<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("companies", function(Blueprint $t) {
            $t->increments("id")->unsigned();
            $t->string("name")->index();
            $t->string("path");
            $t->string("tagline")->nullable();
            $t->string("url")->nullable();
            $t->string("website_url")->nullable();
            $t->string("twitter_url")->nullable();
            $t->string("facebook_url")->nullable();
            $t->string("linkedin_url")->nullable();
            $t->string("google_url")->nullable();
            $t->string("crunchbase_url")->nullable();
            $t->string("angellist_url")->nullable();
            $t->string("playmarket_app_id")->nullable();
            $t->string("appstore_app_id")->nullable();
            $t->string("address")->nullable();
            $t->string("employees")->nullable();
            $t->string("twitter_followers")->nullable();
            $t->string("industries")->nullable();
            $t->timestamp("last_updated");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("companies");
    }
}
