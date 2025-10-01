<?php

namespace App\View\Components\Admin;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UsersRegistered extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $users = User::whereIn('role', ['vendor', 'client'])->count();
        return view('components.admin.users-registered', [
            'users' => $users,
        ]);
    }
}
