<?php

use App\Models\GiftOption;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gift_options', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', [GiftOption::TYPE_BOX, GiftOption::TYPE_ADDON, GiftOption::TYPE_CARD]);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('image_path')->nullable();
            $table->string('icon', 120)->nullable();
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gift_options');
    }
};
