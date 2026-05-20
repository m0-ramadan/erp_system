<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class UserPermission extends Model
    {
        use HasFactory;

        protected $table = 'user_permissions';

        protected $fillable = [
            'user_id',
        'permission_id',
        'allowed'
        ];


        protected $casts = [
            'allowed' => 'boolean'
        ];

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = null;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
