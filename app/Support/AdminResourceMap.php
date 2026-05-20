<?php

namespace App\Support;

class AdminResourceMap
{
    public static function all(): array
    {
        static $map;

        if ($map !== null) {
            return $map;
        }

        $sourcePath = resource_path('views/Admin/_components/resource-map.blade.php');
        $compiler = app('blade.compiler');
        $compiledPath = $compiler->getCompiledPath($sourcePath);

        if (! file_exists($compiledPath)) {
            $compiler->compile($sourcePath);
        }

        $map = (static function (string $compiledPath): array {
            $qwResourceMap = [];

            include $compiledPath;

            return $qwResourceMap ?? [];
        })($compiledPath);

        return $map;
    }
}
