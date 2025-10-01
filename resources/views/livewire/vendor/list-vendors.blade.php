<div class="flex flex-col gap-6 p-4 md:p-6">
    <x-auth-header
        :title="__('Lista de Vendedores')"
        :description="__('Consulte, filtre e gerencie os dados dos vendedores.')"
    />

    @if (session()->has('message'))
        <div class="p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-300" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg p-4">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 mb-4">
            <div class="w-full md:w-1/2">
                <label for="vendor-search" class="sr-only">{{ __('Buscar') }}</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="text" id="vendor-search"
                           class="input-form-style w-full pl-10"
                           placeholder="{{ __('Buscar por Nome, CPF ou Email') }}"
                           wire:model.live.debounce.300ms="search">
                </div>
            </div>

            <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="btn-secondary w-full md:w-auto flex items-center justify-center">
                        <svg class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"></path></svg>
                        {{ __('Filtrar Status') }}
                        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"></path></svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                         class="absolute z-10 mt-2 w-48 p-3 bg-white rounded-lg shadow-lg dark:bg-gray-700"
                         x-transition style="display: none;">
                        <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">{{ __('Filtrar por Status') }}</h6>
                        <ul class="space-y-2 text-sm">
                            <li><label class="flex items-center"><input type="radio" wire:model.live="statusFilter" value="" class="form-radio-style"> <span class="ml-2">{{ __('Todos') }} ({{$totalCount}})</span></label></li>
                            <li><label class="flex items-center"><input type="radio" wire:model.live="statusFilter" value="active" class="form-radio-style"> <span class="ml-2">{{ __('Ativos') }} ({{$activeCount}})</span></label></li>
                            <li><label class="flex items-center"><input type="radio" wire:model.live="statusFilter" value="inactive" class="form-radio-style"> <span class="ml-2">{{ __('Inativos') }} ({{$inactiveCount}})</span></label></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('id')">{{ __('Id') }} <x-sort-icon field="id" :sortField="$sortField" :sortDirection="$sortDirection" /></th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('name')">{{ __('Nome') }} <x-sort-icon field="name" :sortField="$sortField" :sortDirection="$sortDirection" /></th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('cpf')">{{ __('CPF') }} <x-sort-icon field="cpf" :sortField="$sortField" :sortDirection="$sortDirection" /></th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('email')">{{ __('E-mail') }} <x-sort-icon field="email" :sortField="$sortField" :sortDirection="$sortDirection" /></th>
                        <th scope="col" class="px-6 py-3">{{ __('Telefone') }}</th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('status')">{{ __('Status') }} <x-sort-icon field="status" :sortField="$sortField" :sortDirection="$sortDirection" /></th>
                        <th scope="col" class="px-6 py-3"><span class="sr-only">{{ __('Editar') }}</span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vendors as $vendor)
                        <tr wire:key="vendor-{{ $vendor->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $vendor->id }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $vendor->name }}</td>
                            <td class="px-6 py-4">{{ $vendor->cpf }}</td>
                            <td class="px-6 py-4">{{ $vendor->email }}</td>
                            <td class="px-6 py-4">{{ $vendor->phone ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $vendor->status === App\Enums\UserStatus::Active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                    {{ $vendor->status->label() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button type="button" data-modal-target="editUserModal-{{$vendor->id}}" data-modal-toggle="editUserModal-{{$vendor->id}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                {{ __('Nenhum vendedor encontrado com os filtros atuais.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $vendors->links() }}
        </div>
    </div>

    @foreach($vendors as $vendor)
    <div id="editUserModal-{{$vendor->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <h3 class="text-lg font-semibold">Editar Vendedor: {{ $vendor->name }}</h3>
                <p class="text-sm">Funcionalidade de edição a ser implementada.</p>
                <button type="button" data-modal-hide="editUserModal-{{$vendor->id}}" class="btn-secondary mt-4">Fechar</button>
            </div>
        </div>
    </div>
    @endforeach

</div>
