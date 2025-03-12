<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToPhonemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phonemes', function (Blueprint $table) {
            // Add the deleted_at column as a boolean with a default value of 0
            $table->boolean('deleted_at')->default(0)->comment('0 = active, 1 = deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phonemes', function (Blueprint $table) {
            // Remove the deleted_at column if rolling back the migration
            $table->dropColumn('deleted_at');
        });
    }
}
