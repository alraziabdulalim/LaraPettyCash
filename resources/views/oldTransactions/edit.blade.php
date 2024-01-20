@auth
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Old Transactions :: Form') }}
        </h2>
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('oldTransactions') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Show Last Transaction') }}
                </x-primary-button>
            </a>
            <a href="{{ route('oldTransactions.show') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Trans Report') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black border-b hover:bg-gray-50">
                    <!-- Transaction Form START -->
                    <form method="POST" action="{{ route('oldTransactions.store') }}">
                        @csrf

                        <!-- Transaction Date -->
                        <div class="mt-3">
                            <x-input-label for="voucher_at" :value="__('Transaction Date')" class="text-gray-900 whitespace-nowrap" />
                            <x-text-input id="voucher_at" class="block mt-1 w-full" type="text" name="voucher_at" :value="old('voucher_at')" required autofocus autocomplete="voucher_at" />
                            <x-input-error :messages="$errors->get('voucher_at')" class="mt-2" />
                        </div>

                        <!-- Accounts Type -->
                        <div class="mt-3">
                            <x-input-label for="oldactype_id" :value="__('Accounts Type')" class="text-gray-900 whitespace-nowrap" />
                            <select id="oldactype_id" name="oldactype_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach($oldacTypes as $oldacType)
                                <option value="{{$oldacType->id}}">{{ $oldacType->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('oldactype_id')" class="mt-2" />
                        </div>

                        <!-- Top Accounts Name -->
                        <div class="mt-3">
                            <x-input-label for="parent_id" :value="__('Top Accounts Name')" class="text-gray-900 whitespace-nowrap" />
                            <select id="parent_id" name="parent_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach($parentAcs as $parentAc)
                                <option value="{{$parentAc->id}}">{{ $parentAc->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
                        </div>

                        <!-- Accounts Name -->
                        <div class="mt-3">
                            <x-input-label for="oldacname_id" :value="__('Accounts Name')" class="text-gray-900 whitespace-nowrap" />
                            <select id="oldacname_id" name="oldacname_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach($oldacNames as $oldacName)
                                <option value="{{$oldacName->id}}">{{ $oldacName->s_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('oldacname_id')" class="mt-2" />
                        </div>

                        <!-- Transaction Amount -->
                        <div class="mt-3">
                            <x-input-label for="amount" :value="__('Amount')" class="text-gray-900 whitespace-nowrap" />
                            <x-text-input id="amount" class="block mt-1 w-full" type="text" name="amount" :value="old('amount')" required autofocus autocomplete="amount" />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <!-- Transaction Details -->
                        <div class="mt-3">
                            <x-input-label for="details" :value="__('Detail')" class="text-gray-900 whitespace-nowrap" />
                            <textarea id="details" name="details" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus autocomplete="details">{{ old('details') }}</textarea>
                            <x-input-error :messages="$errors->get('details')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-3">
                            <x-primary-button class="ms-4 bg-white text-black">
                                {{ __('Submit New Transaction') }}
                            </x-primary-button>
                        </div>

                    </form>
                    <!-- Transaction Form END -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    flatpickr("#voucher_at", {
        dateFormat: "d-m-Y"
    });
</script>
@endauth