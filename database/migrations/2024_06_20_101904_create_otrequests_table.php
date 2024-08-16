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
        Schema::create('otrequests', function (Blueprint $table) {
            $table->id();
            $table->string('department_name');
            $table->string('department');
            $table->string('ot_member_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('total_date');
            $table->string('status');
            $table->string('create_name');
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
        Schema::dropIfExists('otrequests');
    }
};
