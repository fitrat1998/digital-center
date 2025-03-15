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
        Schema::create('software', function (Blueprint $table) {
            $table->id();
//            $table->string('name_uz');
//            $table->string('name_en');
//            $table->string('name_ru');
            $table->string('title_uz')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_ru')->nullable();
            $table->string('description_uz')->nullable();
            $table->string('description_en')->nullable();
            $table->string('description_ru')->nullable();
            $table->text('photo');
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('category_id')->nullable()->constrained('software_categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('software');
    }
};
