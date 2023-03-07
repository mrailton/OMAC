<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm">
            <div class="p-6 text-gray-900">
                <div class="px-4 sm:px-6 lg:px-8">
                    <form action="{{ route('members.update', ['member' => $member]) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                            <div class="space-y-6 sm:space-y-5">
                                <div>
                                    <h1 class="text-base font-semibold leading-6 text-gray-900">Update Member</h1>
                                    <p class="mt-2 text-sm text-gray-700">Update members details.</p>
                                </div>

                                <div class="space-y-6 sm:space-y-5">
                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Name</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <div class="flex max-w-lg rounded-md shadow-sm">
                                                <input type="text" name="name" id="name" value="{{ $member->name }}" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                                            </div>
                                            @error('name')
                                            <div class="text-sm text-red-600 pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                        <label for="omac_id_number" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">OMAC ID</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <div class="flex max-w-lg rounded-md shadow-sm">
                                                <input type="text" name="omac_id_number" id="omac_id_number" value="{{ $member->omac_id_number }}" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                                            </div>
                                            @error('omac_id_number')
                                            <div class="text-sm text-red-600 pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                        <label for="clinical_level" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Clinical Level</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <select id="clinical_level" name="clinical_level" class="block w-full max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                @foreach($clinicalLevels as $value)
                                                    <option @if($member->clinical_level->value == $value) selected @endif value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('clinical_level')
                                            <div class="text-sm text-red-600 pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                        <label for="cfr_level" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">CFR Level</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <select id="cfr_level" name="cfr_level" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                @foreach($cfrLevels as $value)
                                                    <option @if($member->cfr_level->value == $value) selected @endif value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('cfr_level')
                                            <div class="text-sm text-red-600 pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                        <label for="cfr_cert_number" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">CFR Certificate</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <div class="flex max-w-lg rounded-md shadow-sm">
                                                <input type="text" name="cfr_cert_number" id="cfr_cert_number" value="{{ $member->cfr_cert_number }}" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                                            </div>
                                            @error('cfr_cert_number')
                                            <div class="text-sm text-red-600 pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                        <label for="cfr_expires_on" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">CFR Expiry</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <div class="flex max-w-lg rounded-md shadow-sm">
                                                <input type="date" name="cfr_expires_on" id="cfr_expires_on" value="{{ $member->cfr_expires_on?->format('Y-m-d') }}" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                                            </div>
                                            @error('cfr_expires_on')
                                            <div class="text-sm text-red-600 pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                        <label for="far_cert_number" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">FAR Certificate</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <div class="flex max-w-lg rounded-md shadow-sm">
                                                <input type="text" name="far_cert_number" id="far_cert_number" value="{{ $member->far_cert_number }}" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                                            </div>
                                            @error('far_cert_number')
                                            <div class="text-sm text-red-600 pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                        <label for="far_expires_on" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">FAR Expiry</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <div class="flex max-w-lg rounded-md shadow-sm">
                                                <input type="date" name="far_expires_on" id="far_expires_on" value="{{ $member->far_expires_on?->format('Y-m-d') }}" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                                            </div>
                                            @error('far_expires_on')
                                            <div class="text-sm text-red-600 pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                        <label for="efr_cert_number" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">EFR Certificate</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <div class="flex max-w-lg rounded-md shadow-sm">
                                                <input type="text" name="efr_cert_number" id="efr_cert_number" value="{{ $member->efr_cert_number }}" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                                            </div>
                                            @error('efr_cert_number')
                                            <div class="text-sm text-red-600 pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                        <label for="efr_expires_on" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">EFR Expiry</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <div class="flex max-w-lg rounded-md shadow-sm">
                                                <input type="date" name="efr_expires_on" id="efr_expires_on" value="{{ $member->efr_expires_on?->format('Y-m-d') }}" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                                            </div>
                                            @error('efr_expires_on')
                                            <div class="text-sm text-red-600 pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                        <label for="phecc_pin" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">PHECC PIN</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <div class="flex max-w-lg rounded-md shadow-sm">
                                                <input type="text" name="phecc_pin" id="phecc_pin" value="{{ $member->phecc_pin }}" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                                            </div>
                                            @error('phecc_pin')
                                            <div class="text-sm text-red-600 pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                        <label for="notes" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Notes</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <textarea id="notes" name="notes" rows="3" class="block w-full max-w-lg rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:py-1.5 sm:text-sm sm:leading-6">
                                                {{ $member->notes }}
                                            </textarea>
                                        </div>
                                        @error('notes')
                                        <div class="text-sm text-red-600 pt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-5">
                            <div class="flex justify-end gap-x-3">
                                <a href="{{ route('members.show', ['member' => $member]) }}" type="button"
                                        class="rounded-md bg-white py-2 px-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                    Cancel
                                </a>
                                <button type="submit"
                                        class="inline-flex justify-center rounded-md bg-red-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
