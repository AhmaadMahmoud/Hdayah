<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('gift_options', function (Blueprint $table) {
            $table->unsignedBigInteger('gift_option_type_id')->nullable()->after('id');
            $table->foreign('gift_option_type_id')->references('id')->on('gift_option_types')->cascadeOnDelete();
        });

        foreach (['box', 'addon', 'card'] as $slug) {
            $typeId = DB::table('gift_option_types')->where('slug', $slug)->value('id');
            if ($typeId) {
                DB::table('gift_options')->where('type', $slug)->update(['gift_option_type_id' => $typeId]);
            }
        }

        Schema::table('gift_options', function (Blueprint $table) {
            $table->dropColumn('type');
        });
        Schema::table('gift_options', function (Blueprint $table) {
            $table->unsignedBigInteger('gift_option_type_id')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('gift_options', function (Blueprint $table) {
            $table->dropForeign(['gift_option_type_id']);
        });
        Schema::table('gift_options', function (Blueprint $table) {
            $table->string('type', 32)->after('id');
        });
    }
};
