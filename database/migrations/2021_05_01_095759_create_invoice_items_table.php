<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id')->nullable();

            $table->string('HSCode')->nullable();
            $table->string('Category')->nullable();
            $table->string('HSDesc')->nullable();
            $table->string('Quantity')->nullable();
            $table->string('UnitPrice')->nullable();
            $table->string('ItemAmount')->nullable();
            $table->string('TaxRate')->nullable();
            $table->string('TaxAmount')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}
