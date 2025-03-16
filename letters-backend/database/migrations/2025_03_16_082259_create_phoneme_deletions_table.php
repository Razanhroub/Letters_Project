<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phoneme_deletions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('phoneme_id')->constrained('phonemes')->onDelete('cascade')->comment('References phonemes table');
            $table->string('deleted_letter', 10)->comment('الحرف المحذوف');
            $table->text('deletion_cause')->comment('سبب الحذف');
            $table->text('effect')->comment('التأثير');
            $table->string('examples', 255)->comment('أمثلة');
            $table->text('notes')->nullable()->comment('ملاحظات');
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
        Schema::dropIfExists('phoneme_deletions');
    }
};
