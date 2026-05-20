<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class FileType extends Model
    {
        use HasFactory;

        protected $table = 'file_types';

        protected $fillable = [
            'code',
        'name',
        'allowed_extensions',
        'max_size_mb',
        'is_active'
        ];


        protected $casts = [
            'is_active' => 'boolean'
        ];

    public $timestamps = false;

    public function requestFiles()
    {
        return $this->hasMany(RequestFile::class);
    }

    public function quotationFiles()
    {
        return $this->hasMany(QuotationFile::class);
    }
}
