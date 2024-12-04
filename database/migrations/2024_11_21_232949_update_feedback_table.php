<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->integer('restaurant_rating')->default(5)->change();
        $table->string('restaurant_feedback')->nullable()->change(); // Allow NULL
        $table->json('menu_ratings')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->json('menu_ratings')->nullable(false)->change();
        });
    }
};
