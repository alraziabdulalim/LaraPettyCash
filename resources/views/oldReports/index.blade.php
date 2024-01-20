@auth
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('oldTransactions.create') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Add New Transaction') }}
                </x-primary-button>
            </a>
            <a href="{{ route('oldReports') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('All Report') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-400-900">

                    <!-- Transaction History Form START -->
                    <div class="p-6 max-w-3xl text-black border-b shadow-md sm:rounded-lg mb-5">
                        <form method="GET" action="{{ route('oldReports.show') }}">
                            @csrf

                            <div class="flex">

                                <!-- Transaction Start Date -->
                                <div class="mr-5">
                                    <x-text-input id="startDate" class="voucher_at block mt-1 w-full" type="date" name="startDate" :value="old('startDate')" placeholder="Date From" required autofocus autocomplete="startDate" />
                                    <x-input-error :messages="$errors->get('startDate')" class="mt-2" />
                                </div>

                                <!-- Transaction End Date -->
                                <div class="mr-5">
                                    <x-text-input id="endDate" class="voucher_at block mt-1 w-full" type="date" name="endDate" :value="old('endDate')" placeholder="Date To" required autofocus autocomplete="endDate" />
                                    <x-input-error :messages="$errors->get('endDate')" class="mt-2" />
                                </div>

                                <!-- Accounts Name -->
                                <div class="mr-5">
                                    <select id="oldacname_id" name="oldacname_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        @foreach($oldacNames as $oldacName)
                                        <option value="{{$oldacName->id}}">{{ $oldacName->s_name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('oldacname_id')" class="mt-2" />
                                </div>

                                <!-- Submit Button -->
                                <div>
                                    <x-primary-button class="bg-blue-400 text-white-400">
                                        {{ __('Show Report') }}
                                    </x-primary-button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- Transaction History Form END -->

                    <!-- Table START -->

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-white-500">
                            <thead class="text-xs text-white-700 uppercase bg-gray-50">
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
                                </tr>
                            </thead>
                            <tbody>
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

                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-white-500 whitespace-nowrap">
                                        {{ $transaction->created_at->format('d-m-Y') }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-white-500 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($transaction->voucher_at)->format('d-m-Y') }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-white-500 whitespace-nowrap">
                                        {{ $transaction->id }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-white-500 whitespace-nowrap">
                                        {{ $transaction->oldacname->name }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-white-500 whitespace-nowrap">
                                        <a href="#" class="font-medium text-blue-600 hover:underline">View</a>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-white-500 whitespace-nowrap">
                                        {{ $debitAmount }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-white-500 whitespace-nowrap">
                                        {{ $creditAmount }}
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

<script>
    flatpickr(".voucher_at", {
        dateFormat: "d-m-Y"
    });
</script>
@endauth