<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('Pontos') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Altere as principais propriedades dos pontos.') }}</flux:subheading>
    <flux:separator variant="subtle" />

    <x-admin.point-configurations :showNotification="true" :showData="false" />
</div>

