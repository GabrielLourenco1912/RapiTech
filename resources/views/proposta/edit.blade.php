<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Fazer Contraproposta
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">

                    <form method="POST" action="{{ route('proposta.update', $proposta) }}" class="space-y-6">
                        @csrf
                        @method('PATCH') <div>
                            <x-input-label for="titulo" value="Título do Projeto ou Proposta" />
                            <x-text-input id="titulo" name="titulo" type="text" class="mt-1 block w-full" :value="old('titulo', $proposta->titulo)" required autofocus />
                            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="descricao" value="Descrição Detalhada da Proposta" />
                            <textarea id="descricao" name="descricao" rows="5" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('descricao', $proposta->descricao) }}</textarea>
                            <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="valor" value="Novo Valor Proposto (R$)" />
                            <x-text-input id="valor" name="valor" type="number" step="0.01" placeholder="ex: 1500.50" class="mt-1 block w-full" :value="old('valor', $proposta->valor)" required />
                            <x-input-error :messages="$errors->get('valor')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('proposta.show', $proposta) }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Cancelar
                            </a>

                            <x-primary-button class="ms-4">
                                Enviar Contraproposta
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
