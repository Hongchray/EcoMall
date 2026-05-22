<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStateTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('state_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('state_id');
            $table->string('name');
            $table->string('lang', 10);
            $table->timestamps();

            $table->unique(['state_id', 'lang']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('state_translations');
    }
}
