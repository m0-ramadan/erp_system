<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Permission extends Model
    {
        use HasFactory;

        protected $table = 'permissions';

        protected $fillable = [
            'code',
        'name',
        'module',
        'description'
        ];

    public $timestamps = false;

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_permissions')->withPivot('allowed');
    }
}
