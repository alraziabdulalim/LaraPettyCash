@auth
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
        <div class="flex items-center justify-end mt-4">
            <p class="px-4 py-1.5 bg-green-700 text-white shadow-sm sm:rounded-md  hover:text-white hover:bg-green-400">
                @php
                $balance = 0;
                @endphp

                @foreach($transactions as $transaction)
                @php
                $balance += ($transaction->oldactype_id == 1) ? $transaction->amount : -($transaction->amount);
                @endphp
                @endforeach
                {{ __('Current Balance: ') }} <strong>{{ __('Current Balance: ') }}</strong>
            </p>
            <a href="{{ route('oldTransactions.create') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 bg-neutral-700 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Add New Transaction') }}
                </x-primary-button>
            </a>
            <a href="{{ route('oldTransactions') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 bg-neutral-700 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Show Last Transaction') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="p-10">
        <div class="max-w-7xl mx-auto px-6 py-2 sm:px-2 lg:px-4">
            <!-- Table START -->
            <div class="mt-2 p-5 bg-neutral-700 rounded-lg text-white">
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

                        @foreach($transactions as $transaction)
                        @php
                        $debitAmount = 0;
                        $creditAmount = 0;
                        @endphp

                        <!-- Transaction type check and set to debit-credit -->
                        @if($transaction->oldactype_id == 1)
                        @php $debitAmount = $transaction->amount; @endphp
                        @elseif($transaction->oldactype_id == 2)
                        @php $creditAmount = $transaction->amount; @endphp
                        @endif

                        <!-- Balance calculation -->
                        @php
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
                                <a href="#">View</a>
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
            </div>
            <!-- Table END -->
            <!-- Pagination -->
            <div class="mt-2 px-2 py-2 bg-neutral-700 rounded-lg">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
@endauth