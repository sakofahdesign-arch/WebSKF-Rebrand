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
            if (! Schema::hasColumn('asset', 'latitude')) {
                $table->decimal('latitude', 10, 7)->nullable()->after('asset_type');
            }

            if (! Schema::hasColumn('asset', 'longitude')) {
                $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            }

            if (! Schema::hasColumn('asset', 'deed_file')) {
                $table->string('deed_file')->nullable()->after('picture_name');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('asset')) {
            return;
        }

        Schema::table('asset', function (Blueprint $table) {
            foreach (['deed_file', 'longitude', 'latitude'] as $column) {
                if (Schema::hasColumn('asset', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
