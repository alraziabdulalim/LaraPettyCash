@auth
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Old Voucher::Details') }}
        </h2>
        <div class="flex items-center justify-end mt-4">
            <p class="px-4 py-1.5 bg-green-700 text-white shadow-sm sm:rounded-md  hover:text-white hover:bg-green-400">
                @php
                $balance = 0;
                @endphp

                @foreach($transCalcs as $transCalc)
                @php
                $balance += ($transCalc->oldactype_id == 1) ? $transCalc->amount : -($transCalc->amount);
                @endphp
                @endforeach
                {{ __('Current Balance: ') }} <strong>{{ $balance }}</strong>
            </p>
            <a href="{{ route('oldVouchers.create') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 bg-neutral-700 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Add New Voucher') }}
                </x-primary-button>
            </a>
            <a href="{{ route('oldVouchers') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 bg-neutral-700 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('All Vouchers') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="p-10">
        <div class="max-w-2xl mx-auto px-6 py-2 sm:px-2 lg:px-4">
            <!-- Table START -->
            <div class="mt-2 p-5 bg-neutral-700 rounded-lg text-white">
                <table class="w-full min-w-min bg-center border-collapse border-b border-white">
                    <tr class="border-b border-solid border-0.5 border-white">
                        <th class="text-xl uppercase border-b border-solid border-0.5 border-white" colspan="2">Voucher Detail of  {{ $transaction->id }}</th>
                    </tr>
                    <tr class="border-b border-solid border-0.5 border-white">
                        <th class="text-xs uppercase border-b border-solid border-0.5 border-white">A/C Name</th>
                        <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                            {{ $transaction->oldacname->name }}
                        </td>
                    </tr>
                    <tr class="border-b border-solid border-0.5 border-white">
                        <th class="text-xs uppercase border-b border-solid border-0.5 border-white">Post Date</th>
                        <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                            {{ $transaction->created_at->format('d-m-Y') }}
                        </td>
                    </tr>
                    <tr class="border-b border-solid border-0.5 border-white">
                        <th class="text-xs uppercase border-b border-solid border-0.5 border-white">Vou. Date</th>
                        <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                            {{ \Carbon\Carbon::parse($transaction->voucher_at)->format('d-m-Y') }}
                        </td>
                    </tr>
                    <tr class="border-b border-solid border-0.5 border-white">
                        <th class="text-xs uppercase border-b border-solid border-0.5 border-white">Details</th>
                        <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                            {{ $transaction->details }}
                        </td>
                    </tr>
                    <tr class="border-b border-solid border-0.5 border-white">
                        <th class="text-xs uppercase border-b border-solid border-0.5 border-white">Amount (Tk)</th>
                        <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                            {{ $transaction->amount }}
                        </td>
                    </tr>
                </table>
            </div>
            <!-- Table END -->
        </div>
    </div>
</x-app-layout>
@endauth