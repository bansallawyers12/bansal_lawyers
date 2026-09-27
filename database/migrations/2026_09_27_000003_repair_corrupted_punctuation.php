<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * latin1 columns turned em dashes and apostrophes into "???".
     * Convert the public content tables, then restore the marks.
     */
    public function up(): void
    {
        foreach (['blogs', 'cms_pages', 'book_services'] as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            DB::statement("ALTER TABLE `{$table}` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        }

        foreach (['blogs', 'cms_pages', 'book_services', 'recent_cases'] as $table) {
            $this->repairTable($table);
        }
    }

    public function down(): void
    {
        // The original characters were already lost, so the text repair cannot be reversed.
    }

    private function repairTable(string $table): void
    {
        if (! Schema::hasTable($table) || ! Schema::hasColumn($table, 'id')) {
            return;
        }

        $columns = collect(Schema::getColumns($table))
            ->filter(function (array $column) {
                $type = strtolower($column['type_name'] ?? $column['type'] ?? '');

                return str_contains($type, 'char') || str_contains($type, 'text');
            })
            ->pluck('name');

        DB::table($table)->orderBy('id')->chunkById(50, function ($rows) use ($table, $columns) {
            foreach ($rows as $row) {
                $updates = [];

                foreach ($columns as $column) {
                    $value = $row->{$column} ?? null;
                    if (! is_string($value) || ! str_contains($value, '???')) {
                        continue;
                    }

                    $fixed = str_replace(' ??? ', ' — ', $value);
                    $fixed = str_replace('???', "'", $fixed);
                    if ($fixed !== $value) {
                        $updates[$column] = $fixed;
                    }
                }

                if ($updates !== []) {
                    DB::table($table)->where('id', $row->id)->update($updates);
                }
            }
        });
    }
};
