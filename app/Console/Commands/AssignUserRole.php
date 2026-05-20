<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class AssignUserRole extends Command
{
    protected $signature = 'users:assign-role {email : User email} {role_code : Role code like ADMIN}';

    protected $description = 'Assign a role to an existing user';

    public function handle(): int
    {
        $user = User::query()
            ->where('email', $this->argument('email'))
            ->first();

        if (! $user) {
            $this->error('User not found.');

            return self::FAILURE;
        }

        $role = Role::query()
            ->where('code', $this->argument('role_code'))
            ->where('is_active', true)
            ->first();

        if (! $role) {
            $this->error('Active role not found.');

            return self::FAILURE;
        }

        $user->roles()->sync([$role->id]);

        if (! $user->department_id && $role->department_id) {
            $user->forceFill([
                'department_id' => $role->department_id,
            ])->save();
        }

        $this->info(sprintf(
            'Assigned role %s to %s.',
            $role->code,
            $user->email
        ));

        return self::SUCCESS;
    }
}
