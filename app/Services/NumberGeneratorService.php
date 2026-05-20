<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class NumberGeneratorService
{
    public function generate(string $modelClass, string $column, string $prefix, int $pad = 5): string
    {
        /** @var Model $model */
        $model = new $modelClass;
        $lastValue = $modelClass::query()
            ->where($column, 'like', $prefix . '-%')
            ->orderByDesc('id')
            ->value($column);

        $next = 1;
        if ($lastValue && preg_match('/(\d+)$/', $lastValue, $matches)) {
            $next = ((int) $matches[1]) + 1;
        }

        return $prefix . '-' . str_pad((string) $next, $pad, '0', STR_PAD_LEFT);
    }
}
