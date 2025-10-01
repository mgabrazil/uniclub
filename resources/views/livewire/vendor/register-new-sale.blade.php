<div class="flex flex-col gap-6 p-4 md:p-6">

    <div>
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('Registrar Nova Venda') }}</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Selecione cliente e vendedor, depois informe os detalhes.') }}</p>
    </div>

    @if(session()->has('success'))
        <div class="p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-300" role="alert">
            <span class="font-medium">{{ __('Sucesso!') }}</span> {{ session('success') }}
        </div>
    @endif
    @error('generic_error')
         <div class="p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-900 dark:text-red-300" role="alert">
            <span class="font-medium">{{ __('Erro:') }}</span> {{ $message }}
        </div>
    @enderror

    <form wire:submit.prevent="createSale" class="flex flex-col gap-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <livewire:vendor.register-new-sale.user-selector
                roleToSearch="client"
                label="{{ __('Cliente') }}"
                eventName="clientSelected"
                instanceKey="client-user-selector"
                wire:key="client-user-selector" />
                @error('selectedClientId') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                 <livewire:vendor.register-new-sale.vendor-selector
                    eventName="vendorSelected"
                    instanceKey="vendor-selector"
                    wire:key="vendor-selector"
                 />
                 @error('selectedVendorId') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        @if($selectedClientId)
            <div class="p-4 border rounded-lg dark:border-gray-700 bg-gray-50 dark:bg-gray-800 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 col-span-full">{{ __('Detalhes do Cliente') }}</h4>
                <div>
                    <label class="text-xs text-gray-500">{{__('Email')}}</label>
                    <p class="text-sm text-gray-900 dark:text-white truncate" title="{{ $clientEmail ?: '-' }}">{{ $clientEmail ?: '-' }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">{{__('CPF')}}</label>
                    <p class="text-sm text-gray-900 dark:text-white">{{ $clientCpf ?: '-' }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">{{__('Telefone')}}</label>
                    <p class="text-sm text-gray-900 dark:text-white">{{ $clientPhone ?: '-' }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">{{__('Saldo Atual')}}</label>
                    <p class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                        {{ \App\Models\User::find($selectedClientId)?->current_points ?? 0 }} Pts
                    </p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 border-t dark:border-gray-700 pt-6">
            <div>
                 <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Valor da Venda (R$)') }} <span class="text-red-500">*</span></label>
                 <input id="amount" type="number" step="0.01" min="0.01" wire:model.live="amount" placeholder="0.00" class="input-form-style block w-full @error('amount') border-red-500 @enderror" required>
                 @error('amount') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

             <div>
                @if($selectedClientId)
                     <label for="pointsToRedeem" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                        {{ __('Usar Pontos (Disp: :points)', ['points' => \App\Models\User::find($selectedClientId)?->current_points ?? 0]) }}
                     </label>
                     <input id="pointsToRedeem" type="number" step="1" min="0"
                            max="{{ \App\Models\User::find($selectedClientId)?->current_points ?? 0 }}"
                            wire:model.live="pointsToRedeem" placeholder="0"
                            class="input-form-style block w-full @error('pointsToRedeem') border-red-500 @enderror"
                            {{ (\App\Models\User::find($selectedClientId)?->current_points ?? 0) == 0 ? 'disabled' : '' }}>
                     @error('pointsToRedeem') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror

                     @if($discountValue > 0 || $amount > 0)
                     <div class="mt-2 text-xs space-y-1">
                         <p class="text-gray-600 dark:text-gray-400">Desconto Aplicado: <span class="font-medium text-green-600 dark:text-green-400">- R$ {{ number_format($discountValue, 2, ',', '.') }}</span></p>
                         <p class="text-gray-900 dark:text-white">Valor Final a Pagar: <span class="font-bold text-base">R$ {{ number_format($finalAmount, 2, ',', '.') }}</span></p>
                     </div>
                     @endif
                 @else
                      <label class="block text-sm font-medium text-gray-400 dark:text-gray-500 mb-1">{{ __('Usar Pontos') }}</label>
                      <input type="number" placeholder="0" class="input-readonly-style block w-full" disabled>
                      <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">{{__('Selecione um cliente para habilitar o resgate.')}}</p>
                 @endif
            </div>
        </div>

        <div class="flex items-center justify-end pt-6 border-t border-gray-200 dark:border-gray-700">
             <button type="submit" class="btn-primary" {{ !$selectedClientId || !$selectedVendorId || !$amount ? 'disabled' : '' }}
                wire:loading.attr="disabled" wire:target="createSale">
                <span wire:loading.remove wire:target="createSale">{{ __('Registrar Venda') }}</span>
                <span wire:loading wire:target="createSale">{{ __('Salvando...') }}</span>
            </button>
        </div>
    </form>
</div>

