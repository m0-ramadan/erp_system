<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Role extends Model
    {
        use HasFactory;

        protected $table = 'roles';

        protected $fillable = [
            'code',
        'name',
        'department_id',
        'description',
        'is_system_role',
        'is_active'
        ];


        protected $casts = [
            'is_system_role' => 'boolean',
        'is_active' => 'boolean'
        ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }
}
