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
        Schema::create('finances', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('proj_name');
            $table->unsignedBigInteger('benifit_comp_id');//الجهة المستفيدة
            $table->foreign('benifit_comp_id')->references('id')->on('govers')->onDelete('cascade');
            $table->string('assig_year');
            $table->decimal('proj_cost');
            $table->string('fina_type');
            $table->string('fina_classfic');
            $table->integer('fina_amnt_loc');
            $table->integer('fina_amnt_for');
            $table->integer('Value_Status');
            $table->softDeletes();
            $table->string('notes')->nullable();
            $table->string('Created_by');
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
        Schema::dropIfExists('finances');
    }
};
