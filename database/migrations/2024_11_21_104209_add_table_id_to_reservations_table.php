<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_table_id_to_reservations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableIdToReservationsTable extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Add the 'table_id' column (foreign key to the 'tables' table)
            $table->unsignedBigInteger('table_id')->nullable();  // nullable in case no table is selected yet

            // Optionally, if you want to ensure that this column references the 'id' column in the 'tables' table
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['table_id']); // Drop foreign key constraint
            $table->dropColumn('table_id');    // Drop the column
        });
    }
}
