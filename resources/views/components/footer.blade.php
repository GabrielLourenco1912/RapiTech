<footer class="bg-black border-t border-gray-800">
    <div class="container mx-auto px-6 py-5 flex justify-between items-center">

        <div>
            <p class="text-base font-semibold">
                <span class="bg-gradient-to-r from-gray-200 to-gray-500 bg-clip-text text-transparent">
                    &copy; {{ date('Y') }} Direitos reservados RapiTech
                </span>
            </p>
        </div>

        <div class="flex items-center space-x-5">
            <a href="https://www.instagram.com/seu-usuario" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition-colors">
                <img src="{{ asset('img/instagram.png') }}" alt="Logo do Instagram" class="w-8 h-8">
            </a>
            <a href="https://www.facebook.com/seu-usuario" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition-colors">
                <img src="{{ asset('img/facebook.png') }}" alt="Logo do Facebook" class="w-8 h-8">
            </a>
        </div>

    </div>
</footer>
