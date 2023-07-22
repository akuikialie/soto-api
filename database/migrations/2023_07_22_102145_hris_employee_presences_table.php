<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HrisEmployeePresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hris_employee_presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hris_employee_id')->nullable()->constrained();
            $table->uuid('uuid')->default(DB::raw('UUID()'));

            $table->date('presence_date');
            $table->string('presence_type')->default('ATTEND')->comment('ATTEND/SICK/ALPHA/PERMISSION');
            $table->boolean('drafted')->default(false);
            $table->boolean('actived')->default(false);

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
        Schema::dropIfExists('hris_employee_presences');
    }
}
