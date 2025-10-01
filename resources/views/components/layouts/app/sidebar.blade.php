<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            @php
                $role = auth()->user()?->role;
            @endphp

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')" class="grid">
                    @if($role === App\Enums\UserRole::Admin)
                        <flux:navlist.item icon="home" :href="route('admin.dashboard')" :current="request()->routeIs('admin.dashboard')" wire:navigate>
                            {{ __('Dashboard') }}
                        </flux:navlist.item>

                        <flux:navlist.item icon="users" :href="route('admin.list-users')" :current="request()->routeIs('admin.users.*')" wire:navigate>
                            {{ __('Usuários') }}
                        </flux:navlist.item>

                        <flux:navlist.item icon="shopping-bag" :href="route('admin.orders')" :current="request()->routeIs('admin.orders.*')" wire:navigate>
                            {{ __('Pedidos') }}
                        </flux:navlist.item>

                        <flux:navlist.item icon="sparkles" :href="route('admin.dashboard')" :current="request()->routeIs('admin.campaigns.*')" wire:navigate>
                            {{ __('Campanhas') }}
                        </flux:navlist.item>

                        <flux:navlist.item icon="currency-dollar" :href="route('admin.dashboard')" :current="request()->routeIs('admin.points.*')" wire:navigate>
                            {{ __('Transações de Pontos') }}
                        </flux:navlist.item>

                        <flux:navlist.item icon="cog-6-tooth" :href="route('admin.point-configurations')" :current="request()->routeIs('admin.points.settings')" wire:navigate>
                            {{ __('Configuração de Pontos') }}
                        </flux:navlist.item>

                        <flux:navlist.item icon="bell" :href="route('admin.dashboard')" :current="request()->routeIs('admin.notifications.*')" wire:navigate>
                            {{ __('Notificações') }}
                        </flux:navlist.item>

                        {{-- <flux:navlist.item icon="chart-bar" :href="route('admin.dashboard')" :current="request()->routeIs('admin.reports.*')" wire:navigate> --}}
                        {{--     {{ __('Relatórios') }} --}}
                        {{-- </flux:navlist.item> --}}
                        {{----}}
                        {{-- <flux:navlist.item icon="document-text" :href="route('admin.dashboard')" :current="request()->routeIs('admin.logs.*')" wire:navigate> --}}
                        {{--     {{ __('Logs de Atividade') }} --}}
                        {{-- </flux:navlist.item> --}}
                        {{----}}
                        {{-- <flux:navlist.item icon="chat-bubble-left-right" :href="route('admin.dashboard')" :current="request()->routeIs('admin.support.*')" wire:navigate> --}}
                        {{--     {{ __('Central de Suporte') }} --}}
                        {{-- </flux:navlist.item> --}}
                        {{----}}
                        {{-- <flux:navlist.item icon="wrench-screwdriver" :href="route('admin.dashboard')" :current="request()->routeIs('admin.settings.*')" wire:navigate> --}}
                        {{--     {{ __('Configurações do Sistema') }} --}}
                        {{-- </flux:navlist.item> --}}
                    @elseif($role === App\Enums\UserRole::Vendor)
                        <flux:navlist.item icon="home" :href="route('vendor.dashboard')" :current="request()->routeIs('vendedor.dashboard')" wire:navigate> {{ __('Dashboard') }}
                        </flux:navlist.item>

                            <flux:navlist.item icon="users" :href="route('vendor.list')" :current="request()->routeIs('vendedor.orders')" wire:navigate>
                                {{ __('Lista de Vendedores') }}
                            </flux:navlist.item>

                        <flux:navlist.group heading="Vendas" expandable>
                            <flux:navlist.item icon="currency-dollar" :href="route('vendor.register-new-sale')" :current="request()->routeIs('vendedor.orders')" wire:navigate>
                                {{ __('Registrar Nova Venda') }}
                            </flux:navlist.item>

                            <flux:navlist.item icon="banknotes" :href="route('vendor.sales.index')" :current="request()->routeIs('vendedor.orders')" wire:navigate>
                                {{ __('Lista de Vendas') }}
                            </flux:navlist.item>
                        </flux:navlist.group>


                        {{-- <flux:navlist.group heading="Vendedores" expandable>

                            <flux:navlist.item icon="user-plus" :href="route('vendor.create')" :current="request()->routeIs('vendedor.orders')" wire:navigate>
                                    {{ __('Cadastrar Novo') }}
                                </flux:navlist.item>


                            <flux:navlist.item icon="chart-bar" :href="route('vendor.dashboard')" :current="request()->routeIs('vendedor.orders')" wire:navigate>
                                {{ __('Desempenho') }}
                            </flux:navlist.item>
                        </flux:navlist.group>

                        --}}

                        <flux:navlist.group heading="Clientes" expandable>

                            <flux:navlist.item icon="chart-bar" :href="route('vendor.list-clients')" :current="request()->routeIs('vendedor.orders')" wire:navigate>
                                {{ __('Lista de Clientes') }}
                            </flux:navlist.item>

                            <flux:navlist.item icon="user-plus" :href="route('vendor.create-client')" :current="request()->routeIs('vendedor.orders')" wire:navigate>
                                    {{ __('Cadastrar Cliente') }}
                                </flux:navlist.item>

                        </flux:navlist.group>

                        {{--
                            <flux:navlist.group heading="Metas e Comissoes" expandable>
                                <flux:navlist.item icon="calendar-days" :href="route('vendor.dashboard')" :current="request()->routeIs('vendedor.orders')" wire:navigate>
                                    {{ __('Metas Mensais') }}
                                </flux:navlist.item>

                                <flux:navlist.item icon="banknotes" :href="route('vendor.dashboard')" :current="request()->routeIs('vendedor.orders')" wire:navigate>
                                    {{ __('Comissoes Calculadas') }}
                                </flux:navlist.item>
                            </flux:navlist.group>
                            <flux:navlist.group heading="Relatórios" expandable>
                                <flux:navlist.item icon="presentation-chart-line" :href="route('vendor.dashboard')" :current="request()->routeIs('vendedor.orders')" wire:navigate>
                                    {{ __('Vendas por Período') }}
                                </flux:navlist.item>

                                <flux:navlist.item icon="trophy" :href="route('vendor.dashboard')" :current="request()->routeIs('vendedor.orders')" wire:navigate>
                                    {{ __('Ranking de Vendedores') }}
                                </flux:navlist.item>
                            </flux:navlist.group>
                        --}}
                    @elseif($role === App\Enums\UserRole::Client)
                        <flux:navlist.item icon="home" :href="route('client.dashboard')" :current="request()->routeIs('cliente.dashboard')" wire:navigate>
                                    {{ __('Dashboard') }}
                        </flux:navlist.item>

                        <flux:navlist.item icon="shopping-bag" :href="route('client.dashboard')" :current="request()->routeIs('cliente.orders')" wire:navigate>
                            {{ __('Meus Pedidos') }}
                        </flux:navlist.item>

                        <flux:navlist.item icon="currency-dollar" :href="route('client.dashboard')" :current="request()->routeIs('cliente.points')" wire:navigate>
                            {{ __('Meus Pontos') }}
                        </flux:navlist.item>
                    @endif

                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">

                <flux:navlist.item icon="document-text" :href="route('policies')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Termos e Condições') }}
                </flux:navlist.item>

                @if($role === App\Enums\UserRole::Admin || $role === App\Enums\UserRole::Vendor)
                    <flux:navlist.item icon="question-mark-circle" :href="route('admin.dashboard')" :current="request()->routeIs('admin.help')" wire:navigate>
                        {{ __('Ajuda') }}
                    </flux:navlist.item>
                @endif
            </flux:navlist>

        </flux:sidebar>

        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
