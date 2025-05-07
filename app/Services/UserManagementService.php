<?php

namespace App\Services;

use App\Models\User;

class UserManagementService
{

    /**
     * Fetch paginated, searchable, and sortable user data for DataTables.
     */
    public function getPaginatedUsers(Array $data): array
    {
        $query = User::query();

        // Handle search
        if ($search = $data['search']['value']) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Handle sorting
        $orderColumn = $data['order'][0]['column'];
        $orderDir = $data['order'][0]['dir'];
        $columns = ['id', 'name', 'email', 'created_at'];

        if (isset($orderColumn) && isset($columns[$orderColumn])) {
            $query->orderBy($columns[$orderColumn], $orderDir);
        }

        // Handle pagination
        $start = $data['start'] ?? 0;
        $length = $data['length'] ?? 10;

        $total = $query->count();
        $results = $query->skip($start)->take($length)->get();

        // Format the data for DataTables
        return [
            'draw' => $data['draw'],
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $results->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'created_at' => $user->created_at->format('Y-m-d'),
                    'actions' => view('data-table-users.actions', ['user' => $user])->render()
                ];
            })
        ];
    }

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