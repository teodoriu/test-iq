<?php

namespace App\Livewire;

use App\Models\User;
use App\Services\UserManagementService;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public $search = '';

    protected $updatesQueryString = ['search'];

    protected $listeners = ['refreshUsers' => '$refresh'];

    /**
     * Inject UserManagementService dependency to UserTable
     */
    protected $userManagementService;
    public function boot(UserManagementService $userManagementService)
    {
        $this->userManagementService = $userManagementService;
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
            )
            ->orderByDesc('id')
            ->paginate(10);

        return view('livewire.user-table', ['users' => $users]);
    }

    public function edit($userId)
    {
        // Example: emit event to open a modal
        $this->dispatch('editUser', userId: $userId);
    }

    public function delete($userId)
    {
        $this->userManagementService->deleteUser($userId);

        session()->flash('message', 'User deleted successfully.');
        $this->resetPage();
    }
}
