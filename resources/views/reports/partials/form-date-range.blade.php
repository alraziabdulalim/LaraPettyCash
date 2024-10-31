<!-- Transaction History Form START -->
<div class="p-5 bg-slate-800 rounded-lg flex">
    <form method="POST" action="{{ route('reports.dateRangeReport') }}">
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
