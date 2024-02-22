@auth
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions::Details') }}
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
            <a href="{{ route('oldTransactions') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 bg-neutral-700 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Trans Report') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="p-10">
        <div class="mt-2 p-5 bg-neutral-700 rounded-lg text-white">
            <!-- Table START -->
            <table class="w-full min-w-min bg-center border-collapse border-b border-white">
                <thead class="text-xs uppercase">
                    <tr class="border-b border-solid border-0.5 border-white">
                        <th class="border-b border-solid border-0.5 border-white">Post Date</th>
                        <th class="border-b border-solid border-0.5 border-white">Vou. Date</th>
                        <th class="border-b border-solid border-0.5 border-white">Trans. No</th>
                        <th class="border-b border-solid border-0.5 border-white">A/C Name</th>
                        <th class="border-b border-solid border-0.5 border-white">Details</th>
                        <th class="border-b border-solid border-0.5 border-white">Debit (Tk)</th>
                        <th class="border-b border-solid border-0.5 border-white">Credit (Tk)</th>
                        <th class="border-b border-solid border-0.5 border-white">Balance (Tk)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $balance = 0;
                    $totalDebit = 0;
                    $totalCredit = 0;
                    @endphp

                    @foreach($preTransactions as $preTransaction)
                    @php
                    $balance += ($preTransaction->oldactype_id == 1) ? $preTransaction->amount : 0;
                    $balance -= ($preTransaction->oldactype_id == 2) ? $preTransaction->amount : 0;
                    @endphp
                    @endforeach

                    @foreach($transactions as $transaction)
                    @php
                    $debitAmount = 0;
                    $creditAmount = 0;

                    $debitAmount = ($transaction->oldactype_id == 1) ? $transaction->amount : 0;
                    $creditAmount = ($transaction->oldactype_id == 2) ? $transaction->amount : 0;

                    $totalDebit += $debitAmount;
                    $totalCredit += $creditAmount;
                    $balance += $debitAmount - $creditAmount;
                    @endphp
                    <tr>
                        <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                            {{ $transaction->created_at->format('d-m-Y') }}
                        </td>
                        <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                            {{ \Carbon\Carbon::parse($transaction->voucher_at)->format('d-m-Y') }}
                        </td>
                        <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                            {{ $transaction->id }}
                        </td>
                        <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                            {{ $transaction->oldacname->name }}
                        </td>
                        <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                            <a href="{{ route('oldVouchers.show', ['transaction' => $transaction->id]) }}">View</a>
                        </td>
                        <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-right">
                            {{ $debitAmount }}
                        </td>
                        <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-right">
                            {{ $creditAmount }}
                        </td>
                        <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-right">
                            {{ $balance }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Table END -->
        </div>
    </div>
</x-app-layout>
@endauth