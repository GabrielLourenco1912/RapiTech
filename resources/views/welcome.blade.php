<x-guest-layout>

    <h1 class="text-center text-4xl font-bold text-gray-800">
        Como deseja entrar?
    </h1>
    <br>
    <h3 class="text-center text-gray-800 mb-16">
        Obs: Se errar o tipo de usuário ao fazer log-in será redirecionado à sua página inicial correspondente.
    </h3>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">

        <a href="{{ route('login_admin') }}" class="group flex flex-col items-center p-8 bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300">
            <div class="relative w-32 h-32 mb-6">
                <img src="{{ asset('img/admin.png') }}" alt="Ícone de Administrador" class="w-full h-full object-cover rounded-2xl transition-all duration-300 group-hover:shadow-2xl group-hover:scale-105">
                <div class="absolute inset-0 rounded-2xl vignette-overlay"></div>
            </div>

            <span class="text-xl font-semibold text-gray-700 transition-colors">
                Administrador
            </span>
        </a>

        <a href="{{ route('login_dev') }}" class="group flex flex-col items-center p-8 bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300">
            <div class="relative w-32 h-32 mb-6">
                <img src="{{ asset('img/dev.png') }}" alt="Ícone de Dev" class="w-full h-full object-cover rounded-2xl transition-all duration-300 group-hover:shadow-2xl group-hover:scale-105">
                <div class="absolute inset-0 rounded-2xl vignette-overlay"></div>
            </div>

            <span class="text-xl font-semibold text-gray-700 transition-colors">
                Dev
            </span>
        </a>

        <a href=" {{ route('login_cliente') }} " class="group flex flex-col items-center p-8 bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300">
            <div class="relative w-32 h-32 mb-6">
                <img src="{{ asset('img/cliente.png') }}" alt="Ícone de Cliente" class="w-full h-full object-cover rounded-2xl transition-all duration-300 group-hover:shadow-2xl group-hover:scale-105">
                <div class="absolute inset-0 rounded-2xl vignette-overlay"></div>
            </div>

            <span class="text-xl font-semibold text-gray-700 transition-colors">
                Cliente
            </span>
        </a>

    </div>
</x-guest-layout>

<style>
    .vignette-overlay {
        background-image: radial-gradient(ellipse at center, transparent 50%, white 95%);
    }
</style>
