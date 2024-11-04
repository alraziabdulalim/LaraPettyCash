@auth
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-white-800 leading-tight">
                    {{ __('Report::Current Month') }}
                </h2>
                @include('partials.sub-menu')
            </div>
        </x-slot>

        <div>
            <div class="max-w-5xl mx-auto px-6 py-2 sm:px-2 lg:px-4">
                @include('reports.partials.form-date-range')
                @include('reports.partials.form-account-date-range')
                @include('reports.partials.accounts-summery')
            </div>
        </div>
    </x-app-layout>
@endauth
