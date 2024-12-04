<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');                  // Menu Name
            $table->decimal('price', 8, 2);         // Price
            $table->text('description')->nullable(); // Description
            $table->text('ingredients')->nullable(); // Ingredients
            $table->boolean('is_veg')->default(1);  // Veg/Non-Veg Classification
            $table->string('image')->nullable();    // Image Path
            $table->timestamps();                   // Created/Updated At
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
