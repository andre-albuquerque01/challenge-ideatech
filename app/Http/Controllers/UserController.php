<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}
    public function showLoginForm()
    {
        return view('users.auth');
    }

    public function login(Request $request)
    {
        return $this->userService->login($request->only('email', 'password'));
    }


    public function logout()
    {
        return $this->userService->logout();
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        $result = $this->userService->store($request->validated());

        if ($result === 'success') {
            return redirect()->route('login')->with('success', 'Usuário criado com sucesso!');
        }

        return back()->withErrors(['error' => 'Erro ao criar usuário.']);
    }

    public function show()
    {
        $user = $this->userService->show();

        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'Usuário não encontrado.']);
        }

        return view('users.show', ['user' => $user]);
    }

    public function showUpdateForm()
    {
        return view('users.edit', ['user' => Auth::user()]);
    }

    public function update(UserRequest $request)
    {
        $result = $this->userService->update($request->validated());

        return match ($result) {
            'success' => redirect()->route('users.show')->with('success', 'Usuário atualizado com sucesso!'),
            'user not found' => back()->withErrors(['error' => 'Usuário não encontrado.']),
            'password incorrect' => back()->withErrors(['error' => 'Senha atual incorreta.']),
            default => back()->withErrors(['error' => 'Erro ao atualizar usuário.']),
        };
    }
}
