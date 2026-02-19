<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barbershop Agendor</title>
    @vite('resources/css/app.css')
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
</head>

<body class="bg-white text-gray-800 min-h-screen flex">
    @php
        $url = url()->current();
        $user = auth()->user();
        $admin = App\Models\Admin::where('user_id', $user->id)->first();

    @endphp

    <!-- Sidebar -->
    <aside class="h-screen flex flex-col bg-gray-100 drop-shadow-lg/25 border-r border-gray-200   ">

        <!-- Logo -->
        <div class="flex items-center gap-1 text-2xl font-semibold tracking-wide px-10 py-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500 lucide lucide-scissors-icon lucide-scissors"><circle cx="6" cy="6" r="3"/><path d="M8.12 8.12 12 12"/><path d="M20 4 8.12 15.88"/><circle cx="6" cy="18" r="3"/><path d="M14.8 14.8 20 20"/></svg>
            <span>BarberApp</span>
        </div>

        <div class="border-t border-gray-300/40"></div>
        <!-- Menu -->
        <nav class="flex flex-col gap-2 text-sm font-medium px-2 py-4 h-full">
            <a href="{{ route('admin.index') }}" class="{{ $url === route('admin.index') ? 'bg-slate-800 text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900'  }} flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house">
                    <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/>
                    <path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.customers.index') }}" class=" {{ $url === route('admin.customers.index') ? 'bg-slate-800 text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900'  }} flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-round-icon lucide-users-round"><path d="M18 21a8 8 0 0 0-16 0"/><circle cx="10" cy="8" r="5"/><path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"/></svg>
                <span>Clientes</span>
            </a>

            <a href="{{ route('admin.employees.index') }}" class="{{ $url === route('admin.employees.index') ? 'bg-slate-800 text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900'  }} flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-user-icon lucide-file-user"><path d="M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z"/><path d="M14 2v5a1 1 0 0 0 1 1h5"/><path d="M16 22a4 4 0 0 0-8 0"/><circle cx="12" cy="15" r="3"/></svg>
                <span>Funcionários</span>
            </a>

            <a href="{{ route('admin.services.index') }}" class="{{ $url === route('admin.services.index') ? 'bg-slate-800 text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900'  }} flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-scissors-icon lucide-scissors"><circle cx="6" cy="6" r="3"/><path d="M8.12 8.12 12 12"/><path d="M20 4 8.12 15.88"/><circle cx="6" cy="18" r="3"/><path d="M14.8 14.8 20 20"/></svg>
                <span>Serviços</span>
            </a>

            {{-- Fazer no futuro TODO
            <a href="{{ route('admin.products.index') }}" class=" {{ $url === route('admin.products.index') ? 'bg-slate-800 text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900'  }} flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-basket-icon lucide-shopping-basket"><path d="m15 11-1 9"/><path d="m19 11-4-7"/><path d="M2 11h20"/><path d="m3.5 11 1.6 7.4a2 2 0 0 0 2 1.6h9.8a2 2 0 0 0 2-1.6l1.7-7.4"/><path d="M4.5 15.5h15"/><path d="m5 11 4-7"/><path d="m9 11 1 9"/></svg>
                <span>Produtos</span>
            </a> --}}

            <a href="{{ route('admin.auth.logout') }}" class="flex items-center gap-3 py-2 px-2 rounded-md text-red-400 hover:bg-red-600/20 hover:text-red-400 transition mt-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out">
                    <path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                </svg>
                <span>{{ Str::ucfirst(Str::before($admin->name, ' ')) }}</span>
            </a>
        </nav>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-10">
        <div class="space-y-8">
            <!-- Título -->
            <div>
                <h1 class="text-2xl font-semibold text-black">{{ $title }}</h1>
                <p class="text-sm text-gray-900">{{ $subtitle }}</p>
            </div>
            {{ $slot }}
        </div>
    </main>

    @livewireScripts
</body>
</html>
