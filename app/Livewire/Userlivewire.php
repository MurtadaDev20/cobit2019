<?php

namespace App\Livewire;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Livewire\WithPagination;

class Userlivewire extends Component
{
    use WithPagination;

    public $fullname;
    public $fullname_manager;
    public $email;
    public $email_manager;
    public $password;
    public $password_manager;
    public $selectManager;
    public $roleSelected;
    public $searchByName;
    public $num =1;
    public $showUserMode = false;
    public $editMode = false;

    public $editUserId;

    public function mount()
    {



    }

    public function addUser()
    {
        $this->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roleSelected' => 'required',
        ]);



        $user = new User();
        $user->name = $this->fullname;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->role_id = $this->roleSelected;
        $user->save();


        // Clear form fields
        $this->fullname = '';
        $this->email = '';
        $this->password = '';
        $this->roleSelected = '';
        toastr()->success('User added successfully!');

    }



     ///////////////////////////////////////// Update //////////////////////////////

     public function editUser($userId)
     {
         $user = User::find($userId);

         $this->editUserId = $userId;
         $this->fullname = $user->name;
         $this->email = $user->email;
         $this->editMode = true;

         // dd($department->manager_id);
     }

     public function updateUser()
    {
        $this->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $user = User::find($this->editUserId);
        $user->name = $this->fullname;
        $user->email = $this->email;
        $user->save();

        $this->editMode = false;
        $this->fullname = '';
        $this->email = '';
    }


    public function cancelUpdate()
    {
        $this->editMode = false;
        $this->fullname = '';
        $this->email = '';
    }


    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            return redirect()->to(route('allUsers'));
        }
    }


    public function render()
    {


        $roles = Role::all();
        return view('livewire.userlivewire',[

            'roles' => $roles,
            'users' => User::query()
                ->with('role')
                ->orderBy('created_at', 'desc')
                ->paginate(10),
        ]);
    }
}
