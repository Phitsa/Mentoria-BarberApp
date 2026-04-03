<div class="mt-4">
    <div class="flex justify-between items-center">
        <h3 class="text-xl ">
            Proximos atendimentos:
        </h3>

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
            <span>Gerenciar disponibilidade</span>
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
                <p class="font-medium"><span class="font-normal text-gray-500">Serviço: </span>Corte masculino</p>
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
                    <p class="text-gray-500">Duração</p>
                    <p class="font-medium">45 min</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2 text-sm">
                <button class="bg-gray-200/50 hover:bg-gray-200 transition cursor-pointer text-gray-700 hover:text-gray-900 font-medium rounded-xl py-2">
                    Ver detalhes
                </button>
                <button class="bg-red-200/40 hover:bg-red-200 transition cursor-pointer text-red-500 hover:text-red-700 font-medium rounded-xl py-2">
                    Reagendar
                </button>
            </div>
        </div>
    </div>

    <div class="{{ $showModal ? 'flex' : 'hidden' }} fixed inset-0 z-50 items-center justify-center bg-black/40 backdrop-blur-sm" wire:click.self="closeModal()">
        <form wire:submit.prevent="save" method="POST" class="w-full max-w-2xl rounded-xl bg-white shadow-2xl border border-gray-200 max-h-[90vh] overflow-y-auto">
            @csrf
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-semibold">Gerenciar disponibilidade</h2>
                    <p class="text-sm text-gray-400">Informe os dados para definir um novo horario.</p>
                </div>
                <button
                    type="button"
                    wire:click="closeModal"
                    class="grid place-items-center cursor-pointer h-10 w-10 rounded-lg hover:bg-gray-100 transition"
                >
                    ✕
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
                <div>
                    <label class="block text-gray-700 text-md">Cliente</label>
                    <select wire:model="customerId" class="outline-none transition border border-gray-300 focus:ring-2 focus:ring-gray-300 rounded-lg w-full p-2">
                        <option value="">Selecione</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                    @error('customerId')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-md">Data e hora</label>
                    <input type="datetime-local" wire:model="scheduledAt" class="outline-none transition border border-gray-300 focus:ring-2 focus:ring-gray-300 rounded-lg w-full p-2">
                    @error('scheduledAt')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-md">Status</label>
                    <select wire:model="status" class="outline-none transition border border-gray-300 focus:ring-2 focus:ring-gray-300 rounded-lg w-full p-2">
                        <option value="">Selecione</option>
                        <option value="agendado">Agendado</option>
                        <option value="confirmado">Confirmado</option>
                        <option value="cancelado">Cancelado</option>
                        <option value="concluido">Concluido</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="border-t border-gray-200 flex justify-end p-6">
                <button type="submit" class="h-11 px-6 rounded-lg bg-blue-600 cursor-pointer hover:bg-blue-700 text-white font-semibold transition">
                    Salvar
                </button>
            </div>
        </form>
    </div>
</div>
