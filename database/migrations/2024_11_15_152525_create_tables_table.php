<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesTable extends Migration
{
    public function up()
    {
        // Schema::create('tables', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('table_name');
        //     $table->integer('members');
        //     $table->string('location');
        //     $table->string('location_image')->nullable();
        //     $table->text('features')->nullable();
        //     $table->boolean('availability')->default(true);
        //     $table->timestamps();
        // });

        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('table_name');
            $table->integer('members');
            $table->string('location');
            $table->string('location_image')->nullable();
            $table->string('features')->nullable(); // Add this line for 'features'
            $table->timestamps();
        });









    }

    public function down()
    {
        Schema::dropIfExists('tables');
    }
}
