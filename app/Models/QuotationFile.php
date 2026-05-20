<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class QuotationFile extends Model
    {
        use HasFactory;

        protected $table = 'quotation_files';

        protected $fillable = [
            'quotation_id',
        'quotation_version_id',
        'file_type_id',
        'uploaded_by',
        'original_name',
        'stored_name',
        'file_path',
        'mime_type',
        'size_bytes',
        'uploaded_at'
        ];


        protected $casts = [
            'uploaded_at' => 'datetime'
        ];

    public $timestamps = false;

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function quotationVersion()
    {
        return $this->belongsTo(QuotationVersion::class);
    }

    public function fileType()
    {
        return $this->belongsTo(FileType::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
