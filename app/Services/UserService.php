<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
    }

    // public function updateUser(User $user, array $data)
    // {
    //     $user->update([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'role' => $data['role'],
    //     ]);

    //     if (!empty($data['password'])) {
    //         $user->update(['password' => Hash::make($data['password'])]);
    //     }
    // }

    public function deleteUser(User $user)
    {
        if (Auth::id() === $user->id) {
            throw new \Exception("You cannot delete your own account.");
        }

        $user->delete();
    }
}
