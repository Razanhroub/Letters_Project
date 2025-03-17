<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('phoneme_origins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phoneme_id')->default(1)->comment('References the phonemes table, specifically Hamza (ء)');
            $table->string('function', 100)->comment('الوظيفة الصرفية');
            $table->text('effect_on_word')->comment('التأثير على الكلمة');
            $table->string('examples', 255)->comment('أمثلة');
            $table->text('explanation')->comment('التفسير');
            $table->boolean('deleted_at')->default(0)->comment('0 = active, 1 = deleted'); // Soft delete flag
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('phoneme_origins');
    }
};
