<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NotificationWhatsappSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_whatsapp_schedules', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');

            $table->string('code')->unique();
            $table->string('title');
            $table->text('description')->nullable();

            $table->string('loop_cycle')->default('MONTHLY'); // EX : DAILY(TIAP HARI), MONTHLY(TIAP BULAN), ANNUALY(TIAP TAHUN), QUARTERLY(TIAP 3 BULAN)
            $table->date('loop_start_date')->nullable();
            $table->time('loop_start_time')->nullable();

            $table->boolean('actived')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_whatsapp_schedules');
    }
}
