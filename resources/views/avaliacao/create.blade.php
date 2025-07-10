<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Avaliar Serviço: {{ $servico->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <h3 class="text-2xl font-semibold mb-4">Deixe sua avaliação para {{ $servico->dev->name }}</h3>

                    <form method="POST" action="{{ route('avaliacao.store', $servico) }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="servico_id" value="{{ $servico->id }}">
                        <input type="hidden" name="destinatario_id" value="{{ $servico->dev->id }}">

                        <div>
                            <x-input-label for="titulo" value="Título da Avaliação" />
                            <x-text-input id="titulo" name="titulo" type="text" class="mt-1 block w-full" :value="old('titulo')" required autofocus />
                            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="descricao" value="Seu Comentário" />
                            <textarea id="descricao" name="descricao" rows="5" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('descricao') }}</textarea>
                            <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('servico.show', $servico) }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Cancelar
                            </a>
                            <x-primary-button class="ms-4">
                                Enviar Avaliação
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
