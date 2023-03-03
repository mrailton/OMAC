<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm">
            <div class="p-6 text-gray-900">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">Members</h1>
                            <p class="mt-2 text-sm text-gray-700">A list of all the members with their OMAC ID and
                                clinical
                                level.</p>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <a href="{{ route('members:create') }}" type="button"
                               class="block bg-red-600 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Add
                                Member</a>
                        </div>
                    </div>
                    <div class="mt-8 flow-root">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead>
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">OMAC ID
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Clinical
                                            Level
                                        </th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                            <span class="sr-only">View</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                    @foreach($members as $member)
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $member->name }}</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">{{ $member->omac_id_number }}</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">{{ $member->clinical_level->value }}</td>
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                                <a href="{{ route('members:show', ['member' => $member]) }}"
                                                   class="text-red-600 hover:text-red-900">View<span
                                                        class="sr-only">, {{ $member->name }}</span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
