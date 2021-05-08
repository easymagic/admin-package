<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkFlowInstanceStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * workflow_instance_id
    workflow_stage_id
    notes
    status
     *
     */
    public function up()
    {
        Schema::create('work_flow_instance_stages', function (Blueprint $table) {

            $table->id();

            $table->integer('workflow_instance_id')->nullable();
            $table->integer('workflow_stage_id')->nullable();
            $table->text('notes')->nullable();
            $table->integer('status')->nullable();

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
        Schema::dropIfExists('work_flow_instance_stages');
    }
}
