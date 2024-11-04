@auth
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Voucher :: Edit Form') }}
                </h2>
                @include('partials.sub-menu')
            </div>
        </x-slot>

        <div>
            <div class="max-w-2xl mx-auto px-6 py-2 sm:px-2 lg:px-4">
                @include('vouchers.partials.form-voucher-edit')
            </div>
        </div>
    </x-app-layout>
@endauth
