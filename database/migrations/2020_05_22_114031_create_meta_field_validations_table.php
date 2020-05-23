<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaFieldValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_field_validations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('value', 255);
            $table->unsignedInteger('meta_field_id')->nullable();
            $table->foreign('meta_field_id')
                ->references('id')
                ->on('contents')
                ->onDelete('cascade');
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
        Schema::dropIfExists('meta_field_validations');
    }
}
