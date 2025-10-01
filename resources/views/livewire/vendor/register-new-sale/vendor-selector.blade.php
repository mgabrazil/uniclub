<div class="relative">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
        {{ __('Vendedor Responsável') }} <span class="text-red-500">*</span>
    </label>
    <button
        type="button"
        wire:click="toggleDropdown"
        class="w-full text-left px-3 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
               {{ $selectedVendorName ? 'text-gray-900 dark:text-white bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600' : 'text-gray-500 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600' }}"
    >
        {{ $selectedVendorName ?? __('Selecionar Vendedor...') }}
    </button>

    @if($showDropdown)
        <div
            wire:click.away="$set('showDropdown', false)"
            x-data x-trap.inert.noscroll="true"
            class="absolute z-20 mt-1 w-full max-h-60 overflow-y-auto bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-300 dark:border-gray-600"
        >
            <ul class="text-sm text-gray-800 dark:text-gray-200">
                @forelse($vendors as $vendor)
                    <li
                        wire:click="selectVendor({{ $vendor->id }})"
                        wire:key="vendor-option-{{ $vendor->id }}"
                        tabindex="0"
                        class="cursor-pointer px-3 py-2 hover:bg-indigo-100 dark:hover:bg-indigo-900 focus:outline-none focus:bg-indigo-100 dark:focus:bg-indigo-900"
                    >
                        {{ $vendor->name }}
                    </li>
                @empty
                    <li class="px-3 py-2 text-gray-500 dark:text-gray-400">{{ __('Nenhum vendedor ativo encontrado.') }}</li>
                @endforelse
            </ul>
        </div>
    @endif
</div>
