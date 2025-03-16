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
        Schema::create('phoneme_morphemes', function (Blueprint $table) {
            $table->id()->unsigned(); // `id` as an unsigned BIGINT
            $table->foreignId('phoneme_id')->constrained()->onDelete('cascade');
            $table->foreignId('harakat_id')->constrained()->onDelete('cascade');
            $table->string('structural_entity');
            $table->string('formative_entity');
            $table->string('morpheme_type');
            $table->string('example_word');
            $table->text('example_explanation');
            $table->timestamps(); // automatically adds created_at, updated_at columns
            $table->boolean('deleted_at')->default(0)->comment('0 = active, 1 = deleted'); // Soft delete flag
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('phoneme_morphemes');
    }
};
