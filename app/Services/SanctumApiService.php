<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SanctumApiService
{
    public function createToken(User $user, string $userAgent): array
    {
        return [
            'token' => $user->createToken($userAgent)->plainTextToken,
        ];
    }

    public function removeAllTokens(): void
    {
        Auth::user()->tokens()->delete();
    }
}
