<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_early')->default(false);
            $table->float('amount');
            $table->date('invoice_date');
            $table->bigInteger('quantity')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('cake_id')->unsigned();
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->cascadeOnDelete();
            $table->foreign('cake_id')
                ->references('id')
                ->on('cakes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
