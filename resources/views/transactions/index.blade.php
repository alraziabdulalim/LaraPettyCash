<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction') }}
        </h2>
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('transactions.create') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Add new Transaction') }}
                </x-primary-button>
            </a>
            <a href="{{ route('transactions.show') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Trans Report') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    @auth
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Transaction Form START -->
                    <form method="POST" action="{{ route('transactions.show') }}">
                        @csrf

                        <!-- Transaction Date From -->
                        <div class="flex">
                            <div class="mt-3 mr-10">
                                <x-input-label for="dateFrom" :value="__('Date From')" />
                                <x-text-input id="dateFrom" class="block mt-1 w-auto date-form" type="date" name="dateFrom" :value="old('dateFrom')" required autofocus autocomplete="dateFrom" />
                                <x-input-error :messages="$errors->get('dateFrom')" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <x-input-label for="dateTo" :value="__('Date To')" />
                                <x-text-input id="dateTo" class="block mt-1 w-auto date-form" type="date" name="dateTo" :value="old('dateTo')" required autofocus autocomplete="dateTo" />
                                <x-input-error :messages="$errors->get('dateTo')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex">
                            <!-- Accounts Type -->
                            <div class="mt-6 mr-10">
                                <x-input-label for="accounttype_id" :value="__('Accounts Type')" />
                                <select id="accounttype_id" name="accounttype_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    @foreach($accountTypes as $accountType)
                                    <option value="{{$accountType->id}}">{{ $accountType->name_bn }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('accounttype_id')" class="mt-2" />
                            </div>

                            <!-- Accounts Category -->
                            <div class="mt-6 mr-10">
                                <x-input-label for="accountcategory_id" :value="__('Accounts Category')" />
                                <select id="accountcategory_id" name="accountcategory_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    @foreach($accountCategories as $accountCategory)
                                    <option value="{{$accountCategory->id}}">{{ $accountCategory->name_bn }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('accountcategory_id')" class="mt-2" />
                            </div>

                            <!-- Accounts Name -->
                            <div class="mt-6 mr-10">
                                <x-input-label for="accountname_id" :value="__('Accounts Name')" />
                                <select id="accountname_id" name="accountname_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    @foreach($accountNames as $accountName)
                                    <option value="{{$accountName->id}}">{{ $accountName->name_bn }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('accountname_id')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-start mt-6">
                            <x-primary-button class="ms-0">
                                {{ __('Show Transaction') }}
                            </x-primary-button>
                        </div>
                    </form>
                    <!-- Transaction Form END -->
                    <h3 class="mt-6 font-semibold text-xl text-gray-800 leading-tight">{{ __("Last Transaction History") }}</h3>

                    <!-- Table START -->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Trans Id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        User
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        AC Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Trans Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        AC Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        AC Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Amount
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Detail
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $transaction->id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $transaction->user->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ optional($transaction->accountname)->name_bn }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ optional($transaction->accountname->transtype)->name_bn }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ optional($transaction->accountname->accounttype)->name_bn }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ optional($transaction->accountname->accountcategory)->name_bn }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $transaction->amount }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $transaction->detail }}
                                    </td>
                                    <td class="flex items-center px-6 py-4">
                                        <a href="{{ route('transactions.show', $transaction) }}" class="font-medium text-blue-600 hover:underline">View</a>
                                        <a href="{{ route('transactions.edit', $transaction) }}" class="ml-4 font-medium text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 hover:underline ms-3">Remove</bitton>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ 'Pagination' }}
                    </div>
                    <!-- Table END $transaction->links()-->
                </div>
            </div>
        </div>
    </div>
    @endauth

    <script>
        // 
    </script>
</x-app-layout>