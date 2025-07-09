<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalhes do Serviço: {{ $servico->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 space-y-6">

                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start">
                        <h3 class="text-3xl font-bold text-gray-900 mb-2 sm:mb-0">{{ $servico->titulo }}</h3>
                        @if ($servico->status)
                            <span class="text-sm font-medium px-3 py-1 rounded-full {{ $servico->status->cor_associada ?? 'bg-gray-200 text-gray-800' }}">
                                {{ $servico->status->nome }}
                            </span>
                        @endif
                    </div>
                    <div class="border-t grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Valor Acordado</p>
                            <p class="text-2xl font-bold text-green-600">R$ {{ number_format($servico->valor, 2, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Data de Início</p>
                            <p class="text-lg text-gray-800">{{ $servico->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="border-t pt-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-3">Participantes</h4>
                        <div class="space-y-2">
                            <p><strong>Cliente:</strong> {{ $servico->cliente->name ?? 'Não definido' }}</p>
                            <p><strong>Desenvolvedor:</strong> {{ $servico->dev->name ?? 'Não definido' }}</p>
                        </div>
                    </div>
                    <div class="border-t pt-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Descrição do Serviço</h4>
                        <div class="prose max-w-none text-gray-700">
                            {{ $servico->descricao }}
                        </div>
                    </div>


                    <div class="border-t pt-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Ações do Projeto</h4>
                        <div class="flex flex-wrap gap-4">
                            <form action="{{ route('servico.concluir', $servico) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja marcar este serviço como concluído?');">
                                @csrf
                                @method('PATCH')
                                <x-primary-button class="bg-green-600 hover:bg-green-700">
                                    Marcar como Concluído
                                </x-primary-button>
                            </form>

                            <form action="{{ route('servico.cancelar', $servico) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja cancelar este serviço? Esta ação não pode ser desfeita.');">
                                @csrf
                                @method('PATCH')
                                <x-danger-button>
                                    Cancelar Serviço
                                </x-danger-button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Relatório do Serviço</h3>

                    @if ($servico->path_relatorio)
                        <div class="space-y-6">
                            <div class="text-center border-2 border-dashed border-gray-300 rounded-lg p-8">
                                <p class="mb-4 text-gray-600">Um relatório já foi enviado. Você pode baixá-lo ou enviar uma nova versão.</p>
                                <a href="{{ route('servico.relatorio.download', $servico) }}"
                                   class="inline-block bg-green-600 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:bg-green-700 transition-transform transform hover:scale-105">
                                    Baixar Relatório Atual
                                </a>
                            </div>

                            <div>
                                <h4 class="font-semibold text-gray-700 mb-2">Enviar um novo relatório (isso substituirá o anterior):</h4>
                                <form action="{{ route('servico.relatorio.update', $servico) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="flex items-center space-x-4">
                                        <label for="relatorio_pdf_update" class="cursor-pointer inline-block bg-gray-800 text-white font-semibold py-2 px-4 rounded-md hover:bg-gray-700 transition-colors">
                                            Escolher Novo Arquivo
                                        </label>
                                        <input type="file" name="relatorio_pdf" id="relatorio_pdf_update" class="hidden" accept=".pdf">
                                        <span id="file-name-update" class="text-gray-500">Nenhum arquivo selecionado</span>
                                    </div>
                                    <div class="mt-4 flex justify-end">
                                        <x-primary-button>Substituir Relatório</x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @else
                        <form action="{{ route('servico.relatorios.store', $servico) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex items-center space-x-4">
                                <label for="relatorio_pdf_store" class="cursor-pointer inline-block bg-gray-800 text-white font-semibold py-2 px-4 rounded-md hover:bg-gray-700 transition-colors">
                                    Escolher Arquivo PDF
                                </label>
                                <input type="file" name="relatorio_pdf" id="relatorio_pdf_store" class="hidden" accept=".pdf">
                                <span id="file-name-store" class="text-gray-500">Nenhum arquivo selecionado</span>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <x-primary-button>Enviar Relatório</x-primary-button>
                            </div>
                        </form>
                    @endif

                </div>
            </div>

            <script>
                function setupFileInput(inputId, displayId) {
                    const fileInput = document.getElementById(inputId);
                    if (fileInput) {
                        fileInput.addEventListener('change', function(event) {
                            const fileNameDisplay = document.getElementById(displayId);
                            if (event.target.files.length > 0) {
                                fileNameDisplay.textContent = event.target.files[0].name;
                            } else {
                                fileNameDisplay.textContent = 'Nenhum arquivo selecionado';
                            }
                        });
                    }
                }

                setupFileInput('relatorio_pdf_store', 'file-name-store');
                setupFileInput('relatorio_pdf_update', 'file-name-update');
            </script>
        </div>
    </div>
</x-app-layout>
