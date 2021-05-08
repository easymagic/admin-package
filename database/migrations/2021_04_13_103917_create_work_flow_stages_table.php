<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkFlowStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * workflow_id
    stage_name
    position
    type
    user_id
    workflow_group_id

     */
    public function up()
    {
        Schema::create('work_flow_stages', function (Blueprint $table) {

            $table->id();

            $table->integer('workflow_id')->nullable();
            $table->string('stage_name')->nullable();
            $table->integer('position')->nullable();
            $table->string('type')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('workflow_group_id')->nullable();

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
        Schema::dropIfExists('work_flow_stages');
    }
}
