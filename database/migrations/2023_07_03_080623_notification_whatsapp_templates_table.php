<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NotificationWhatsappTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_whatsapp_templates', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');

            $table->string('name');
            $table->string('description')->nullable();

            $table->string('target')->nullable();
            $table->text('content')->nullable();

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
        Schema::dropIfExists('notification_whatsapp_templates');
    }
}
