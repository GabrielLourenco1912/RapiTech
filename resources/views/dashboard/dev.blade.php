<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h1 class="text-3xl font-bold text-gray-800 mb-8 px-6 sm:px-0">Bem-Vindo Dev!</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <a href="{{ route('profile.index') }}" class="group block bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                    <div class="h-48 flex items-center justify-center bg-slate-50">
                        <img class="h-46 text-slate-500" src="{{ asset('img/logo_perfil.png') }}" alt="Ilustração de dev">
                    </div>

                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors">
                            Gerenciamento Dev
                        </h2>
                    </div>
                </a>

                <a href="{{ route('notificacao.index') }}" class="group block bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                    <div class="h-48 flex items-center justify-center bg-slate-50">
                        <img class="h-48 text-slate-500" src="{{ asset('img/notificacao.svg') }}" alt="Ilustração de notificações">
                    </div>

                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors">
                            Notificações
                        </h2>
                    </div>
                </a>

                <a href="{{ route('avaliacao.index') }}" class="group block bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                    <div class="h-48 flex items-center justify-center bg-slate-50">
                        <img class="h-48 text-slate-500" src="{{ asset('img/avaliacao.svg') }}" alt="Ilustração de notificações">
                    </div>

                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors">
                            Avaliações
                        </h2>
                    </div>
                </a>

                <a href="{{ route('proposta.index') }}" class="group block bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                    <div class="h-48 flex items-center justify-center bg-slate-50">
                        <img class="h-48 text-slate-500" src="{{ asset('img/proposta.svg') }}" alt="Ilustração de notificações">
                    </div>

                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors">
                            Propostas
                        </h2>
                    </div>
                </a>

                <a href="{{ route('servico.index') }}" class="group block bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                    <div class="h-48 flex items-center justify-center bg-slate-50">
                        <img class="h-48 text-slate-500" src="{{ asset('img/servico.svg') }}" alt="Ilustração de notificações">
                    </div>

                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors">
                            Serviços
                        </h2>
                    </div>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
