<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalhes da Proposta
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                @if (session('success'))
                    <div class="p-4 rounded-md bg-green-100 border border-green-300 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-4 rounded-md bg-red-100 border border-red-300 text-red-800">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-8 space-y-6">
                        <div class="flex justify-between items-start">
                            <h3 class="text-3xl font-bold text-gray-900">{{ $proposta->titulo }}</h3>

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
                        </div>

                        <div class="border-t pt-4">
                            <p class="text-lg text-gray-600">Orçamento Proposto</p>
                            <p class="text-4xl font-bold text-green-600">R$ {{ number_format($proposta->valor, 2, ',', '.') }}</p>
                        </div>

                        <div class="border-t pt-4">
                            <h4 class="text-lg font-semibold text-gray-800 mb-2">Descrição do Projeto</h4>
                            <div class="prose max-w-none text-gray-700">
                                {{ $proposta->descricao }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4">Participantes</h4>
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <span class="font-bold w-24">Proponente:</span>
                                    <span>{{ $proposta->enviador->name }}</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="font-bold w-24">Responsável:</span>
                                    <span>{{ $proposta->recebedor->name ?? 'Aguardando Dev' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (auth()->id() !== $proposta->enviador->id && $proposta->status->id === 1)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h4 class="text-lg font-semibold text-gray-800 mb-4">Ações</h4>
                                <div class="space-y-3">
                                    <form action="{{ route('proposta.aceitar', $proposta) }}" method="POST">
                                        @csrf
                                        <x-primary-button class="w-full justify-center">Aceitar Proposta</x-primary-button>
                                    </form>
                                    <form action="{{ route('proposta.recusar', $proposta) }}" method="POST">
                                        @csrf
                                        <x-primary-button class="w-full justify-center">Recusar Proposta</x-primary-button>
                                    </form>
                                    <a href="{{ route('proposta.edit', $proposta) }}"
                                       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full justify-center">
                                        Contra-Proposta
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (auth()->id() === $proposta->solicitante->id && $proposta->status->id === 3)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h4 class="text-lg font-semibold text-gray-800 mb-4">Ações</h4>
                                <div class="space-y-3">
                                    <form action="{{ route('proposta.pagamento', $proposta) }}" method="POST">
                                        @csrf
                                        <x-primary-button class="w-full justify-center">Pagar Proposta</x-primary-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
