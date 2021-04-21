<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocTranslatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_translates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doc_id')->unsigned();
            $table->longText('content');
            $table->timestamps();
            $table->foreign('doc_id')->references('id')->on('docs')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_translates');
    }
}
