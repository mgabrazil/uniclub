<x-layouts.app :title="__('Dashboard do Vendedor')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">{{ __('Vendas Hoje') }}</h3>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Quantidade: <span class="font-bold text-gray-800 dark:text-white">{{ $salesTodayCount }}</span></p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Valor Total: <span class="font-bold text-green-600 dark:text-green-400">R$ {{ number_format($salesTodayValue, 2, ',', '.') }}</span></p>
                    </div>
                </div>

                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">{{ __('Vendas Esta Semana') }}</h3>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Quantidade: <span class="font-bold text-gray-800 dark:text-white">{{ $salesThisWeekCount }}</span></p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Valor Total: <span class="font-bold text-green-600 dark:text-green-400">R$ {{ number_format($salesThisWeekValue, 2, ',', '.') }}</span></p>
                    </div>
                </div>

                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">{{ __('Vendas Este Mês') }}</h3>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Quantidade: <span class="font-bold text-gray-800 dark:text-white">{{ $salesThisMonthCount }}</span></p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Valor Total: <span class="font-bold text-green-600 dark:text-green-400">R$ {{ number_format($salesThisMonthValue, 2, ',', '.') }}</span></p>
                    </div>
                </div>

                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">{{ __('Pontos Gerados Este Mês') }}</h3>
                    <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ $pointsGeneratedThisMonth }} <span class="text-sm font-normal text-gray-600 dark:text-gray-400">Pts</span></p>
                </div>

                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">{{ __('Total de Pontos Gerados') }}</h3>
                    <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ $pointsGeneratedTotal }} <span class="text-sm font-normal text-gray-600 dark:text-gray-400">Pts</span></p>
                </div>
            </div>
        </div>
</x-layouts.app>
