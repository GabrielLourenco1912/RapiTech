<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Minhas Avaliações
        </h2>
    </x-slot>

    <div class="py-12">
        @if(auth()->user()->role_id === 2)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Avaliações Recebidas</h3>
                    <div class="space-y-6">
                        @forelse ($avaliacoesRecebidas as $avaliacao)
                            <div class="border-t pt-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm text-gray-500">Avaliação para o serviço:</p>
                                        <a href="{{ route('servico.show', $avaliacao->servico) }}" class="font-semibold text-lg text-indigo-600 hover:underline">{{ $avaliacao->servico->titulo }}</a>
                                    </div>
{{--                                    <div class="flex items-center">--}}
{{--                                        @for ($i = 1; $i <= 5; $i++)--}}
{{--                                            <svg class="w-5 h-5 {{ $i <= $avaliacao->nota ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">--}}
{{--                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />--}}
{{--                                            </svg>--}}
{{--                                        @endfor--}}
{{--                                    </div>--}}
                                </div>
                                <blockquote class="mt-4 p-4 bg-gray-50 rounded-lg border">
                                    <p class="text-gray-700">"{{ $avaliacao->descricao }}"</p>
                                    <footer class="mt-2 text-sm text-gray-500">- {{ $avaliacao->enviador->name }}</footer>
                                </blockquote>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 py-4">Você ainda não recebeu nenhuma avaliação.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        @elseif(auth()->user()->role_id === 3)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Avaliações que Você Fez</h3>
                    <div class="space-y-6">
                        @forelse ($avaliacoesFeitas as $avaliacao)
                            <div class="border-t pt-6">
                                <p class="text-sm text-gray-500">Você avaliou <span class="font-bold">{{ $avaliacao->destinatario->name }}</span> pelo serviço:</p>
                                <a href="{{ route('servico.show', $avaliacao->servico) }}" class="font-semibold text-lg text-indigo-600 hover:underline">{{ $avaliacao->servico->titulo }}</a>
{{--                                <div class="flex items-center mt-2">--}}
{{--                                    @for ($i = 1; $i <= 5; $i++)--}}
{{--                                        <svg class="w-5 h-5 {{ $i <= $avaliacao->nota ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">--}}
{{--                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />--}}
{{--                                        </svg>--}}
{{--                                    @endfor--}}
{{--                                </div>--}}
                                <blockquote class="mt-2 text-gray-600 italic">"{{ $avaliacao->descricao }}"</blockquote>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 py-4">Você ainda não fez nenhuma avaliação.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif
        </div>
    </div>
</x-app-layout>
