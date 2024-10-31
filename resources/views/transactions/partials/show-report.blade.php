<div class="mt-2 p-5 bg-slate-800 rounded-lg text-white">
    <!-- Table START -->
    <table class="w-full min-w-min bg-center border-collapse border-b border-white">
        <thead class="text-xs uppercase">
            <tr class="border-b border-solid border-0.5 border-white">
                <th class="border-b border-solid border-0.5 border-white">Post Date</th>
                <th class="border-b border-solid border-0.5 border-white">Vou. Date</th>
                <th class="border-b border-solid border-0.5 border-white">Trans. No</th>
                <th class="border-b border-solid border-0.5 border-white">A/C Name</th>
                <th class="border-b border-solid border-0.5 border-white">Details</th>
                <th class="border-b border-solid border-0.5 border-white">Debit (Tk)</th>
                <th class="border-b border-solid border-0.5 border-white">Credit (Tk)</th>
                <th class="border-b border-solid border-0.5 border-white">Balance (Tk)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $runningBalance = $openingBalance;
            @endphp

            @foreach ($transactions as $transaction)
                @php
                    $amount = $transaction->amount;
                    $runningBalance += $transaction->trans_type == 'Debit' ? $amount : -$amount;
                @endphp
                <tr>
                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-nowrap">
                        {{ $transaction->created_at->format('d-m-Y') }}
                    </td>
                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-nowrap">
                        {{ \Carbon\Carbon::parse($transaction->voucher_at)->format('d-m-Y') }}
                    </td>
                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                        <a
                            href="{{ route('vouchers.show', ['transaction' => $transaction->id]) }}">{{ $transaction->id }}</a>
                    </td>
                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                        {{ $transaction->accountName->name_bn }}
                    </td>
                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-sm">
                        {{ $transaction->details }}
                    </td>
                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-right">
                        {{ $transaction->trans_type == 'Debit' ? $transaction->amount : 0 }}
                    </td>
                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-right">
                        {{ $transaction->trans_type == 'Credit' ? $transaction->amount : 0 }}
                    </td>
                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-right">
                        {{ $runningBalance }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Table END -->
    <!-- Pagination -->
    <div class="mt-2 px-2 py-2 bg-slate-800 rounded-lg">
        {{-- {{ $transactions->links() }} --}}
    </div>
</div>
