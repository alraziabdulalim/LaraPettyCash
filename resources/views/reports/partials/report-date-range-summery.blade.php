<!-- Table START -->
<div class="mt-2 p-5 bg-slate-800 rounded-lg text-white">
    <table class="w-full min-w-min bg-center border-collapse border-b border-white">
        <thead class="text-xs uppercase">
            <tr class="border-b border-solid border-0.5 border-white">
                <th class="border-b border-solid border-0.5 border-white">Account Name</th>
                <th class="border-b border-solid border-0.5 border-white">Debit (Tk)</th>
                <th class="border-b border-solid border-0.5 border-white">Credit (Tk)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-nowrap">
                    Opening Balance
                </td>
                <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-right">
                    {{ $openingBalance }}
                </td>
                <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-right">
                </td>
            </tr>
            @php
                $debitAmount = 0;
                $creditAmount = 0;
            @endphp
            @foreach ($dateRangeReports as $reportRow)
                <tr>
                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-nowrap">
                        {{ $reportRow['accountNameBn'] }}
                    </td>
                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-right">
                        {{ $reportRow['transType'] == 'Debit' ? $reportRow['amount'] : 0 }}
                    </td>
                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-right">
                        {{ $reportRow['transType'] == 'Credit' ? $reportRow['amount'] : 0 }}
                    </td>
                </tr>
                @php
                    if ($reportRow['transType'] == 'Debit') {
                        $debitAmount += $reportRow['amount'];
                    } elseif ($reportRow['transType'] == 'Credit') {
                        $creditAmount += $reportRow['amount'];
                    }
                @endphp
            @endforeach
            <tr>
                <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-nowrap">
                    Total Amount =
                </td>
                <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-right">
                    {{ $debitAmount }}
                </td>
                <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-right">
                    {{ $creditAmount }}
                </td>
            </tr>
            <tr>
                <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-nowrap">
                    Closing Balance
                </td>
                <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-right">
                    {{ $openingBalance+$debitAmount-$creditAmount }}
                </td>
                <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-right">
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!-- Table END -->
