<div class="p-4 md:p-6">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('Histórico de Vendas') }}</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Visualize todas as vendas registradas.') }}</p>
        </div>
        <div>
            <button wire:click="export" wire:loading.attr="disabled" wire:target="export" class="btn-secondary">
                <span wire:loading.remove wire:target="export">{{ __('Exportar para Planilha') }}</span>
                <span wire:loading wire:target="export">{{ __('Exportando...') }}</span>
            </button>
        </div>
    </div>

    <div class="mb-4">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ __('Buscar por Referência, Cliente, Vendedor...') }}" class="input-form-style w-full sm:w-1/2 md:w-1/3">
    </div>

    <div class="overflow-x-auto relative shadow-md sm:rounded-lg bg-white dark:bg-gray-800">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6 cursor-pointer" wire:click="sortBy('reference_number')">
                        Ref. #
                        <x-sort-icon field="reference_number" :sortField="$sortField" :sortDirection="$sortDirection" />
                    </th>
                    <th scope="col" class="py-3 px-6 cursor-pointer" wire:click="sortBy('client_id')">
                        Cliente
                        <x-sort-icon field="client_id" :sortField="$sortField" :sortDirection="$sortDirection" />
                    </th>
                    <th scope="col" class="py-3 px-6 cursor-pointer" wire:click="sortBy('vendor_id')">
                        Vendedor
                        <x-sort-icon field="vendor_id" :sortField="$sortField" :sortDirection="$sortDirection" />
                    </th>
                    <th scope="col" class="py-3 px-6 cursor-pointer" wire:click="sortBy('amount')">
                        Valor (R$)
                        <x-sort-icon field="amount" :sortField="$sortField" :sortDirection="$sortDirection" />
                    </th>
                     <th scope="col" class="py-3 px-6 cursor-pointer" wire:click="sortBy('points_earned')">
                        Pts Ganhos
                        <x-sort-icon field="points_earned" :sortField="$sortField" :sortDirection="$sortDirection" />
                    </th>
                     <th scope="col" class="py-3 px-6 cursor-pointer" wire:click="sortBy('points_redeemed')">
                        Pts Usados
                        <x-sort-icon field="points_redeemed" :sortField="$sortField" :sortDirection="$sortDirection" />
                    </th>
                     <th scope="col" class="py-3 px-6 cursor-pointer" wire:click="sortBy('final_amount')">
                        Valor Final (R$)
                        <x-sort-icon field="final_amount" :sortField="$sortField" :sortDirection="$sortDirection" />
                    </th>
                    <th scope="col" class="py-3 px-6 cursor-pointer" wire:click="sortBy('created_at')">
                        Data
                        <x-sort-icon field="created_at" :sortField="$sortField" :sortDirection="$sortDirection" />
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sales as $sale)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $sale->reference_number ?? 'N/A' }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $sale->client?->name ?? __('Cliente não encontrado') }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $sale->vendor?->name ?? __('Vendedor não encontrado') }}
                        </td>
                        <td class="py-4 px-6 text-right">
                            {{ number_format($sale->amount, 2, ',', '.') }}
                        </td>
                        <td class="py-4 px-6 text-right">
                            {{ $sale->points_earned }}
                        </td>
                         <td class="py-4 px-6 text-right">
                            {{ $sale->points_redeemed }}
                        </td>
                         <td class="py-4 px-6 text-right font-semibold">
                            {{ number_format($sale->final_amount, 2, ',', '.') }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $sale->created_at->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                @empty
                     <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td colspan="8" class="py-4 px-6 text-center text-gray-500 dark:text-gray-400">
                            {{ __('Nenhuma venda encontrada.') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $sales->links() }}
    </div>

</div>
