<?php

namespace App\Livewire\Vendor\RegisterNewSale;

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class UserSelector extends Component
{
    public string $roleToSearch;
    public string $label;
    public string $eventName;

    public string $searchTerm = '';
    public Collection $results;
    public bool $showDropdown = false;
    public ?string $selectedUserName = null;
    protected $listeners = ['clearUserSelection'];

    public function mount(string $roleToSearch, string $label, string $eventName)
    {
        $this->roleToSearch = $roleToSearch;
        $this->label = $label;
        $this->eventName = $eventName;
        $this->results = collect();
    }

    public function updatedSearchTerm(string $value): void
    {
        if (empty(trim($value))) {
            $this->results = collect();
            $this->showDropdown = false;
            return;
        }

        $roleEnum = UserRole::tryFrom($this->roleToSearch);
        if (!$roleEnum) {
            Log::error("UserSelector: Role inválida recebida '{$this->roleToSearch}'");
            $this->results = collect();
            $this->showDropdown = false;
            return;
        }

        $this->results = User::where('role', $roleEnum)
            ->where(function ($query) use ($value) {
                $query->where('name', 'LIKE', "%{$value}%")
                    ->orWhere('cpf', 'LIKE', "%{$value}%");
            })
            ->orderBy('name')
            ->limit(5)
            ->get(['id', 'name', 'cpf']);

        $this->showDropdown = true;
    }

    public function selectUser(int $userId): void
    {
        $user = User::find($userId);
        if ($user) {
            $this->selectedUserName = $user->name;

            $this->dispatch($this->eventName, userId: $user->id, userName: $user->name);

            $this->searchTerm = '';
            $this->results = collect();
            $this->showDropdown = false;
        }
    }

    public function clearUserSelection(): void
    {
        $this->selectedUserName = null;
        $this->searchTerm = '';
        $this->results = collect();
        $this->showDropdown = false;
    }

    public function render()
    {
        return view('livewire.vendor.register-new-sale.user-selector');
    }
}
