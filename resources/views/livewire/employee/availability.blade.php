<div class="mt-4">
    <div class="flex justify-between items-center">
        <h3 class="text-xl">Disponibilidade semanal</h3>
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

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <div class="shadow-md hover:shadow-lg transition border border-gray-200 rounded-xl p-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-medium">Segunda-feira</p>
                    <p class="text-xs text-gray-500 mt-1">4 horario(s) definido(s)</p>
                </div>
                <button class="bg-gray-200/50 hover:bg-gray-200 transition cursor-pointer text-gray-700 hover:text-gray-900 font-medium rounded-xl px-3 py-1.5 text-sm">Editar</button>
            </div>
            <div class="mt-4 min-h-11 flex flex-wrap gap-2">
                <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">18:00</span>
                <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">18:30</span>
                <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">19:00</span>
                <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">19:30</span>
            </div>
        </div>

        <div class="shadow-md hover:shadow-lg transition border border-gray-200 rounded-xl p-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-medium">Terca-feira</p>
                    <p class="text-xs text-gray-500 mt-1">3 horario(s) definido(s)</p>
                </div>
                <button class="bg-gray-200/50 hover:bg-gray-200 transition cursor-pointer text-gray-700 hover:text-gray-900 font-medium rounded-xl px-3 py-1.5 text-sm">Editar</button>
            </div>
            <div class="mt-4 min-h-11 flex flex-wrap gap-2">
                <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">09:00</span>
                <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">10:30</span>
                <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">14:00</span>
            </div>
        </div>

        <div class="shadow-md hover:shadow-lg transition border border-gray-200 rounded-xl p-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-medium">Quarta-feira</p>
                    <p class="text-xs text-gray-500 mt-1">Nenhum horario definido</p>
                </div>
                <button class="bg-gray-200/50 hover:bg-gray-200 transition cursor-pointer text-gray-700 hover:text-gray-900 font-medium rounded-xl px-3 py-1.5 text-sm">Editar</button>
            </div>
            <div class="mt-4 min-h-11 flex flex-wrap gap-2">
                <p class="text-sm text-gray-400">Nenhum horario configurado.</p>
            </div>
        </div>

        <div class="shadow-md hover:shadow-lg transition border border-gray-200 rounded-xl p-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-medium">Quinta-feira</p>
                    <p class="text-xs text-gray-500 mt-1">2 horario(s) definido(s)</p>
                </div>
                <button class="bg-gray-200/50 hover:bg-gray-200 transition cursor-pointer text-gray-700 hover:text-gray-900 font-medium rounded-xl px-3 py-1.5 text-sm">Editar</button>
            </div>
            <div class="mt-4 min-h-11 flex flex-wrap gap-2">
                <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">08:30</span>
                <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">09:00</span>
            </div>
        </div>

        <div class="shadow-md hover:shadow-lg transition border border-gray-200 rounded-xl p-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-medium">Sexta-feira</p>
                    <p class="text-xs text-gray-500 mt-1">3 horario(s) definido(s)</p>
                </div>
                <button class="bg-gray-200/50 hover:bg-gray-200 transition cursor-pointer text-gray-700 hover:text-gray-900 font-medium rounded-xl px-3 py-1.5 text-sm">Editar</button>
            </div>
            <div class="mt-4 min-h-11 flex flex-wrap gap-2">
                <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">15:00</span>
                <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">15:30</span>
                <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">16:00</span>
            </div>
        </div>

        <div class="shadow-md hover:shadow-lg transition border border-gray-200 rounded-xl p-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-medium">Sabado</p>
                    <p class="text-xs text-gray-500 mt-1">1 horario definido</p>
                </div>
                <button class="bg-gray-200/50 hover:bg-gray-200 transition cursor-pointer text-gray-700 hover:text-gray-900 font-medium rounded-xl px-3 py-1.5 text-sm">Editar</button>
            </div>
            <div class="mt-4 min-h-11 flex flex-wrap gap-2">
                <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">10:00</span>
            </div>
        </div>

        <div class="shadow-md hover:shadow-lg transition border border-gray-200 rounded-xl p-4 md:col-span-2 xl:col-span-1">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-medium">Domingo</p>
                    <p class="text-xs text-gray-500 mt-1">Fechado</p>
                </div>
                <button class="bg-gray-200/50 hover:bg-gray-200 transition cursor-pointer text-gray-700 hover:text-gray-900 font-medium rounded-xl px-3 py-1.5 text-sm">Editar</button>
            </div>
            <div class="mt-4 min-h-11 flex flex-wrap gap-2">
                <p class="text-sm text-gray-400">Nenhum horario configurado.</p>
            </div>
        </div>
    </div>

    <div class="hidden fixed inset-0 z-50 items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="w-full max-w-3xl rounded-xl bg-white shadow-2xl border border-gray-200 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-semibold">Editar horario de trabalho</h2>
                    <p class="text-sm text-gray-500">{{ $weekday }}</p>
                </div>
                <button class="grid place-items-center cursor-pointer h-10 w-10 rounded-lg hover:bg-gray-100 transition">✕</button>
            </div>

            <div class="p-6">
                <label class="block text-gray-700 text-md mb-3">Selecione os horarios</label>
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-2">
                    <label class="inline-flex items-center justify-center border border-gray-200 rounded-lg p-2 hover:bg-gray-50 cursor-pointer"><input type="checkbox" class="sr-only"><span class="text-sm text-gray-700">08:00</span></label>
                    <label class="inline-flex items-center justify-center border border-gray-200 rounded-lg p-2 hover:bg-gray-50 cursor-pointer"><input type="checkbox" class="sr-only"><span class="text-sm text-gray-700">08:30</span></label>
                    <label class="inline-flex items-center justify-center border border-gray-200 rounded-lg p-2 hover:bg-gray-50 cursor-pointer"><input type="checkbox" class="sr-only"><span class="text-sm text-gray-700">09:00</span></label>
                    <label class="inline-flex items-center justify-center border border-gray-200 rounded-lg p-2 hover:bg-gray-50 cursor-pointer"><input type="checkbox" class="sr-only"><span class="text-sm text-gray-700">09:30</span></label>
                    <label class="inline-flex items-center justify-center border border-gray-200 rounded-lg p-2 hover:bg-gray-50 cursor-pointer"><input type="checkbox" class="sr-only"><span class="text-sm text-gray-700">10:00</span></label>
                </div>
            </div>

            <div class="border-t border-gray-200 flex justify-end gap-2 p-6">
                <button class="h-11 px-6 rounded-lg bg-gray-200 cursor-pointer hover:bg-gray-300 text-gray-800 font-semibold transition">Cancelar</button>
                <button class="h-11 px-6 rounded-lg bg-blue-600 cursor-pointer hover:bg-blue-700 text-white font-semibold transition">Salvar horarios</button>
            </div>
        </div>
    </div>

    <div class="{{ $showModal ? 'flex' : 'hidden' }} fixed inset-0 z-50 items-center justify-center bg-black/40 backdrop-blur-sm" wire:click.self="closeModal()">
        <form wire:submit.prevent="save" method="POST" class="w-full max-w-2xl rounded-xl bg-white shadow-2xl border border-gray-200 max-h-[90vh] overflow-y-auto">
            @csrf
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <div>
                    <h1 class="text-2xl font-semibold">Adicione novos horários</h1>
                    <p class="text-sm text-gray-400">Gerencie aqui seus horários</p>
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
                    <label class="block text-gray-700 text-md">Dia da semana</label>
                    <select name="weekday" wire:model="weekday" class="outline-none transition border border-gray-300 focus:ring-2 focus:ring-gray-300 rounded-lg w-full p-2">
                        <option value="0">Domingo</option>
                        <option value="1">Segunda-feira</option>
                        <option value="2">Terca-feira</option>
                        <option value="3">Quarta-feira</option>
                        <option value="4">Quinta-feira</option>
                        <option value="5">Sexta-feira</option>
                        <option value="6">Sabado</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 text-md">Horario</label>
                    <input type="time" wire:model="time" name="time" value="08:00" class="outline-none transition border border-gray-300 focus:ring-2 focus:ring-gray-300 rounded-lg w-full p-2">
                </div>

                <div class="md:col-span-2">
                    <label class="inline-flex items-center gap-3 rounded-lg border border-gray-200 px-4 py-3 cursor-pointer hover:bg-gray-50 transition">
                        <input type="checkbox" name="active" wire:model="active" checked class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm text-gray-700">Horario ativo</span>
                    </label>
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
