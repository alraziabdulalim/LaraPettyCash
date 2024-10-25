@auth
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Transactions') }}
            </h2>
            @include('partials.sub-menu')
        </x-slot>

        <div class="p-10">
            <div class="max-w-7xl mx-auto px-6 py-2 sm:px-2 lg:px-4">
                @include('reports.partials.show-form')
                @include('reports.partials.show-report')
            </div>
        </div>
    </x-app-layout>

    <script>
        flatpickr(".voucher_at", {
            dateFormat: "d-m-Y"
        });
    </script>
@endauth
