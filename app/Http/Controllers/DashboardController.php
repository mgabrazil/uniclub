<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function redirectDashboard()
    {
        $user = auth()->user();
        if (!$user || !$user->role instanceof UserRole) {
            abort(403, 'Papel de usuário inválido ou não definido. Entre em contato com o suporte.');
        }

        return match ($user->role) {
            UserRole::Admin => redirect()->route('admin.dashboard'),
            UserRole::Vendor => redirect()->route('vendor.dashboard'),
            UserRole::Client => redirect()->route('client.dashboard'),
            default => abort(403, 'Acesso não autorizado.'),
        };
    }
}
