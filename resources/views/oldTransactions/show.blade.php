@auth
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('oldTransactions.create') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Add New Transaction') }}
                </x-primary-button>
            </a>
            <a href="{{ route('oldTransactions') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Show Last Transaction') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Table START -->

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Post Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Vou. Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Trans. No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    A/C Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Details
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Debit (Tk)
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Credit (Tk)
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Balance (Tk)
                                </th>
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

                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-500 whitespace-nowrap">
                                    {{ $transaction->created_at->format('d-m-Y') }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-500 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($transaction->voucher_at)->format('d-m-Y') }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-500 whitespace-nowrap">
                                    {{ $transaction->id }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-500 whitespace-nowrap">
                                    {{ $transaction->oldacname->name }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-500 whitespace-nowrap">
                                    <a href="#" class="font-medium text-blue-600 hover:underline">View</a>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-500 whitespace-nowrap">
                                    {{ $debitAmount }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-500 whitespace-nowrap">
                                    {{ $creditAmount }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-500 whitespace-nowrap">
                                    {{ $balance }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    {{ $transactions->links() }}
                </div>

                <!-- Table END -->
            </div>
        </div>
    </div>
</div>
</x-app-layout>
@endauth