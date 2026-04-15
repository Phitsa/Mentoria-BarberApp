<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barbershop Agendor</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-white text-gray-800 min-h-screen flex overflow-hidden lg:overflow-hidden">
    @php
        $url = url()->current();
        $user = auth()->user();
        $employee = App\Models\Employee::where('user_id', $user->id)->first();
    @endphp

    <div id="mobileOverlay" class="fixed inset-0 z-40 hidden bg-black/40 lg:hidden" onclick="closeMobileMenu()"></div>

    <!-- Desktop Sidebar -->
    <aside class="hidden lg:flex h-screen flex-col bg-gray-100 drop-shadow-lg/25 border-r border-gray-200 w-72">

        <!-- Logo -->
        <div class="flex items-center gap-1 text-2xl font-semibold tracking-wide px-10 py-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500 lucide lucide-scissors-icon lucide-scissors"><circle cx="6" cy="6" r="3"/><path d="M8.12 8.12 12 12"/><path d="M20 4 8.12 15.88"/><circle cx="6" cy="18" r="3"/><path d="M14.8 14.8 20 20"/></svg>
            <span>Employee View</span>
        </div>

        <div class="border-t border-gray-300/40"></div>
        <!-- Menu -->
        <nav class="flex flex-col gap-2 text-sm font-medium px-2 py-4 h-full overflow-y-auto">
            <a href="{{ route('employee.index') }}" class="{{ $url === route('employee.index') ? 'bg-slate-800 text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900'  }} flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house">
                    <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/>
                    <path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('employee.appointments.index') }}" class="{{ $url === route('employee.appointments.index') ? 'bg-slate-800 text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900'  }} flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock-plus-icon lucide-clock-plus"><path d="M12 6v6l3.644 1.822"/><path d="M16 19h6"/><path d="M19 16v6"/><path d="M21.92 13.267a10 10 0 1 0-8.653 8.653"/></svg>
                <span>Appointments</span>
            </a>

            <a href="{{ route('employee.availability.index') }}" class="{{ $url === route('employee.availability.index') ? 'bg-slate-800 text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900'  }} flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock-icon lucide-clock"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <span>Availability</span>
            </a>

            <a href="{{ route('employee.auth.logout') }}" class="flex items-center gap-3 py-2 px-2 rounded-md text-red-400 hover:bg-red-600/20 hover:text-red-400 transition mt-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out">
                    <path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                </svg>
                <span>{{ Str::ucfirst(Str::before($employee->name, ' ')) }}</span>
            </a>
        </nav>
    </aside>

    <!-- Mobile Sidebar -->
    <aside id="mobileSidebar" class="fixed inset-y-0 left-0 z-50 w-72 -translate-x-full transform overflow-y-auto bg-gray-100 p-6 shadow-xl transition duration-300 lg:hidden">
        <div class="flex items-center justify-between pb-4">
            <div class="flex items-center gap-1 text-xl font-semibold tracking-wide">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500 lucide lucide-scissors-icon lucide-scissors"><circle cx="6" cy="6" r="3"/><path d="M8.12 8.12 12 12"/><path d="M20 4 8.12 15.88"/><circle cx="6" cy="18" r="3"/><path d="M14.8 14.8 20 20"/></svg>
                <span>Employee</span>
            </div>
            <button type="button" onclick="closeMobileMenu()" class="rounded-full bg-white p-2 text-gray-600 shadow-sm hover:bg-gray-200">
                ✕
            </button>
        </div>

        <div class="border-t border-gray-300/40"></div>
        <nav class="mt-4 flex flex-col gap-2 text-sm font-medium">
            <a href="{{ route('employee.index') }}" class="{{ $url === route('employee.index') ? 'bg-slate-800 text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900'  }} flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house">
                    <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/>
                    <path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('employee.appointments.index') }}" class="{{ $url === route('employee.appointments.index') ? 'bg-slate-800 text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900'  }} flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock-plus-icon lucide-clock-plus"><path d="M12 6v6l3.644 1.822"/><path d="M16 19h6"/><path d="M19 16v6"/><path d="M21.92 13.267a10 10 0 1 0-8.653 8.653"/></svg>
                <span>Appointments</span>
            </a>

            <a href="{{ route('employee.availability.index') }}" class="{{ $url === route('employee.availability.index') ? 'bg-slate-800 text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900'  }} flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock-icon lucide-clock"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <span>Availability</span>
            </a>

            <a href="{{ route('employee.auth.logout') }}" class="mt-6 flex items-center gap-3 py-2 px-3 rounded-lg text-red-500 hover:bg-red-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out">
                    <path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                </svg>
                <span>{{ Str::ucfirst(Str::before($employee->name, ' ')) }}</span>
            </a>
        </nav>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-4 pt-20 overflow-y-auto lg:p-10 lg:pt-10">
        <div class="mx-auto">
            <div class="flex items-center justify-between gap-4 mb-6 lg:hidden">
                <button type="button" onclick="openMobileMenu()" class="inline-flex items-center gap-2 rounded-full border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    Menu
                </button>
                <div class="flex-grow text-right">
                    <p class="text-sm text-gray-500">Olá, {{ Str::ucfirst(Str::before($employee->name, ' ')) }}</p>
                </div>
            </div>

            <div class="border-b border-gray-300 pb-4">
                <h1 class="text-2xl font-semibold text-black">{{ $title }}</h1>
                <p class="text-sm text-gray-900">{{ $subtitle }}</p>
            </div>
            {{ $slot }}
        </div>
    </main>

    @livewireScripts
    <script>
        function openMobileMenu() {
            document.getElementById('mobileSidebar').classList.remove('-translate-x-full');
            document.getElementById('mobileOverlay').classList.remove('hidden');
        }

        function closeMobileMenu() {
            document.getElementById('mobileSidebar').classList.add('-translate-x-full');
            document.getElementById('mobileOverlay').classList.add('hidden');
        }
    </script>
</body>
</html>
