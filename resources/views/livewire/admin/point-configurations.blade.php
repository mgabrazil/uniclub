<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        @include('partials.point-configurations')

        <form wire:submit.prevent="newPointConfigurations" class="grid auto-rows-min gap-4 md:grid-cols-3">
            <flux:input wire:model="pointsPerCurrency" :label="__('Pontos acumulados por real gasto')" type="number" required autofocus autocomplete="name" />

            <flux:input wire:model="currencyPerPoint" :label="__('Valor em reais de cada ponto')" type="number"/>


            <flux:input wire:model="pointsExpirationDays" :label="__('Validade dos pontos (em dias)')" type="number"/>

            <div class="items-center grid auto-rows-min gap-4 md:grid-cols-2">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white">
                        {{ __('Salvar configurações') }}
                    </flux:button>
                </div>
                <div>
                    <flux:modal.trigger name="edit-profile">
                        <flux:button>Histórico de Configuracoes</flux:button>
                    </flux:modal.trigger>
                    <flux:modal name="edit-profile" variant="flyout" class="w-full max-w-4xl">
                    <div class="p-6">
                        <flux:heading size="lg">Histórico</flux:heading>
                        <flux:text class="mt-2 mb-4">Verifique todas as alterações feitas nas configurações de pontos.</flux:text>
                            <div class="w-full overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 table-auto">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Data
                                    </th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Pontos acumulados por real gasto
                                    </th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Valor em reais de cada ponto
                                    </th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Validade do ponto
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($history as $item)
                                    <tr class="even:bg-gray-50 hover:bg-gray-100">
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">
                                        {{ $item->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">
                                        {{ $item->points_per_currency }}
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">
                                        {{ $item->currency_per_point }}
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">
                                        {{ $item->points_expiration_days }}
                                    </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="mt-4">
                                {{ $history->links() }}
                            </div>
                            </div>
                    </div>
                    </flux:modal>
                </div>
            </div>
        </form>

        <div class="grid auto-rows-min gap-10 my-10 md:mx-20 md:grid-cols-3">
            <x-admin.point-configurations
                :showNotification="false"
                :showData="true"
            />
        </div>
    </div>
</div>
