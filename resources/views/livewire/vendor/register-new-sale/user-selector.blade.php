<div class="relative">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
        {{ $label }} <span class="text-red-500">*</span>
    </label>
    <button
        type="button"
        wire:click="$toggle('showDropdown')"
        class="w-full text-left px-3 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
               {{ $selectedUserName ? 'text-gray-900 dark:text-white bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600' : 'text-gray-500 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600' }}"
    >
        {{ $selectedUserName ?? __('Pesquisar ') . Str::lower($label) }}
    </button>

    @if($showDropdown)
        <div
            wire:click.away="$set('showDropdown', false)"
            x-data x-trap.inert.noscroll="true"
            class="absolute z-20 mt-1 w-full bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-300 dark:border-gray-600"
        >
            <div class="p-2">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="searchTerm"
                    class="input-form-style block w-full"
                    placeholder="{{ __('Digite Nome ou CPF para buscar...') }}"
                    autofocus
                    x-ref="searchInput"
                    x-init="$nextTick(() => $refs.searchInput.focus())"
                />
            </div>

            <div wire:loading wire:target="searchTerm" class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">
                {{ __('Buscando...') }}
            </div>

            <ul wire:loading.remove wire:target="searchTerm" class="max-h-48 overflow-y-auto text-sm text-gray-800 dark:text-gray-200">
                @forelse($results as $user)
                    <li
                        wire:click="selectUser({{ $user->id }})"
                        wire:key="user-result-{{ $user->id }}"
                        tabindex="0"
                        class="cursor-pointer px-3 py-2 hover:bg-indigo-100 dark:hover:bg-indigo-900 focus:outline-none focus:bg-indigo-100 dark:focus:bg-indigo-900"
                    >
                        {{ $user->name }} <span class="text-xs text-gray-500 dark:text-gray-400">({{ $user->cpf }})</span>
                    </li>
                @empty
                    @if(!empty($searchTerm))
                        <li class="px-3 py-2 text-gray-500 dark:text-gray-400">{{ __('Nenhum resultado encontrado.') }}</li>
                    @else
                         <li class="px-3 py-2 text-xs text-gray-400 dark:text-gray-500">{{ __('Digite para buscar.') }}</li>
                    @endif
                @endforelse
            </ul>
        </div>
    @endif
</div>
