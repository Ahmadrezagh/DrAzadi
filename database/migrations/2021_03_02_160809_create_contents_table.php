<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doc_id')->unique();
            $table->foreign('doc_id')->references('id')->on('docs');
            $table->date('published_date')->nullable();
            $table->date('modified_date')->nullable();
            $table->string('source')->nullable();
            $table->text('current_description')->nullable();
            $table->text('analysis_description')->nullable();
            $table->text('hyperlink')->nullable();
            $table->text('hyperlink_table')->nullable();
            $table->text('technical_table')->nullable();
            $table->text('configurations_table')->nullable();
            $table->text('change_history')->nullable();
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
        Schema::dropIfExists('contents');
    }
}
