<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserManagementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userManagementService;

    public function __construct(UserManagementService $userManagementService)
    {
        $this->userManagementService = $userManagementService;
    }

    public function index()
    {
        return view('users-datatables');
    }

    public function getData(Request $request): JsonResponse
    {
        // Validate the incoming request
        $validated = $request->validate([
            'search.value' => 'nullable|string|max:255', // Search term
            'order.0.column' => 'nullable|integer|min:0|max:3', // Column index for sorting
            'order.0.dir' => 'nullable|in:asc,desc', // Sorting direction
            'start' => 'nullable|integer|min:0', // Pagination start
            'length' => 'nullable|integer|min:1|max:100', // Pagination length
            'draw' => 'nullable|integer', // DataTables draw counter
        ]);

        // Pass the validated data to the service
        $data = $this->userManagementService->getPaginatedUsers($validated);

        return response()->json($data);
    }

    public function delete($id): JsonResponse
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $deleted = $this->userManagementService->deleteUser($id);

        return $deleted ? response()->json(['success' => true])
                        : response()->json(['error' => 'User not found'], 404);
    }

}
