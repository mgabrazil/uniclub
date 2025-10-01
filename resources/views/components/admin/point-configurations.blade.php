@props([
    'showData' => false,
    'showNotification' => false,
])

@if ($showData)
    <div class="h-full w-full">
        <div class="w-full h-full bg-green-500 text-white p-6 rounded-lg shadow-lg text-center hover:bg-green-700 transition flex flex-col items-center">
            <h2 class="text-lg font-bold">Valor em Reais por Ponto</h2>
            <p class="text-2xl font-semibold">{{ $pointsPerCurrency }} ponto{{ $pointsPerCurrency > 1 ? 's' : '' }}</p>
        </div>
    </div>

    <div class="h-full w-full">
        <div class="w-full h-full bg-yellow-500 text-white p-6 rounded-lg shadow-lg text-center hover:bg-yellow-700 transition flex flex-col items-center">
            <h2 class="text-lg font-bold">Pontos Ganhos por Real Gasto</h2>
            <p class="text-2xl font-semibold">R$ {{ $pointsPerCurrency }}</p>
        </div>
    </div>

    <div class="h-full w-full">
        <div class="w-full h-full bg-red-500 text-white p-6 rounded-lg shadow-lg text-center hover:bg-red-700 transition flex flex-col items-center">
            <h2 class="text-lg font-bold">Validade dos Pontos (em dias)</h2>
            <p class="text-2xl font-semibold">{{ $pointsExpirationDays }} {{ $pointsExpirationDays > 1 ? 'dias' : 'dia' }}</p>
        </div>
    </div>
@endif

@if ($showNotification)
    <div
        {{ $attributes->merge([
            'id' => 'alert-border-1',
            'class' => 'flex items-start sm:items-center gap-5 p-1 mb-1 border-l-4 rounded-lg shadow-lg text-yellow-900 bg-yellow-50 border-yellow-400 dark:text-yellow-300 dark:bg-orange-900 dark:border-yellow-500',
            'role' => 'alert',
        ]) }}
    >
        <div class="flex-shrink-0">
            <svg class="w-6 h-6 sm:w-15 sm:h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
        </div>

        <div class="flex-1 text-sm sm:text-base">
            <p class="font-semibold">Alterações Recentes</p>
            <p class="text-yellow-800 dark:text-yellow-200">A última alteração foi feita em <strong>{{ $updated_at }}</strong></p>
        </div>
    </div>
@endif
