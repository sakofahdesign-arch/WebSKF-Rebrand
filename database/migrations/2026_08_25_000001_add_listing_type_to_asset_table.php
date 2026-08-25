<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('asset')) {
            return;
        }

        Schema::table('asset', function (Blueprint $table) {
            if (! Schema::hasColumn('asset', 'listing_type')) {
                $table->string('listing_type', 20)->default('sale')->after('asset_type');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('asset') || ! Schema::hasColumn('asset', 'listing_type')) {
            return;
        }

        Schema::table('asset', function (Blueprint $table) {
            $table->dropColumn('listing_type');
        });
    }
};
