<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HrisEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hris_employees', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('UUID()'));
            
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('whatsapp_phone')->nullable();

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
        Schema::dropIfExists('hris_employees');
    }
}
