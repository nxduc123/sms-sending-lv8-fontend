<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TemplateAllCollumType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template', function (Blueprint $table) {
            $table->enum('type', ['cskh', 'qc'])->default('cskh')->after('template');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template', function (Blueprint $table) {
            //
        });
    }
}
