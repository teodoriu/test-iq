<?php

namespace App\Services;

use App\Models\User;

class UserManagementService
{
    /**
     * Soft delete a user by ID.
     */
    public function deleteUser(int $id):bool
    {
        $user = User::findOrFail($id);
        if($user){
            $user->delete();
            return true;
        }

        return false;
    }

    /**
     * Restore a soft-deleted user by ID.
     */
    public function restoreUser(int $id):bool
    {
        $user = User::withTrashed()->find($id);

        if ($user) {
            $user->restore();
            return true;
        }

        return false;
    }

    /**
     * Permanently delete a user by ID.
     */
    public function forceDeleteUser(int $id):bool
    {
        $user = User::withTrashed()->find($id);

        if ($user) {
            $user->forceDelete();
            return true;
        }

        return false;
    }
}