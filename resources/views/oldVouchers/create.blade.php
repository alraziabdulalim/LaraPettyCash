@auth
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Old Voucher :: Form') }}
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
            <a href="{{ route('oldVouchers') }}">
                <x-primary-button class="ms-4 text-sm text-white-600 bg-neutral-700 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('All Vouchers') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="p-10">
        <div class="max-w-2xl mx-auto px-6 py-2 sm:px-2 lg:px-4">
            <!-- Transaction Form START -->
            <div class="p-5 bg-neutral-700 rounded-lg">
                <form method="POST" action="{{ route('oldVouchers.store') }}">
                    @csrf

                    <!-- Transaction Date -->
                    <div class="mt-3">
                        <x-input-label for="voucher_at" :value="__('Transaction Date')" class="text-white whitespace-nowrap" />
                        <x-text-input id="voucher_at" class="block mt-1 w-full" type="text" name="voucher_at" :value="old('voucher_at')" required autofocus autocomplete="voucher_at" />
                        <x-input-error :messages="$errors->get('voucher_at')" class="mt-2" />
                    </div>

                    <!-- Accounts Type -->
                    <div class="mt-3">
                        <x-input-label for="oldactype_id" :value="__('Accounts Type')" class="text-white whitespace-nowrap" />
                        <select id="oldactype_id" name="oldactype_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach($oldacTypes as $oldacType)
                            <option value="{{$oldacType->id}}">{{ $oldacType->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('oldactype_id')" class="mt-2" />
                    </div>

                    <!-- Top Accounts Name -->
                    <div class="mt-3">
                        <x-input-label for="parent_id" :value="__('Top Accounts Name')" class="text-white whitespace-nowrap" />
                        <select id="parent_id" name="parent_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach($parentAcs as $parentAc)
                            <option value="{{$parentAc->id}}">{{ $parentAc->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
                    </div>

                    <!-- Accounts Name -->
                    <div class="mt-3">
                        <x-input-label for="oldacname_id" :value="__('Accounts Name')" class="text-white whitespace-nowrap" />
                        <select id="oldacname_id" name="oldacname_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach($oldacNames as $oldacName)
                            <option value="{{$oldacName->id}}">{{ $oldacName->s_name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('oldacname_id')" class="mt-2" />
                    </div>

                    <!-- Transaction Amount -->
                    <div class="mt-3">
                        <x-input-label for="amount" :value="__('Amount')" class="text-white whitespace-nowrap" />
                        <x-text-input id="amount" class="block mt-1 w-full" type="text" name="amount" :value="old('amount')" required autofocus autocomplete="amount" />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <!-- Transaction Details -->
                    <div class="mt-3">
                        <x-input-label for="details" :value="__('Detail')" class="text-white whitespace-nowrap" />
                        <textarea id="details" name="details" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus autocomplete="details">{{ old('details') }}</textarea>
                        <x-input-error :messages="$errors->get('details')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-3">
                        <button class="bg-white text-green-700 rounded-md items-center px-6 py-3 border border-transparent font-semibold text-xs uppercase tracking-widest  hover:text-white hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Submit New Transaction') }}
                        </button>
                    </div>

                </form>
            </div>
            <!-- Transaction Form END -->
        </div>
    </div>
</x-app-layout>

<script>
    flatpickr("#voucher_at", {
        dateFormat: "d-m-Y"
    });
</script>
@endauth