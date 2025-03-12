<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('phoneme_characteristics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phoneme_id')->constrained()->onDelete('cascade');
            $table->enum('position', ['beginning', 'middle', 'end'])->comment('Position in the word');
            $table->string('place_of_articulation', 50)->nullable()->comment('مكان النطق');
            $table->string('manner_of_articulation', 50)->nullable()->comment('طريقة النطق');
            $table->boolean('voiced')->nullable()->comment('مجهور (1) / مهموس (0)');
            $table->boolean('emphasis')->nullable()->comment('مفخم (1) / مرقق (0)');
            $table->string('duration', 20)->nullable()->comment('الطول: قصيرة، متوسطة');
            $table->string('pitch', 20)->nullable()->comment('النغمة');
            $table->string('independent_or_connected', 20)->nullable()->comment('مستقل أو مرتبط بالنطق');
            $table->string('pressure_level', 50)->nullable()->comment('الضغط الصوتي');
            $table->string('resonance_frequency', 50)->nullable()->comment('التردد الصوتي');
            $table->string('force_and_depth', 50)->nullable()->comment('القوة والعمق');
            $table->text('phonetic_influence')->nullable()->comment('التأثير الصوتي');
            $table->string('extra_or_original', 10)->nullable()->comment('زائد أو أصلي');
            $table->text('articulation_influence')->nullable()->comment('تأثير الشفاه أو الجهر والتفخيم');
            $table->enum('consonant_or_vowel', ['صحيح', 'معتل'])->default('صحيح')->comment('هل الحرف صحيح أم معتل');
            $table->boolean('deleted_at')->default(0)->comment('0 = active, 1 = deleted');  
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('phoneme_characteristics');
    }
};
