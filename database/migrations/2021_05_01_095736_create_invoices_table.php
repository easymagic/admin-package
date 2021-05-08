<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
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
            $table->integer('batch_id')->nullable();

            $table->string('TraderSystemInvoiceNumber')->nullable();
            $table->string('MiddlewareInvoiceNumber')->nullable();
            $table->string('RelevantInvoiceNumber')->nullable();
            $table->string('InvoiceDate')->nullable();
            $table->string('PINOfBuyer')->nullable();
            $table->string('Discount')->nullable();
            $table->string('InvoiceType')->nullable();
            $table->string('InvoiceCategory')->nullable();
            $table->string('TotalInvoiceAmount')->nullable();
            $table->string('TotalTaxableAmount')->nullable();
            $table->string('TotalTaxAmount')->nullable();
            $table->string('ExemptionNumber')->nullable();
            $table->string('QRCode')->nullable();


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
        Schema::dropIfExists('invoices');
    }
}
