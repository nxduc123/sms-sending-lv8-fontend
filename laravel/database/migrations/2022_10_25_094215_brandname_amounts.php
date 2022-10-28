<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BrandnameAmounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brandname_amounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Telco', 20)->comment('Nha mang');
            $table->enum('MsgType', ['cskh', 'qc']);
            $table->float('Amount', 15, 2);
            $table->float('BrandnameFee', 15, 2)->nullable();
            $table->string('Description', 500);
            $table->string('created_by', 50);
            $table->string('updated_by', 50);
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
        Schema::dropIfExists('brandname_amounts');
    }
}
