<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phonemes', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('char', 1)->nullable();
            $table->string('Symbol', 10)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('Type', 50)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('Voicing', 20)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('PlaceManner', 50)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable();
            $table->double('Duration', 8, 2)->nullable();
            $table->timestamp('TimestampCreated')->nullable();
            $table->timestamps();
            $table->string('windows_1256_hex', 20)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable();
            $table->integer('windows_1256_decimal')->nullable();
            $table->string('unicode_hex', 20)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable();
            $table->integer('unicode_decimal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phonemes');
    }
}