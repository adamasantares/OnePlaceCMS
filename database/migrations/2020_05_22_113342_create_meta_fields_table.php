<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->string('type', 255);
            $table->unsignedInteger('meta_content_id')->nullable();
            $table->foreign('meta_content_id')
                ->references('id')
                ->on('meta_contents')
                ->onDelete('cascade');
            $table->integer("order");
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
        Schema::dropIfExists('meta_fields');
    }
}
