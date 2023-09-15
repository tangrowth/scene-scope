<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->string('img_url')->default('https://scene-scope.s3.ap-northeast-1.amazonaws.com/default.png');
            $table->string('top_img_url')->default('https://scene-scope.s3.ap-northeast-1.amazonaws.com/default.png');
            $table->string('map_img_url')->nullable();
            $table->string('routing_guide', 200)->nullable();
            $table->string('title', 21);
            $table->string('description', 300);
            $table->string('zip')->nullable();
            $table->string('address');
            $table->string('venue');
            $table->string('web_site_url')->nullable();
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('CASCADE');
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
        Schema::dropIfExists('performances');
    }
}
