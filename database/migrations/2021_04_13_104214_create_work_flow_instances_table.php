<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkFlowInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * preview_url

    workflow_id

     */
    public function up()
    {
        Schema::create('work_flow_instances', function (Blueprint $table) {

            $table->id();

            $table->string('preview_url')->nullable();
            $table->integer('workflow_id')->nullable();

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
        Schema::dropIfExists('work_flow_instances');
    }
}
