<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;


class Profile extends Component
{
    use WithFileUploads;
    public $name,$oldPass,$newPass,$newPass_confirmation,$tabOpen=1,$address,$city,$phone,$pin,$avatar,$state;
    public function mount()
    {
        $this->name = auth()->user()->name;
    }
    public function render()
    {
        return view('livewire.profile');
    }
    public function tabOpn($tab_no)
    {
        $this->tabOpen = $tab_no;
    }
    public function updateName()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $user = Auth::user();
        $user->name = $this->name;
        if ($this->avatar) {
            if ($user->avatar && Storage::exists('storage/'.$user->avatar)) {
                Storage::delete('storage/'.$user->avatar);
            }

            // Store the new avatar in 'users/images' directory
            $avatarPath = $this->avatar->store('storage/users', 'public');
            $user->avatar = $avatarPath;
        }
        $user->save();
        session()->flash('success', 'Profile updated successfully!');
    }
    public function changePassword()
    {
        $this->validate([
            'oldPass' => 'required|string',
            'newPass' => 'required|string|min:8|confirmed',
            'newPass_confirmation' => 'required|string',
        ]);
        if (!Hash::check($this->oldPass, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'oldPass' => 'The provided password does not match our records.',
            ]);
        }
        Auth::user()->update([
            'password' => Hash::make($this->newPass), // Store the new password encrypted
        ]);
        session()->flash('success', 'Password changed successfully!');
    }
    public function addAddress()
    {
        // Validate the input fields
        $this->validate([
            'address' => 'required|string|max:255',
            'pin' => 'required|numeric|digits:6',  // Assuming pincode has 6 digits
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'phone' => 'required|string|regex:/^[0-9]{10}$/',  // Assuming a 10-digit phone number
        ]);

        // Store the address for the authenticated user
        Auth::user()->userAddresses()->create([
            'address' => $this->address,
            'pin' => $this->pin,
            'city' => $this->city,
            'state' => $this->state,
            'phone' => $this->phone,
        ]);

        // Flash a success message
        session()->flash('message', 'Address added successfully!');

        // Reset form fields
        $this->reset();
    }
}
