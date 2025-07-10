<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Meu Perfil
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6">Informações do Perfil</h3>

                    <div class="flex flex-col items-center mb-8">
                        @if ($user->path_foto)
                            <img src="{{ asset('storage/' . $user->path_foto) }}" alt="Foto de Perfil"
                                 class="w-32 h-32 object-cover rounded-full border-4 border-indigo-500 shadow-lg">
                        @else
                            <div class="w-32 h-32 flex items-center justify-center bg-gray-200 text-gray-500 rounded-full text-5xl font-bold border-4 border-indigo-500 shadow-lg">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif

                        <p class="mt-4 text-xl font-bold text-gray-900">{{ $user->name }}</p>
                        <p class="text-md text-gray-600">{{ $user->email }}</p>

                        @if ($user->descricao)
                            <p class="mt-2 text-gray-700 text-center max-w-sm">{{ $user->descricao }}</p>
                        @else
                            <p class="mt-2 text-gray-500 text-center max-w-sm italic">Nenhuma descrição fornecida.</p>
                        @endif
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Sucesso!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <hr class="my-8 border-gray-200">

                    <h4 class="text-xl font-semibold text-gray-900 mb-4">Alterar Foto de Perfil</h4>

                    <form method="POST" action="{{ route('profile.updatePhoto') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <div>
                            <x-input-label for="photo" value="Selecione uma nova foto" />
                            <input id="photo" name="photo" type="file" class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100" />
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                Salvar Nova Foto
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

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
                    {{-- Conteúdo para deletar conta --}}
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
