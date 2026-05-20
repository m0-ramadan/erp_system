<?php

    namespace App\Http\Controllers\Admin;

    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends AdminCrudController
    {
        protected string $modelClass = User::class;
        protected string $viewPath = 'Admin.users';
        protected array $with = ['department', 'roles'];
        protected array $searchable = ['employee_code', 'name', 'email', 'phone'];
        protected array $filterable = ['department_id', 'is_active', 'manager_user_id'];
        protected array $storeRules = [
        'employee_code' => 'nullable|string|max:80|unique:users,employee_code',
        'name' => 'required|string|max:180',
        'email' => 'required|email|max:180|unique:users,email',
        'phone' => 'nullable|string|max:50',
        'password' => 'nullable|string|min:6',
        'department_id' => 'nullable|exists:departments,id',
        'manager_user_id' => 'nullable|exists:users,id',
        'is_active' => 'nullable|boolean',
        ];
        protected array $updateRules = [
        'employee_code' => 'nullable|string|max:80',
        'name' => 'required|string|max:180',
        'email' => 'required|email|max:180',
        'phone' => 'nullable|string|max:50',
        'password' => 'required|string|min:6',
        'department_id' => 'nullable|exists:departments,id',
        'manager_user_id' => 'nullable|exists:users,id',
        'is_active' => 'nullable|boolean',
        ];


    protected function beforeStore(array $data, Request $request): array
    {
        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $data;
    }

    protected function beforeUpdate(array $data, Request $request, \Illuminate\Database\Eloquent\Model $item): array
    {
        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $data;
    }
}
