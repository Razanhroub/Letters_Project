<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('phoneme_functions', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->foreignId('phoneme_id')->default(1)->constrained('phonemes')->comment('References the phonemes table, specifically Hamza (ء)');
            $table->foreignId('harakat_id')->constrained('harakats')->comment('References the harakats table');
            $table->enum('position', ['beginning', 'middle', 'end', 'sukun'])->comment('موضع الهمزة في الكلمة');
            $table->text('grammatical_function')->comment('الوظيفة النحوية');
            $table->text('morphological_effect')->comment('التأثير الصرفي');
            $table->text('semantic_effect')->comment('التأثير الدلالي');
            $table->string('examples', 255)->comment('أمثلة');
            $table->boolean('deleted_at')->default(0)->comment('0 = active, 1 = deleted'); // Soft delete flag
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phoneme_functions');
    }
};
