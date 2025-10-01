<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Criar um novo vendedor')" :description="__('Insira abaixo os dados do vendedor')" />

    <form wire:submit="create" class="flex flex-col gap-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <flux:input
                wire:model="name"
                :label="__('Nome')"
                type="text"
                required
                autofocus
                autocomplete="off"
                :placeholder="__('Nome completo')"
            />

            <flux:input
                wire:model="email"
                :label="__('Endereco de Email')"
                type="email"
                required
                autocomplete="off"
                placeholder="email@exemplo.com"
            />

            <flux:input
                wire:model="cpf"
                :label="__('CPF')"
                type="text"
                autocomplete="off"
                placeholder="xxx.xxx.xxx-xx"
            />

            <flux:input
                wire:model="phone"
                :label="__('Número de Telefone')"
                type="tel"
                autocomplete="off"
                placeholder="(99) 99999-9999"
            />

            <flux:input
                wire:model="birthday"
                :label="__('Data de Nascimento')"
                type="date"
                autocomplete="off"
                placeholder="dd/mm/aaaa"
            />
        </div>

        <div class="flex items-center justify-start">
            <flux:button type="submit" variant="primary" class="w-full md:w-auto">
                {{ __('Criar novo vendedor') }}
            </flux:button>
        </div>
    </form>
</div>
