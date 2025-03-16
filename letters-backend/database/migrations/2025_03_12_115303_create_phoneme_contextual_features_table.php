<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonemeContextualFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phoneme_contextual_features', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->foreignId('phoneme_id')->constrained('phonemes')->default(1)->comment('References the phonemes table, specifically Hamza (ء)');
            $table->foreignId('harakat_id')->constrained('harakats')->comment('References the harakats table');
            $table->enum('position', ['beginning', 'middle', 'end', 'sukun'])->comment('موضع الهمزة في الكلمة');
            $table->text('contextual_effect')->comment('التأثير السياقي');
            $table->text('phonetic_change')->comment('التغير الصوتي المحتمل');
            $table->text('semantic_change')->comment('التغير الدلالي المحتمل');
            $table->string('examples', 255)->comment('أمثلة');
            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean('deleted_at')->default(0)->comment('0 = active, 1 = deleted'); // Soft delete flag
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phoneme_contextual_features');
    }
}
