<!-- Transaction History Form START -->
<div class="mt-2 p-5 bg-slate-800 rounded-lg flex">
    <form method="POST" action="{{ route('reports.accountWiseReport') }}">
        @csrf

        <div class="flex">
            <!-- Transaction Start Date -->
            <div>
                <x-text-input id="startDate" class="voucher_at block mt-1 w-full" type="date" name="startDate"
                    :value="old('startDate')" placeholder="Date From" required autofocus autocomplete="startDate" />
                <x-input-error :messages="$errors->get('startDate')" class="mt-2" />
            </div>

            <!-- Transaction End Date -->
            <div class="ml-4">
                <x-text-input id="endDate" class="voucher_at block mt-1 w-full" type="date" name="endDate"
                    :value="old('endDate')" placeholder="Date To" required autofocus autocomplete="endDate" />
                <x-input-error :messages="$errors->get('endDate')" class="mt-2" />
            </div>

            <!-- Accounts Name -->
            <div class="ml-4">
                <select id="account_name_id" name="account_name_id" class="block mt-1 w-full rounded-lg">
                    <option value="">Select AC Name</option>
                    @foreach ($accountNames as $accountName)
                        <option value="{{ $accountName->id }}">{{ $accountName->name_bn }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('account_name_id')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="ml-4 mt-1">
                <button type="submit"
                    class="bg-white text-green-700 rounded-md items-center px-6 py-3 border border-transparent font-semibold text-xs uppercase tracking-widest  hover:text-white hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Show') }}
                    <button>
            </div>
        </div>
    </form>
</div>
<!-- Transaction History Form END -->

<script>
    flatpickr(".voucher_at", {
        dateFormat: "d-m-Y"
    });
</script>
