<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Notificações
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-4">

                    @if (session('success'))
                        <div class="mb-4 rounded-md bg-green-100 p-4 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    @forelse ($notificacoes as $notificacao)
                        <div class="border-l-4 @if(!$notificacao->read_at) border-blue-500 @else border-gray-200 @endif p-4 flex justify-between items-center">
                            <div>
                                <p class="font-bold">{{ $notificacao->titulo }}</p>
                                <p class="text-gray-700">{{ $notificacao->descricao }}</p>
                            </div>

                            <div class="flex items-center space-x-3">

                                @if (!$notificacao->read_at)
                                    <form action="{{ route('notificacao.read', $notificacao) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-gray-400 hover:text-green-500 transition-colors duration-200" title="Marcar como lida">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('notificacao.destroy', $notificacao) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar esta notificação?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors duration-200" title="Apagar notificação">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-gray-500">
                            <p>Você não tem nenhuma notificação.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
