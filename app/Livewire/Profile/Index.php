<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    public $user;
    public $name;
    public $email;
    public $phone;
    public $profilePhoto;
    public $profilePhotoUrl;
    public $role;
    public $isAdminRequest;
    public $showSuccessMessage = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,',
        'phone' => 'nullable|string|max:20',
        'profilePhoto' => 'nullable|image|max:2048',
    ];
    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->profilePhotoUrl = $this->user->profile_photo_url;
        $this->role = $this->user->role;
        $this->isAdminRequest = $this->user->is_admin_request;

        // Tambahkan ID user untuk validasi unique email
        $this->rules['email'] .= $this->user->id;
    }
    public function render()
    {
        return view('livewire.profile.index');
    }
    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];

        // Handle profile photo upload
        if ($this->profilePhoto) {
            // Delete old photo if exists
            if ($this->profilePhotoUrl) {
                Storage::delete(str_replace('/storage', 'public', $this->profilePhotoUrl));
            }

            $path = $this->profilePhoto->store('public/profile-photos');
            $data['profile_photo_url'] = Storage::url($path);
            $this->profilePhotoUrl = $data['profile_photo_url'];
        }

        // Update user data
        $this->user->update($data);

        $this->showSuccessMessage = true;
    }

    public function requestAdmin()
    {
        $this->user->update(['is_admin_request' => true]);
        $this->isAdminRequest = true;
        session()->flash('message', 'Permintaan admin telah dikirim.');
    }
}
