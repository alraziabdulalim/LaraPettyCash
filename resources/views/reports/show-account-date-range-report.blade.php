@auth
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Report::Account Date Range') }}
                </h2>
                @include('partials.sub-menu')
            </div>
        </x-slot>

        <div>
            <div class="max-w-5xl mx-auto px-6 py-2 sm:px-2 lg:px-4">
                @include('reports.partials.form-date-range')
                @include('reports.partials.form-account-date-range')
                @include('reports.partials.account-summery')
            </div>
        </div>
    </x-app-layout>

    <script>
        flatpickr(".voucher_at", {
            dateFormat: "d-m-Y"
        });
    </script>
@endauth
