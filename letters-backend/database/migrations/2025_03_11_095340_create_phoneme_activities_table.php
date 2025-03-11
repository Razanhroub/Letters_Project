<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; 

class CreatePhonemeActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phoneme_activities', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('phoneme_id')->unsigned()->default(1)->comment('References the phonemes table, specifically Hamza (ء)');
            $table->string('type', 50)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->comment('نوع الهمزة');
            $table->boolean('is_active')->comment('عامل أم خامل؟');
            $table->text('grammatical_effect')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->comment('التأثير النحوي');
            $table->string('examples', 255)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->comment('أمثلة');
            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            // Foreign key constraint
            $table->foreign('phoneme_id')->references('id')->on('phonemes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phoneme_activities');
    }
}