<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction') }}
        </h2>
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('transactions.index') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Show Last Transaction') }}
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
                    {{ __("Transaction Entry Form") }}
                    <!-- Transaction Form START -->
                    <form method="POST" action="{{ route('transactions.store') }}">
                        @csrf

                        <!-- Accounts Type -->
                        <div class="mt-6">
                            <x-input-label for="accounttype_id" :value="__('Accounts Type')" />
                            <select id="accounttype_id" name="accounttype_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach($accountTypes as $accountType)
                                <option value="{{$accountType->id}}">{{ $accountType->name_bn }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('accounttype_id')" class="mt-2" />
                        </div>

                        <!-- Accounts Category -->
                        <div class="mt-3">
                            <x-input-label for="accountcategory_id" :value="__('Accounts Category')" />
                            <select id="accountcategory_id" name="accountcategory_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach($accountCategories as $accountCategory)
                                <option value="{{$accountCategory->id}}">{{ $accountCategory->name_bn }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('accountcategory_id')" class="mt-2" />
                        </div>

                        <!-- Accounts Name -->
                        <div class="mt-3">
                            <x-input-label for="accountname_id" :value="__('Accounts Name')" />
                            <select id="accountname_id" name="accountname_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach($accountNames as $accountName)
                                <option value="{{$accountName->id}}">{{ $accountName->name_bn }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('accountname_id')" class="mt-2" />
                        </div>

                        <!-- Transaction Amount -->
                        <div class="mt-3">
                            <x-input-label for="amount" :value="__('Amount')" />
                            <x-text-input id="amount" class="block mt-1 w-full" type="text" name="amount" :value="old('amount')" required autofocus autocomplete="amount" />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <!-- Transaction Details -->
                        <div class="mt-3">
                            <x-input-label for="detail" :value="__('Detail')" />
                            <textarea id="detail" name="detail" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus autocomplete="detail">{{ old('detail') }}</textarea>
                            <x-input-error :messages="$errors->get('detail')" class="mt-2" />
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-3">
                            <x-primary-button class="ms-4">
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>

                    </form>
                    <!-- Transaction Form END -->
                </div>
            </div>
        </div>
    </div>
    @endauth
</x-app-layout>