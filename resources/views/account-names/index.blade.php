@auth
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Account Name :: List') }}
            </h2>
            @include('partials.sub-menu')
        </x-slot>

        <div class="p-10">
            <div class="max-w-7xl mx-auto px-6 py-2 sm:px-2 lg:px-4">
                <!-- Table START -->
                <div class="mt-2 p-5 bg-slate-800 rounded-lg text-white">
                    <table class="w-full min-w-min bg-center border-collapse border-b border-white">
                        <thead class="text-xs uppercase">
                            <tr class="border-b border-solid border-0.5 border-white">
                                <th class="border-b border-solid border-0.5 border-white">Name</th>
                                <th class="border-b border-solid border-0.5 border-white">Old Name</th>
                                <th class="border-b border-solid border-0.5 border-white">Id</th>
                                <th class="border-b border-solid border-0.5 border-white">Old Id</th>
                                <th class="border-b border-solid border-0.5 border-white">Eng Name</th>
                                <th class="border-b border-solid border-0.5 border-white">Parent</th>
                                <th class="border-b border-solid border-0.5 border-white">Type</th>
                                <th class="border-b border-solid border-0.5 border-white">Group</th>
                                <th class="border-b border-solid border-0.5 border-white">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accountNames as $accountName)
                                <tr>
                                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-nowrap">
                                        <a href="{{ route('account-names.show', ['account_name' => $accountName->id]) }}">
                                            {{ $accountName->name_bn }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-nowrap">
                                        <a href="{{ route('account-names.show', ['account_name' => $accountName->id]) }}">
                                            {{ $accountName->old_name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-nowrap">
                                        <a href="{{ route('account-names.show', ['account_name' => $accountName->id]) }}">
                                            {{ $accountName->id }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-nowrap">
                                        <a href="{{ route('account-names.show', ['account_name' => $accountName->id]) }}">
                                            {{ $accountName->old_id }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-nowrap">
                                        <a href="{{ route('account-names.show', ['account_name' => $accountName->id]) }}">
                                            {{ $accountName->name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-nowrap">
                                        {{ is_null($accountName->topAccount) ? 'Top Parent' : $accountName->topAccount->name }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                        {{ $accountName->trans_type }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white text-sm">
                                        {{ $accountName->account_group }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-solid border-0.5 border-white">
                                        <a
                                            href="{{ route('account-names.edit', ['account_name' => $accountName->id]) }}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Table END -->
                <!-- Pagination -->
                <div class="mt-2 px-2 py-2 bg-slate-800 rounded-lg">
                    {{ $accountNames->links() }}
                </div>
            </div>
        </div>
    </x-app-layout>
@endauth
