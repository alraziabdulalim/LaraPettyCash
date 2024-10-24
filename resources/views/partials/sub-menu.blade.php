<div class="flex items-center justify-end mt-4">
    <p class="px-4 py-1.5 bg-green-700 text-white shadow-sm sm:rounded-md  hover:text-white hover:bg-green-400">
        {{ __('Current Balance: ') }} <strong>{{ $balance }}</strong>
    </p>
    <a href="{{ route('account-names.create') }}">
        <x-primary-button
            class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Add A/C Name') }}
        </x-primary-button>
    </a>
    <a href="{{ route('account-names.index') }}">
        <x-primary-button
            class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('A/C Name') }}
        </x-primary-button>
    </a>
    <a href="{{ route('vouchers.create') }}">
        <x-primary-button
            class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Add New Voucher') }}
        </x-primary-button>
    </a>
</div>
