<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Agendamentos -->
        <div class="rounded-xl border border-gray-200 shadow-md hover:shadow-black/20 p-5 flex flex-col gap-2 transition">
            <div class="flex items-center justify-between">
                <h2 class="text-sm text-gray-400">Agendamentos</h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M8 2v4" />
                    <path d="M16 2v4" />
                    <rect x="3" y="6" width="18" height="16" rx="2" />
                    <path d="M3 10h18" />
                </svg>
            </div>
            <p class="text-2xl font-semibold">1</p>
            <span class="text-xs text-gray-500">+3 desde ontem</span>
        </div>

        <!-- Receita do dia -->
        <div class="rounded-xl border border-gray-200 shadow-md hover:shadow-black/20 p-5 flex flex-col gap-2 transition">
            <div class="flex items-center justify-between">
                <h2 class="text-sm text-gray-400">Receita do dia</h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2" />
                    <path d="M12 3v3m0 12v3" />
                </svg>
            </div>
            <p class="text-2xl font-semibold">R$ 480,00</p>
            <span class="text-xs text-gray-500">+R$ 120 que ontem</span>
        </div>

        <!-- Novos clientes -->
        <div class="rounded-xl border border-gray-200 shadow-md hover:shadow-black/20 p-5 flex flex-col gap-2 transition">
            <div class="flex items-center justify-between">
                <h2 class="text-sm text-gray-400">Novos clientes</h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="7" r="4" />
                    <path d="M6 21v-2a6 6 0 0 1 12 0v2" />
                </svg>
            </div>
            <p class="text-2xl font-semibold">4</p>
            <span class="text-xs text-gray-500">2 retornando</span>
        </div>

        <!-- Serviços realizados -->
        <div class="rounded-xl border border-gray-200 shadow-md hover:shadow-black/20 p-5 flex flex-col gap-2  transition">
            <div class="flex items-center justify-between">
                <h2 class="text-sm text-gray-400">Serviços realizados</h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                </svg>
            </div>
            <p class="text-2xl font-semibold">9</p>
            <span class="text-xs text-gray-500">Barba + Corte dominam o dia</span>
        </div>

    </div>

    <!-- Seção inferior -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Próximo horário -->
        <div class="rounded-xl border border-gray-200 shadow-md hover:shadow-black/20 p-6 flex flex-col justify-between transition">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm text-gray-400">Próximo agendamento</h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M12 8v4l3 3" />
                    <circle cx="12" cy="12" r="10" />
                </svg>
            </div>
            <div>
                <p class="text-lg font-semibold">Corte + Barba</p>
                <p class="text-sm text-gray-400">Cliente: <span class="text-white">João Silva</span></p>
                <p class="text-sm text-gray-400">Horário: <span class="text-white">15:30</span></p>
            </div>
        </div>

        <!-- Ocupação do dia -->
        <div class="rounded-xl border border-gray-200 shadow-md hover:shadow-black/20 p-6  transition">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-sm text-gray-400">Ocupação do dia</h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M12 20v-8m0 0L8 8m4 4l4-4M4 20h16" />
                </svg>
            </div>
            <div class="w-full bg-gray-800 rounded-full h-3">
                <div class="bg-orange-500 h-3 rounded-full" style="width: 75%;"></div>
            </div>
            <p class="text-sm text-gray-400 mt-2">75% dos horários ocupados</p>
        </div>

        <!-- Mini calendário -->
        <div class="rounded-xl border border-gray-200 shadow-md hover:shadow-black/20 p-6 transition">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm text-gray-400">Calendário</h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M8 2v4m8-4v4M3 10h18M4 8h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2z" />
                </svg>
            </div>
            <div class="grid grid-cols-7 gap-1 text-center text-sm">
                @foreach (['S', 'T', 'Q', 'Q', 'S', 'S', 'D'] as $day)
                    <div class="text-gray-400">{{ $day }}</div>
                @endforeach
                @for ($i = 1; $i <= 30; $i++)
                    <div class="p-2 rounded-lg {{ $i == 12 ? 'bg-pink-600 text-white' : 'text-gray-300 hover:bg-gray-800 cursor-pointer' }}">
                        {{ $i }}
                    </div>
                @endfor
            </div>
        </div>

    </div>

</div>
