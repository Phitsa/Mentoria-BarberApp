<div class="h-screen w-screen flex justify-between items-center">
    <div class="flex-3 flex flex-col bg-linear-to-r bg-gray-700 justify-center h-full items-center justify-center">
        <p class="text-2xl text-yellow-300">TODO</p>
    </div>
    <div class="flex-2 flex flex-col h-full items-center justify-between bg-linear-to-r from-blue-500 to-purple-500 text-white">
        <div class="text-center mt-20">
            <h1 class="text-6xl font-semibold mb-2">Login</h1>
            <p class="font-semibold">Bem vindo de volta!</p>
        </div>
        <form
            wire:submit.prevent="login"
            class="w-1/2 flex flex-col gap-2 z-40">
            @csrf
            <div class="flex flex-col">
                <input type="text" placeholder="Email" wire:model='email' class="rounded-xl text-black focus:outline-0 bg-white border border-2 border-white focus:border-white p-2">
            </div>
            @error('email')
                <p class="text-white text-xs">{{ $message }}</p>
            @enderror
            <div class="flex flex-col">
                <input type="password" placeholder="Senha" wire:model='password' class="rounded-xl text-black focus:outline-0 bg-white border border-2 border-white focus:border-white p-2">
            </div>
            @error('password')
                <p class="text-white text-xs">{{ $message }}</p>
            @enderror
            @error('credentials')
                <p class="text-white text-xs">{{ $message }}</p>
            @enderror
            <button type="submit" class="bg-white text-purple-700 py-2 px-8 rounded-xl cursor-pointer hover:bg-purple-700 hover:text-white transition">Entrar</button>
            <a href="/#TODO" class="text-center transition ">Esqueceu sua senha?</a>
        </form>
        <div class="text-center mb-20 z-50">
            <p class="text-sm font-medium">É um administrador?</p>
            <a href="{{ route('admin.auth.login') }}" class="text-sm font-medium text-white underline transition">Faça login aqui</a>
        </div>
    </div>

    <!-- SVGS de background -->
    <div class="absolute bottom-50 right-20 rotate-20">
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-scissors-icon lucide-scissors blur-xs text-white "><circle cx="6" cy="6" r="3"/><path d="M8.12 8.12 12 12"/><path d="M20 4 8.12 15.88"/><circle cx="6" cy="18" r="3"/><path d="M14.8 14.8 20 20"/></svg>
    </div>
    <div class="absolute bottom-20 right-70 rotate-340">
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-icon lucide-package blur-xs text-white"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"/><path d="M12 22V12"/><polyline points="3.29 7 12 12 20.71 7"/><path d="m7.5 4.27 9 5.15"/></svg>
    </div>
    <div class="absolute top-20 right-115 rotate-20">
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-icon lucide-package blur-xs text-white"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"/><path d="M12 22V12"/><polyline points="3.29 7 12 12 20.71 7"/><path d="m7.5 4.27 9 5.15"/></svg>
    </div>
    <div class="absolute top-55 right-150 rotate-340">
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-dollar-sign-icon lucide-circle-dollar-sign blur-xs text-white"><circle cx="12" cy="12" r="10"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 18V6"/></svg>
    </div>
    <div class="absolute bottom-75 right-140 rotate-340 z-10">
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-scissors-icon lucide-scissors blur-xs text-white "><circle cx="6" cy="6" r="3"/><path d="M8.12 8.12 12 12"/><path d="M20 4 8.12 15.88"/><circle cx="6" cy="18" r="3"/><path d="M14.8 14.8 20 20"/></svg>
    </div>
    <div class="absolute top-75 right-25 rotate-20 z-10">
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star blur-xs text-white"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/></svg>
    </div>
</div>
