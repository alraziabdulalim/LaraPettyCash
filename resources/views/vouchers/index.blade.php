@auth
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Voucher :: List') }}
            </h2>
            @include('partials.sub-menu')
        </x-slot>

        <div class="p-10">
            <div class="max-w-7xl mx-auto px-6 py-2 sm:px-2 lg:px-4">
                @include('vouchers.partials.report')
            </div>
        </div>
    </x-app-layout>
@endauth
