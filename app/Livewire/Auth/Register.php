<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Models\Lawyer;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class Register extends Component
{
    // الحقول
    public $first_name, $last_name, $email, $password, $password_confirmation;
    public $national_id, $phone, $address, $city, $governorate, $zipcode;
    public $role = 'litigant';
    public $bar_registration_number, $specialization;

    /**
     * قواعد التحقق
     */
    protected function rules()
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'national_id' => ['required', 'string', 'size:14', 'unique:users'],
            'phone' => ['nullable', 'regex:/^(\+2)?01[0-9]{9}$/'],
            'role' => ['required', 'in:lawyer,litigant'],
        ];

        if ($this->role === 'lawyer') {
            $rules['bar_registration_number'] = ['required', 'string', 'unique:lawyers'];
            $rules['specialization'] = ['nullable', 'string', 'max:255'];
        }

        return $rules;
    }

    /**
     * تنفيذ التسجيل
     */
    public function register()
    {
        $this->validate();
        $user = new User();
        try {
            $this->role === 'lawyer' ? $user->status = 'pending' : $user->status = 'active';
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->email = $this->email;
            $user->national_id = $this->national_id;
            $user->phone = $this->phone;
            $user->address = $this->address;
            $user->city = $this->city;
            $user->governorate = $this->governorate;
            $user->zipcode = $this->zipcode;
            $user->password = Hash::make($this->password);
            DB::beginTransaction();
            $user->save();

            $user->assignRole($this->role);


            // لو محامي أضيف بيانات المحامي
            if ($this->role === 'lawyer') {
                Lawyer::create([
                    'user_id' => $user->id,
                    'bar_registration_number' => $this->bar_registration_number,
                    'specialization' => $this->specialization,
                ]);
            }
            DB::commit();

            event(new Registered($user));

            Auth::login($user);

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            \Log::error('Registration error: ' . $e->getMessage());
            $this->addError('error', 'حدث خطأ أثناء إنشاء المستخدم: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.guest');
    }
}
