<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonemeGrammaticalRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phoneme_grammatical_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phoneme_id')->default(1)->comment('References the phonemes table, specifically Hamza (ء)');
            $table->unsignedBigInteger('harakat_id')->comment('References the harakats table');
            $table->enum('position', ['beginning', 'middle', 'end', 'sukun'])->comment('موضع الهمزة في الكلمة');
            $table->text('grammatical_role')->comment('الدور النحوي');
            $table->text('grammatical_change')->comment('التغير النحوي المحتمل');
            $table->string('examples')->comment('أمثلة');
            $table->boolean('deleted_at')->default(0)->comment('0 = active, 1 = deleted'); // Soft delete flag
            $table->timestamps();
            
            // Foreign keys (assuming you have `phonemes` and `harakats` tables)
            $table->foreign('phoneme_id')->references('id')->on('phonemes')->onDelete('cascade');
            $table->foreign('harakat_id')->references('id')->on('harakats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phoneme_grammatical_roles');
    }
}
