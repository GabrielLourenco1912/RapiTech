<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gerenciamento de Propostas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            @if(auth()->user()->role_id === 3)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-8 text-center">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Pronto para Começar?</h3>
                        <p class="text-gray-600 mb-6">Clique no botão abaixo para iniciar uma nova negociação.</p>
                        <a href="{{ route('proposta.create') }}"
                           class="inline-block bg-blue-600 text-white font-bold py-3 px-8 rounded-lg shadow-lg hover:bg-blue-700 transition-transform transform hover:scale-105">
                            + Criar Nova Proposta
                        </a>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    @if(auth()->user()->role_id === 2)
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Propostas Recebidas</h3>
                        <div class="space-y-4">
                            @forelse ($propostas as $proposta)
                                <div class="border rounded-lg p-4 flex justify-between items-center">
                                    <div>
                                        <p class="font-bold text-lg">{{ $proposta->titulo }}</p>
                                        <p class="text-sm text-gray-600">Enviada por: {{ $proposta->enviador->name ?? 'Usuário Desconhecido' }}</p>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        @php
                                            $statusClasses = [
                                                3 => 'bg-blue-100 text-blue-800',
                                                1 => 'bg-yellow-100 text-yellow-800',
                                                4 => 'bg-green-100 text-green-800',
                                                2 => 'bg-red-100 text-red-800',
                                            ];
                                        @endphp
                                        <span class="text-sm font-medium me-2 px-2.5 py-0.5 rounded {{ $statusClasses[$proposta->status->id] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst(str_replace('_', ' ', $proposta->status->nome)) }}
                            </span>
                                        <span class="text-lg font-semibold text-green-600">R$ {{ number_format($proposta->valor, 2, ',', '.') }}</span>
                                        <a href="{{ route('proposta.show', $proposta) }}" class="text-sm text-blue-600 hover:underline">Ver Detalhes</a>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-gray-500 py-4">
                                    <p>Nenhuma proposta recebida no momento.</p>
                                </div>
                            @endforelse
                        </div>
                    @elseif(auth()->user()->role_id === 3)
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Propostas Enviadas</h3>
                        <div class="space-y-4">
                            @forelse ($propostas_enviadas as $proposta)
                                <div class="border rounded-lg p-4 flex justify-between items-center">
                                    <div>
                                        <p class="font-bold text-lg">{{ $proposta->titulo }}</p>
                                        <p class="text-sm text-gray-600">Enviada por: {{ $proposta->enviador->name ?? 'Usuário Desconhecido' }}</p>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        @php
                                            $statusClasses = [
                                                3 => 'bg-blue-100 text-blue-800',
                                                1 => 'bg-yellow-100 text-yellow-800',
                                                4 => 'bg-green-100 text-green-800',
                                                2 => 'bg-red-100 text-red-800',
                                            ];
                                        @endphp
                                        <span class="text-sm font-medium me-2 px-2.5 py-0.5 rounded {{ $statusClasses[$proposta->status->id] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst(str_replace('_', ' ', $proposta->status->nome)) }}
                            </span>
                                        <span class="text-lg font-semibold text-green-600">R$ {{ number_format($proposta->valor, 2, ',', '.') }}</span>
                                        <a href="{{ route('proposta.show', $proposta) }}" class="text-sm text-blue-600 hover:underline">Ver Detalhes</a>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-gray-500 py-4">
                                    <p>Nenhuma proposta enviada.</p>
                                </div>
                            @endforelse
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Contrapropostas e Negociações</h3>
                    <div class="space-y-4">

                        @forelse ($contrapropostas as $contraproposta)
                            <div class="border rounded-lg p-4 flex justify-between items-center bg-yellow-50">
                                <div>
                                    <p class="font-bold text-lg">{{ $contraproposta->titulo }}</p>
                                    <p class="text-sm text-gray-600">Última oferta de: {{ $contraproposta->enviador->name ?? 'Usuário Desconhecido' }}</p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    @php
                                        $statusClasses = [
                                            3 => 'bg-blue-100 text-blue-800',
                                            1 => 'bg-yellow-100 text-yellow-800',
                                            4 => 'bg-green-100 text-green-800',
                                            2 => 'bg-red-100 text-red-800',
                                        ];
                                    @endphp
                                    <span class="text-sm font-medium me-2 px-2.5 py-0.5 rounded {{ $statusClasses[$proposta->status->id] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst(str_replace('_', ' ', $proposta->status->nome)) }}
                            </span>
                                    <span class="text-lg font-semibold text-orange-600">R$ {{ number_format($contraproposta->valor, 2, ',', '.') }}</span>
                                    <a href="{{ route('proposta.show', $contraproposta) }}" class="text-sm text-blue-600 hover:underline font-bold">Responder</a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500 py-4">
                                <p>Nenhuma negociação pendente.</p>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
