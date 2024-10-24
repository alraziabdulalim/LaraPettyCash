@auth
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Account Name :: Edit Form') }}
            </h2>
            @include('partials.sub-menu')
        </x-slot>

        <div class="p-10">
            <div class="max-w-2xl mx-auto px-6 py-2 sm:px-2 lg:px-4">
                <!-- Transaction Form START -->
                <div class="p-5 bg-slate-800 rounded-lg">
                    <form method="POST" action="{{ route('account-names.update', ['account_name' => $accountName->id]) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Account Name -->
                        <div class="mt-3">
                            <x-input-label for="name" :value="__('Account Name')" class="text-white whitespace-nowrap" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                value="{{ $accountName->name }}" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Account Name Bangla -->
                        <div class="mt-3">
                            <x-input-label for="name_bn" :value="__('Bengali Name')" class="text-white whitespace-nowrap" />
                            <x-text-input id="name_bn" class="block mt-1 w-full" type="text" name="name_bn"
                                value="{{ $accountName->name_bn }}" required autofocus autocomplete="name_bn" />
                            <x-input-error :messages="$errors->get('name_bn')" class="mt-2" />
                        </div>

                        <!-- Parent Id -->
                        <div class="mt-3">
                            <x-input-label for="parent_id" :value="__('Parent Account Id')" class="text-white whitespace-nowrap" />
                            <select id="parent_id" name="parent_id"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Null</option>
                                @foreach ($parentNames as $parentName)
                                    <option value="{{ $parentName->id }}"
                                        {{ $parentName->id == $accountName->parent_id ? 'selected' : '' }}>
                                        {{ $parentName->name_bn }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
                        </div>

                        <!-- Trans Type -->
                        <div class="mt-3">
                            <x-input-label for="trans_type" :value="__('Trans Type')" class="text-white whitespace-nowrap" />
                            <select id="trans_type" name="trans_type"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="Debit" {{ $accountName->trans_type == 'Debit' ? 'selected' : '' }}>Debit
                                </option>
                                <option value="Credit" {{ $accountName->trans_type == 'Credit' ? 'selected' : '' }}>Credit
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('trans_type')" class="mt-2" />
                        </div>

                        <!-- Accounts Group -->
                        <div class="mt-3">
                            <x-input-label for="account_group" :value="__('Accounts Group')" class="text-white whitespace-nowrap" />
                            <select id="account_group" name="account_group" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="Income" {{ $accountName->account_group == 'Income' ? 'selected' : '' }}>Income</option>
                                <option value="Cost" {{ $accountName->account_group == 'Cost' ? 'selected' : '' }}>Cost</option>
                                <option value="Expenditure" {{ $accountName->account_group == 'Expenditure' ? 'selected' : '' }}>Expenditure</option>
                                <option value="Loan" {{ $accountName->account_group == 'Loan' ? 'selected' : '' }}>Loan</option>
                                <option value="Cash_In" {{ $accountName->account_group == 'Cash_In' ? 'selected' : '' }}>Cash In</option>
                                <option value="Cash_Out" {{ $accountName->account_group == 'Cash_Out' ? 'selected' : '' }}>Cash Out</option>
                            </select>
                            <x-input-error :messages="$errors->get('account_group')" class="mt-2" />
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
            </div>
        </div>
    </x-app-layout>

    <script>
        flatpickr("#voucher_at", {
            altInput: true,
            altFormat: "d-m-Y",
        });
    </script>
@endauth
