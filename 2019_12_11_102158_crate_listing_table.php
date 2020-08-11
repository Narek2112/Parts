<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrateListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('title');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listing');
    }
}
