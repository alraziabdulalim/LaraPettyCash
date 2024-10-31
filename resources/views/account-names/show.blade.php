@auth
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Account Name :: Show') }}
                </h2>
                @include('partials.sub-menu')
            </div>
        </x-slot>

        <div>
            <div class="max-w-2xl mx-auto px-6 py-2 sm:px-2 lg:px-4">
                <!-- Table START -->
                <div class="mt-2 p-5 bg-slate-800 rounded-lg text-white">
                    <table class="w-full min-w-min bg-center border-collapse border-b border-white">
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xl uppercase border-b border-solid border-0.5 border-white" colspan="2">A/C
                                Name Detail</th>
                        </tr>
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xs uppercase border-b border-solid border-0.5 border-white">Name Bn</th>
                            <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                {{ $accountName->name_bn }}
                            </td>
                        </tr>
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xs uppercase border-b border-solid border-0.5 border-white">Old Name</th>
                            <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                {{ $accountName->old_name }}
                            </td>
                        </tr>
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xs uppercase border-b border-solid border-0.5 border-white">Name En</th>
                            <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                {{ $accountName->name }}
                            </td>
                        </tr>
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xs uppercase border-b border-solid border-0.5 border-white">A/C Name Id</th>
                            <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                {{ $accountName->id }}
                            </td>
                        </tr>
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xs uppercase border-b border-solid border-0.5 border-white">Parent Name</th>
                            <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                {{ is_null($accountName->topAccount) ? 'Top Parent' : $accountName->topAccount->name }}
                            </td>
                        </tr>
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xs uppercase border-b border-solid border-0.5 border-white">Account Type</th>
                            <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                {{ $accountName->trans_type }}
                            </td>
                        </tr>
                        <tr class="border-b border-solid border-0.5 border-white">
                            <th class="text-xs uppercase border-b border-solid border-0.5 border-white">Account Type</th>
                            <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                {{ $accountName->account_group }}
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- Table END -->
            </div>
        </div>
    </x-app-layout>
@endauth
