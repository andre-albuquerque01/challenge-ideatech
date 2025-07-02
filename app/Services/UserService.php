<?php

namespace App\Services;

use App\Exceptions\GeneralExceptionCatch;
use App\Http\Resources\UserResource;
use App\Interface\UserServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function __construct(private Request $request) {}

    public function login(array $data)
    {
        try {
            if (Auth::attempt($data)) {
                $this->request->session()->regenerate();

                return redirect()->redirect('processos.index');
            }

            return back()->withErrors([
                'email' => 'E-mail ou senha inválidos.',
            ])->withInput();
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Dados inválidos.',
            ])->withInput();
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
            $this->request->session()->invalidate();
            $this->request->session()->regenerateToken();
            return redirect('/login');
        } catch (\Exception $e) {
            return 'Error: logout';
        }
    }

    public function store(array $data)
    {
        try {
            $data['password'] = Hash::make($data['password']);

            User::create($data);
            return 'success';
        } catch (\Exception $e) {
            return 'Error: user create';
        }
    }

    public function show()
    {
        try {
            return new UserResource(Auth::user());
        } catch (\Exception $e) {
            return 'Error: user show';
        }
    }

    public function update(array $data)
    {
        try {
            $user = User::where('id', Auth::user()->id)->first();

            if (!$user) {
                return 'user not found';
            }

            if (!Hash::check($data['password'], $user->password)) {
                return 'password incorrect';
            }

            if (isset($data['new_password'])) {
                $data['password'] = Hash::make($data['new_password']);
            }

            $user->update($data);

            return 'success';
        } catch (\Exception $e) {
            return 'Error: user update';
        }
    }
    
}
