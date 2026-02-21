<div class="pt-4">
    <div class="flex flex-row justify-between items-center">
        <h1 class="text-xl">Lista de Agendamentos</h1>
        <button
            wire:click="create"
            class="inline-flex items-center gap-2 px-4 py-2.5
                bg-white border border-gray-300
                rounded-xl shadow-sm cursor-pointer
                text-sm font-medium text-gray-700
                hover:bg-gray-50 hover:shadow-md
                active:scale-[0.98]
                transition-all duration-200"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <path d="M8 12h8"/>
                <path d="M12 8v8"/>
            </svg>
            <span>Cadastrar Agendamento</span>
        </button>
    </div>
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="shadow-md hover:shadow-lg transition border border-gray-200 rounded-xl p-4">
            <div class="flex justify-between">
                <div>
                    <p class="font-medium">Rafael Silva</p>
                    <p class="text-xs text-gray-500">Cliente</p>
                </div>

                <p class="rounded-3xl bg-green-200/75 hover:bg-green-300/80 hover:text-green-900 transition text-green-700 px-3 py-1 items-center text-xs font-medium w-fit h-fit">Agendado</p>

            </div>
            <div class="text-sm border-b border-gray-100 py-4">
                <p class="font-medium"> <span class="font-normal text-gray-500">Profissional: </span>João Meneses</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 py-4 gap-4">
                <div class="text-sm">
                    <p class="text-gray-500">Data</p>
                    <p class="font-medium">12/01/2025</p>
                </div>
                <div class="text-sm">
                    <p class="text-gray-500">Horário</p>
                    <p class="font-medium">14:30</p>
                </div>
                <div class="text-sm">
                    <p class="text-gray-500">Serviço</p>
                    <p class="font-medium">Corte masculino</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2 text-sm">
                <button class="bg-gray-200/50 hover:bg-gray-200 transition cursor-pointer text-gray-700 hover:text-gray-900 font-medium rounded-xl py-2">
                    Editar
                </button>
                <button class="bg-red-200/40 hover:bg-red-200 transition cursor-pointer text-red-500 hover:text-red-700 font-medium rounded-xl py-2">
                    Cancelar
                </button>
            </div>
        </div>
        
    </div>
