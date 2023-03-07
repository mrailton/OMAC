<x-app-layout>
    <div
        class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8"
        x-data="{
            showDeleteMemberModal: false,
            closeModals() {
            }
        }"
    >
        <div class="bg-white overflow-hidden shadow-sm">
            <div class="p-6 text-gray-900">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                        <div class="space-y-6 sm:space-y-5">
                            <div>
                                <h1 class="text-base font-semibold leading-6 text-gray-900">View Member</h1>
                                <p class="mt-2 text-sm text-gray-700">View details of member.</p>
                            </div>

                            <div class="space-y-6 sm:space-y-5">
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                    <span class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Name</span>
                                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                                        <div class="flex max-w-lg">
                                            <span class="block w-full min-w-0 flex-1 py-1.5 pl-3 text-gray-900 sm:text-sm sm:leading-6">
                                                {{ $member->name }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                    <span class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">OMAC ID</span>
                                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                                        <div class="flex max-w-lg">
                                            <span class="block w-full min-w-0 flex-1 py-1.5 pl-3 text-gray-900 sm:text-sm sm:leading-6">
                                                {{ $member->omac_id_number }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                    <span class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Clinical Level</span>
                                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                                        <div class="flex max-w-lg">
                                            <span class="block w-full min-w-0 flex-1 py-1.5 pl-3 text-gray-900 sm:text-sm sm:leading-6">
                                                {{ $member->clinical_level->value }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                    <span class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">CFR Level</span>
                                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                                        <div class="flex max-w-lg">
                                            <span class="block w-full min-w-0 flex-1 py-1.5 pl-3 text-gray-900 sm:text-sm sm:leading-6">
                                                {{ $member->cfr_level->value }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                    <span class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">CFR Certificate</span>
                                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                                        <div class="flex max-w-lg">
                                            <span class="block w-full min-w-0 flex-1 py-1.5 pl-3 text-gray-900 sm:text-sm sm:leading-6">
                                                {{ $member->cfr_cert_number }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                    <span class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">CFR Expiry</span>
                                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                                        <div class="flex max-w-lg">
                                            <span class="block w-full min-w-0 flex-1 py-1.5 pl-3 text-gray-900 sm:text-sm sm:leading-6">
                                                {{ $member->cfr_expires_on?->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                    <span class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">FAR Certificate</span>
                                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                                        <div class="flex max-w-lg">
                                            <span class="block w-full min-w-0 flex-1 py-1.5 pl-3 text-gray-900 sm:text-sm sm:leading-6">
                                                {{ $member->far_cert_number }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                    <span class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">FAR Expiry</span>
                                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                                        <div class="flex max-w-lg">
                                            <span class="block w-full min-w-0 flex-1 py-1.5 pl-3 text-gray-900 sm:text-sm sm:leading-6">
                                                {{ $member->far_expires_on?->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                    <span class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">EFR Certificate</span>
                                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                                        <div class="flex max-w-lg">
                                            <span class="block w-full min-w-0 flex-1 py-1.5 pl-3 text-gray-900 sm:text-sm sm:leading-6">
                                                {{ $member->efr_cert_number }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                    <span class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">EFR Expiry</span>
                                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                                        <div class="flex max-w-lg">
                                            <span class="block w-full min-w-0 flex-1 py-1.5 pl-3 text-gray-900 sm:text-sm sm:leading-6">
                                                {{ $member->efr_expires_on?->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                    <span class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">PHECC PIN</span>
                                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                                        <div class="flex max-w-lg">
                                            <span class="block w-full min-w-0 flex-1 py-1.5 pl-3 text-gray-900 sm:text-sm sm:leading-6">
                                                {{ $member->phecc_pin }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                    <span class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Notes</span>
                                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                                        <div class="flex max-w-lg">
                                            <span class="block w-full min-w-0 flex-1 py-1.5 pl-3 text-gray-900 sm:text-sm sm:leading-6">
                                                {{ $member->notes }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-5">
                        <div class="flex justify-end gap-x-3">
                            <a href="{{ route('members.edit', ['member' => $member]) }}" type="button" class="rounded-md bg-white py-2 px-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                Update Member
                            </a>
                            <button type="button" @click="showDeleteMemberModal = true" class="inline-flex justify-center rounded-md bg-red-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                Delete Member
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="showDeleteMemberModal" class="fixed inset-0 z-50 overflow-y-auto" role="dialog">
            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                <div x-cloak @click="showDeleteMemberModal = false" x-show="showDeleteMemberModal"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"
                ></div>

                <div x-cloak x-show="showDeleteMemberModal"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                >
                    <div class="flex items-center justify-between space-x-4">
                        <h1 class="text-xl font-medium text-gray-800 ">Delete Member</h1>

                        <button @click="showDeleteMemberModal = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>

                    <form class="mt-5" method="POST" action="{{ route('members.delete', ['member' => $member]) }}">
                        @csrf
                        @method('DELETE')

                        <p>Are you sure you want to delete this member?</p>


                        <div class="flex justify-end mt-6">
                            <button type="submit" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-500 focus:ring focus:ring-red-300 focus:ring-opacity-50">
                                Delete Member
                            </button>

                            <button type="button" @click="showDeleteMemberModal = false" class="px-3 py-2 ml-2 text-sm tracking-wide text-gray-900 capitalize transition-colors duration-200 transform bg-white rounded-md hover:bg-gray-400 focus:outline-none focus:bg-gray-500">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
