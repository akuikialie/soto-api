<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NotificationWhatsappDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_whatsapp_devices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();

            $table->string('phone')->nullable();
            
            $table->string('secret_key')->nullable();
            $table->string('secret_password')->nullable();
            $table->string('secret_token')->nullable();

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
        Schema::dropIfExists('notification_whatsapp_devices');
    }
}
