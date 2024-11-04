<!-- Transaction Form START -->
<div class="p-5 bg-slate-800 rounded-lg">
    <form method="POST" action="{{ route('vouchers.update', $voucher->id) }}">
        @csrf
        @method('PATCH')

        <!-- Transaction Date -->
        <div class="mt-3">
            <x-input-label for="voucher_at" :value="__('Transaction Date')" class="text-white whitespace-nowrap" />
            <x-text-input id="voucher_at" class="block mt-1 w-full" type="text" name="voucher_at" :value="$voucher->voucher_at"
                required autofocus autocomplete="voucher_at" />
            <x-input-error :messages="$errors->get('voucher_at')" class="mt-2" />
        </div>

        <!-- Trans Type -->
        {{-- <div class="mt-3">
            <x-input-label for="trans_type" :value="__('Trans Type')" class="text-white whitespace-nowrap" />
            <select id="trans_type" name="trans_type"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="Debit" {{ $voucher->trans_type == 'Debit' ? 'selected' : '' }}>Debit
                </option>
                <option value="Credit" {{ $voucher->trans_type == 'Credit' ? 'selected' : '' }}>Credit
                </option>
            </select>
            <x-input-error :messages="$errors->get('trans_type')" class="mt-2" />
        </div> --}}

        <!-- Top Accounts Name -->
        {{-- <div class="mt-3">
            <x-input-label for="parent_id" :value="__('Top Accounts Name')" class="text-white whitespace-nowrap" />
            <select id="parent_id" name="parent_id"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                @foreach ($parentNames as $parentName)
                    <option value="{{ $parentName->id }}"
                        {{ $voucher->parent_id == $parentName->id ? 'selected' : '' }}>
                        {{ $parentName->id . ' : ' . $parentName->name_bn }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
        </div> --}}

        <!-- Accounts Name -->
        <div class="mt-3">
            <x-input-label for="account_name_id" :value="__('Accounts Name')" class="text-white whitespace-nowrap" />
            <select id="account_name_id" name="account_name_id"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                @foreach ($accountNames as $accountName)
                    <option value="{{ $accountName->id }}"
                        {{ $voucher->account_name_id == $accountName->id ? 'selected' : '' }}>
                        {{ $accountName->id . ' : ' . $accountName->name_bn }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('account_name_id')" class="mt-2" />
        </div>

        <!-- Transaction Amount -->
        <div class="mt-3">
            <x-input-label for="amount" :value="__('Amount')" class="text-white whitespace-nowrap" />
            <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="$voucher->amount"
                required autofocus autocomplete="amount" step="0.01" />
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
        </div>

        <!-- Transaction Details -->
        <div class="mt-3">
            <x-input-label for="details" :value="__('Detail')" class="text-white whitespace-nowrap" />
            <textarea id="details" name="details"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required autofocus autocomplete="details">{{ $voucher->details }}</textarea>
            <x-input-error :messages="$errors->get('details')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-3">
            <button
                class="bg-white text-green-700 rounded-md items-center px-6 py-3 border border-transparent font-semibold text-xs uppercase tracking-widest  hover:text-white hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Update Transaction') }}
            </button>
        </div>
    </form>
</div>
<!-- Transaction Form END -->


<script>
    flatpickr("#voucher_at", {
        altInput: true,
        altFormat: "d-m-Y",
    });
</script>
