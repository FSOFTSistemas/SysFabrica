<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fábrica de Rações</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animação de transição suave */
        .transition-transform {
            transition: transform 0.3s;
        }

        .transition-transform:hover {
            transform: scale(1.05);
        }

        /* Fundo do header com opacidade */
        .header-overlay {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">
    <!-- Hero Section -->
    <header class="relative bg-cover bg-center h-screen text-white" style="background-image: url('{{ asset('images/fab1.jpg') }}');">
        <div class="header-overlay h-full w-full flex flex-col justify-center items-center">
            <h1 class="text-4xl sm:text-6xl font-bold uppercase text-center">Bem-vindo à Fábrica de Rações</h1>
            <p class="mt-4 text-center text-lg sm:text-2xl">Qualidade e nutrição que seus animais merecem.</p>
            <div class="mt-6 flex space-x-4">
                <a href="{{ route('login') }}" class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md shadow-lg transition">
                    Login
                </a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md shadow-lg transition">
                    Registrar-se
                </a>
                @endif
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800">Sobre Nós</h2>
            <p class="mt-4 text-center text-lg text-gray-600">Somos líderes na produção de rações de alta qualidade para animais, com compromisso com o bem-estar e nutrição saudável.</p>
            <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg transition-transform hover:shadow-xl">
                    <img src="{{ asset('images/fab1.jpg') }}" alt="Ração para Cães" class="w-full rounded-lg mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Ração para Cães</h3>
                    <p class="mt-2 text-gray-600">Formulada especialmente para saúde e energia dos cães.</p>
                </div>
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg transition-transform hover:shadow-xl">
                    <img src="{{ asset('images/fab2.jpg') }}" alt="Ração para Gatos" class="w-full rounded-lg mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Ração para Gatos</h3>
                    <p class="mt-2 text-gray-600">Sabor e nutrientes na medida para o bem-estar dos gatos.</p>
                </div>
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg transition-transform hover:shadow-xl">
                    <img src="{{ asset('images/fab3.jpg') }}" alt="Ração para Aves" class="w-full rounded-lg mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Ração para Aves</h3>
                    <p class="mt-2 text-gray-600">Ideal para aves de pequeno e médio porte, garantindo saúde e produtividade.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16 bg-gray-800 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold">Entre em Contato</h2>
            <p class="mt-4 text-lg">Ficaremos felizes em ajudá-lo. Entre em contato para mais informações.</p>
            <form class="mt-10 max-w-xl mx-auto">
                <div class="grid grid-cols-1 gap-6">
                    <input type="text" placeholder="Seu Nome" class="px-4 py-3 rounded-lg shadow-lg text-gray-800 focus:outline-none">
                    <input type="email" placeholder="Seu Email" class="px-4 py-3 rounded-lg shadow-lg text-gray-800 focus:outline-none">
                    <textarea placeholder="Sua Mensagem" rows="4" class="px-4 py-3 rounded-lg shadow-lg text-gray-800 focus:outline-none"></textarea>
                    <button type="submit" class="w-full px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-md shadow-lg transition">
                        Enviar Mensagem
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Fábrica de Rações. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>

</html>