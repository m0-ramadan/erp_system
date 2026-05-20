<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class RequestFile extends Model
    {
        use HasFactory;

        protected $table = 'request_files';

        protected $fillable = [
            'quote_request_id',
        'file_type_id',
        'uploaded_by',
        'original_name',
        'stored_name',
        'file_path',
        'mime_type',
        'size_bytes',
        'notes',
        'uploaded_at'
        ];


        protected $casts = [
            'uploaded_at' => 'datetime'
        ];

    public $timestamps = false;

    public function quoteRequest()
    {
        return $this->belongsTo(QuoteRequest::class);
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
