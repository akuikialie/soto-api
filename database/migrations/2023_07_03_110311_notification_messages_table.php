<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NotificationMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_messages', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('code')->unique();

            $table->foreignId('notification_whatsapp_device_id')->nullable()->constrained();
            $table->foreignId('notification_whatsapp_template_id')->nullable()->constrained();
            $table->foreignId('notification_target_group_id')->nullable()->constrained();
            $table->foreignId('notification_target_id')->nullable()->constrained();

            $table->string('subject');
            $table->text('content');
            $table->datetime('scheduled_at')->nullable();

            $table->boolean('actived')->default(true);
            $table->datetime('requested_at')->nullable();
            $table->datetime('sent_at')->nullable();

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
        Schema::dropIfExists('notification_messages');
    }
}
