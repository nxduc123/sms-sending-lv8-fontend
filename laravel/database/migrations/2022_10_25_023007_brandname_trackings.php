<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BrandnameTrackings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brandname_trackings', function (Blueprint $table) {
            $table->bigIncrements('Id')->index();
            $table->smallInteger('PartnerId')->comment('ID FPT cung cap cho doi tac');
            $table->string('BrandName', 11)->comment('BrandName su dung');
            $table->string('Telco', 20)->comment('Nha mang');
            $table->string('Phone', 20);
            $table->string('Message', 1500);
            $table->string('MessageEnc', 1500)->nullable();
            $table->enum('MsgType', ['cskh', 'qc']);
            $table->dateTime('SendingTime')->index()->comment('Thoi gian gui tin nhan di');
            $table->tinyInteger('MsgCount')->comment('So tin nhan gui den KHG, 160 ki tu/tin');
            $table->dateTime('SentTime')->comment('Thoi gian gui tin nhan du kien');
            $table->tinyInteger('IsSent')->comment('Trang thai gui tin di, 1 Success, 0 Fail');
            $table->string('ErrorCode', 100)->nullable()->comment('Ma loi tra ve');
            $table->tinyInteger('Status')->nullable()->comment('1 Success send to FPT, -11 Pending, -13 Fail');
            $table->string('CampaignCode', 50)->nullable();
            $table->string('BatchId', 50)->nullable();
            $table->string('TmpID', 50)->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brandname_trackings');
    }
}
