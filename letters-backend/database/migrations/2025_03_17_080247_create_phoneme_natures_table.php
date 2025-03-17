<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('phoneme_natures', function (Blueprint $table) {
            $table->id();
            $table->string('word', 50)->comment('الكلمة');
            $table->string('root', 50)->comment('الجذر');
            $table->boolean('is_original')->comment('الهمزة أصلية؟');
            $table->boolean('deleted_at')->default(0)->comment('0 = active, 1 = deleted'); // Soft delete flag
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('phoneme_natures');
    }
};
