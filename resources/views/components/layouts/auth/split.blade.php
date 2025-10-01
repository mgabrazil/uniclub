<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            <div class="bg-muted relative hidden h-full flex-col p-10 text-white lg:flex dark:border-e dark:border-neutral-800">
                <div class="absolute inset-0 bg-neutral-900"></div>
                <a href="{{ route('home') }}" class="relative justify-center z-20 flex items-center text-lg font-medium" wire:navigate>
                    <span class="flex h-sm-10 h-lg-30 w-50 items-center rounded-md">
                        <x-app-logo class="me-2 h-30 content-center fill-current text-white" />
                    </span>
                    {{-- {{ config('app.name', 'UniClub') }}--}}
                </a>

            </div>
            <div class="w-full lg:p-8">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                    <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden" wire:navigate>
                        <span class="flex h-30 w-30 items-center justify-center rounded-md">
                            <x-app-logo-icon class="size-30 fill-current text-black dark:text-white" />
                        </span>

                        {{-- <span class="sr-only">{{ config('app.name', 'UniClub') }}</span> --}}
                    </a>
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
