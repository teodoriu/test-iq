<button 
    onclick="editUser({{ $user->id }})" 
    class="text-blue-600 hover:underline mr-2">
    Edit
</button>
@role('admin')
<button 
    onclick="deleteUser({{ $user->id }})" 
    class="text-red-600 hover:underline">
    Delete
</button>
@endrole