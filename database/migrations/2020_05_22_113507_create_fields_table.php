<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('content_id')->nullable();
            $table->foreign('content_id')
                ->references('id')
                ->on('contents')
                ->onDelete('cascade');
            $table->unsignedInteger('meta_field_id')->nullable();
            $table->foreign('meta_field_id')
                ->references('id')
                ->on('meta_fields')
                ->onDelete('cascade');
            $table->longText('value');
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
        Schema::dropIfExists('fields');
    }
}
