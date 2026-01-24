<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Barbershop Agendor</title>
    @vite('resources/css/app.css')
</head>
<body class="h-screen w-screen bg-white flex items-center justify-center">

    <div class="bg-white border border-gray-300 rounded-2xl p-8 w-[350px] shadow-lg backdrop-blur-md">
        <h1 class="text-3xl font-bold text-center text-black tracking-wide">Login</h1>

        <form action="#" method="POST" class="flex flex-col mt-8 gap-5">
            <!-- Usuário -->
            <div>
                <label for="usuario" class="block text-sm font-medium text-gray-800 mb-2">Usuário</label>
                <input type="text" id="usuario" name="usuario"
                    class="w-full rounded-lg bg-gray-950/50 border border-gray-700 text-white text-sm px-3 py-2.5 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
            </div>

            <!-- Senha -->
            <div>
                <label for="senha" class="block text-sm font-medium text-gray-800 mb-2">Senha</label>
                <input type="password" id="senha" name="senha"
                    class="w-full rounded-lg bg-gray-950/50 border border-gray-700 text-white text-sm px-3 py-2.5 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
            </div>

            <!-- Botão -->
            <a href="{{ route('admin.index') }}"
                class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-center rounded-lg py-2.5 transition shadow-md hover:shadow-blue-500/30">
                Entrar
            </a>
        </form>

        <p class="text-center text-gray-500 text-sm mt-6">
            © {{ date('Y') }} Barbershop Agendor
        </p>
    </div>

</body>
</html>
