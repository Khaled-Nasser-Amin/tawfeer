<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{

    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('slug');
            $table->string('image');
            /*$table->string('type');
            $table->bigInteger('parent_id')->unsigned()->nullable();*/
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
