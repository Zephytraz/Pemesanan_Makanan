<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="font-semibold text-gray-700">Saldo Anda</h3>
                    <p class="text-lg text-gray-800">
                        Rp {{ number_format(auth()->user()->saldo, 0, ',', '.') }}

                    <form action="{{ route('saldo.update') }}" method="post" class="mt-4">
                        @csrf
                        <div class="mb-3">
                            <label for="saldo" class="form-label text-gray-700">Tambah Saldo</label>
                            <input type="number" name="saldo" id="saldo"
                                class="form-control border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Masukkan jumlah saldo" min="0">
                        </div>
                        <button type="submit"
                            class="btn btn-primary w-full mt-3 bg-indigo-600 font-semibold py-2 rounded-md shadow-sm">
                            Tambah Saldo
                        </button>
                    </form>
                    </p>
                </div>
            </div>



            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
