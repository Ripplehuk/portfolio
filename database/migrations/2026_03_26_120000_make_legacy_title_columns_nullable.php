<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Legacy single-language title columns left behind after introducing
     * title_en/title_uz. Keep them for compatibility, but stop requiring them.
     *
     * @var array<int, string>
     */
    private array $tables = [
        'publications',
        'events',
        'achievements',
        'academic_degrees',
        'gallery_items',
    ];

    public function up(): void
    {
        foreach ($this->tables as $table) {
            if (! Schema::hasTable($table) || ! Schema::hasColumn($table, 'title')) {
                continue;
            }

            DB::statement(sprintf(
                'ALTER TABLE `%s` MODIFY `title` VARCHAR(255) NULL',
                $table
            ));
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $table) {
            if (! Schema::hasTable($table) || ! Schema::hasColumn($table, 'title')) {
                continue;
            }

            DB::statement(sprintf(
                'ALTER TABLE `%s` MODIFY `title` VARCHAR(255) NOT NULL',
                $table
            ));
        }
    }
};
