<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Telcos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telcos', function (Blueprint $table) {
            $table->integer('Prefix')->comment('Dau so cua cac telco');
            $table->string('Telco', 20)->comment('Telco');
            $table->primary(array('Prefix', 'Telco'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telcos');
    }
}
