<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Campaign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->index();
            $table->string('name');
            $table->enum('type', ['cskh', 'qc']);
            $table->tinyInteger('approval_status');
            $table->tinyInteger('status')->default(0);
            $table->timestamp('approval_at')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('campaign');
    }
}
