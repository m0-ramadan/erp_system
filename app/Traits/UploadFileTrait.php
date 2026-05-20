<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadFileTrait
{
    protected string $disk = 'public';

    protected function uploadFile(UploadedFile $file, string $folder = 'uploads', ?string $name = null): string
    {
        $fileName = $name
            ? $name . '.' . $file->getClientOriginalExtension()
            : now()->format('YmdHis') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

        return $file->storeAs($folder, $fileName, $this->disk);
    }

    protected function deleteFile(?string $path): void
    {
        if (! $path) {
            return;
        }

        $path = str_replace(['/storage/', asset('storage') . '/'], '', $path);

        if (Storage::disk($this->disk)->exists($path)) {
            Storage::disk($this->disk)->delete($path);
        }
    }

    protected function validateFileExtension(UploadedFile $file, array $allowedExtensions): bool
    {
        return in_array(strtolower($file->getClientOriginalExtension()), $allowedExtensions, true);
    }

    protected function validateFileSizeMb(UploadedFile $file, int $maxSizeMb): bool
    {
        return ($file->getSize() / 1024 / 1024) <= $maxSizeMb;
    }
}
