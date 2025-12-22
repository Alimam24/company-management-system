<?php

namespace App\Services;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Create a user account for the given employee.
     *
     * @param Employee $employee
     * @param array $data
     * @return User
     */
    public function createEmployeeAccountFor(Employee $employee, array $data): User
    {
        $user = new User();
        $user->UserName = $data['UserName'];
        $user->password = Hash::make($data['password']);
        $user->employee_id = $employee->id;
        $user->Is_Active=1;
        $user->save();

        return $user;
    }

    public function updateAccount(User $user, array $data): User
    {
        $user->UserName = $data['UserName'];
        $user->Is_Active = $data['Is_Active'] ?? $user->Is_Active;
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        return $user;
    }

    public function changePassword(User $user, string $newPassword): User
    {
        $user->password = Hash::make($newPassword);
        $user->save();

        return $user;
    }

    public function deleteAccount(User $user): void
    {
        $user->delete();
    } 
}