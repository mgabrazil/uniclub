<div>
    <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
        </svg>
        Filtrar
        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
        </svg>
    </button>
    <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
        <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Filtrar Usuários</h6>
        <ul class="space-y-2 text-sm">
            <li class="flex items-center">
                <input
                    type="radio"
                    wire:model="statusFilter"
                    value=""
                    id="all"
                    class="…"
                />
                <label for="all" class="ml-2 …">
                    Todos ({{ $vendors->count() }})
                </label>
            </li>
            <li class="flex items-center">
                <input
                    type="radio"
                    wire:model="statusFilter"
                    value="active"
                    id="active"
                    class="…"
                />
                <label for="active" class="ml-2 …">
                    Ativos ({{ $vendors->where('status','active')->count() }})
                </label>
            </li>
            <li class="flex items-center">
                <input
                    type="radio"
                    wire:model="statusFilter"
                    value="inactive"
                    id="inactive"
                    class="…"
                />
                <label for="inactive" class="ml-2 …">
                    Inativos ({{ $vendors->where('status','inactive')->count() }})
                </label>
            </li>
        </ul>
    </div>
</div>
