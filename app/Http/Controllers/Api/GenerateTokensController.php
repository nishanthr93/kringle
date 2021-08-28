<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class GenerateTokensController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        
        if ($user->role_id == Roles::IS_ADMIN) {
            return $this->generateAdminToken($user);
        } elseif ($user->role_id == Roles::IS_MANAGER) {
            return $this->generateManagerToken($user);
        } elseif ($user->role_id == Roles::IS_USER) {
            return $this->generateUserToken($user);
        }
    }

    public function generateAdminToken(User $user)
    {
        return $user->createToken('admin', [
            'task-index',
            'task-store',
            'task-show',
            'task-update',
            'task-destroy'
        ])->plainTextToken;
    }

    public function generateManagerToken(User $user)
    {
        return $user->createToken('manager', [
            'task-index',
            'task-store',
            'task-show',
            'task-update'
        ])->plainTextToken;
    }

    public function generateUserToken(User $user)
    {
        return $user->createToken('user', [
            'task-index',
            'task-show'
        ])->plainTextToken;
    }
}
