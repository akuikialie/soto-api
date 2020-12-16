<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_id')
                ->nullable();
            $table->foreignId('vendor_id')
                ->nullable();
            $table->date('date_at');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['debit', 'credit']);
            $table->float('amount', 8, 0);
            $table->enum('status', ['draft', 'process', 'done']);
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
        Schema::dropIfExists('transactions');
    }
}
