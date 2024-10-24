@auth
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Voucher :: Show') }}
            </h2>
            @include('partials.sub-menu')
        </x-slot>

        <div class="p-10">
            <div class="max-w-2xl mx-auto px-6 py-2 sm:px-2 lg:px-4">
                <!-- Table START -->
                <div class="mt-2 p-5 bg-slate-800 rounded-lg text-white">
                    <table class="w-full min-w-min bg-center border-collapse border-b border-white">
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xl uppercase border-b border-solid border-0.5 border-white" colspan="2">Voucher
                                Detail of {{ $transaction->id }}</th>
                        </tr>
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xs uppercase border-b border-solid border-0.5 border-white">A/C Name</th>
                            <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                {{ $transaction->accountName->name_bn }}
                            </td>
                        </tr>
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xs uppercase border-b border-solid border-0.5 border-white">Parent Account</th>
                            <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                {{ is_null($transaction->accountName->topAccount) ? 'Top Parent' : $transaction->accountName->topAccount->name_bn }}
                            </td>
                        </tr>
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xs uppercase border-b border-solid border-0.5 border-white">A/C Type</th>
                            <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                {{ $transaction->accountName->trans_type }}
                            </td>
                        </tr>
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xs uppercase border-b border-solid border-0.5 border-white">Post Date</th>
                            <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                {{ $transaction->created_at->format('d-m-Y') }}
                            </td>
                        </tr>
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xs uppercase border-b border-solid border-0.5 border-white">Vou. Date</th>
                            <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                {{ \Carbon\Carbon::parse($transaction->voucher_at)->format('d-m-Y') }}
                            </td>
                        </tr>
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xs uppercase border-b border-solid border-0.5 border-white">Details</th>
                            <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                {{ $transaction->details }}
                            </td>
                        </tr>
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xs uppercase border-b border-solid border-0.5 border-white">Amount (Tk)</th>
                            <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                {{ $transaction->amount }}
                            </td>
                        </tr>
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xs uppercase border-b border-solid border-0.5 border-white">Update need</th>
                            <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                <a href="{{ route('vouchers.edit', ['transaction' => $transaction->id]) }}">Yes</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- Table END -->
            </div>
        </div>
    </x-app-layout>
@endauth
