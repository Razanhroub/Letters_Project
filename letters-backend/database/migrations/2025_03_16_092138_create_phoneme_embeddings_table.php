<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonemeEmbeddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phoneme_embeddings', function (Blueprint $table) {
            $table->id(); // This automatically creates the primary key for 'id'
            $table->foreignId('phoneme_id')->constrained()->default(1)->comment('References the phonemes table, specifically Hamza (ء)');
            $table->foreignId('harakat_id')->constrained()->comment('References the harakats table');
            $table->enum('position', ['beginning', 'middle', 'end', 'sukun'])->comment('موضع الهمزة في الكلمة');
            $table->text('embedding_effect')->comment('التأثير على Embeddings');
            $table->text('phonetic_effect')->comment('التأثير الصوتي');
            $table->text('semantic_change')->comment('التغير الدلالي المحتمل');
            $table->string('examples')->comment('أمثلة');
            $table->timestamps();
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
        Schema::dropIfExists('phoneme_embeddings');
    }
}
