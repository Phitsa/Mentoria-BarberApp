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

    <div class="{{ $showCalendar ? 'flex' : 'hidden' }} fixed inset-0 z-50 items-center justify-center bg-black/30 p-4" wire:click.self="closeCalendar">
        <div class="w-full max-w-xl overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-black/5">
            <div class="flex items-center justify-between gap-4 border-b border-gray-200 px-5 py-3">
                <div>
                    <p class="text-xs uppercase tracking-[0.24em] text-gray-500">Disponibilidade</p>
                    <h2 class="text-lg font-semibold text-gray-900">Escolha um dia</h2>
                </div>
                <button
                    type="button"
                    wire:click="closeCalendar"
                    class="rounded-full border border-gray-200 bg-gray-50 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 transition"
                >
                    Fechar
                </button>
            </div>

            <div class="px-5 py-5">
                <div class="flex items-center justify-between gap-2 pb-4">
                    <button
                        type="button"
                        wire:click="previousWeek"
                        class="rounded-full border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition"
                    >
                        ‹
                    </button>
                    <p class="text-sm font-medium text-gray-700">Semana de {{ \Carbon\Carbon::parse($weekDays[0]['date'])->format('d/m') }} a {{ \Carbon\Carbon::parse($weekDays[6]['date'])->format('d/m') }}</p>
                    <button
                        type="button"
                        wire:click="nextWeek"
                        class="rounded-full border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition"
                    >
                        ›
                    </button>
                </div>

                <div class="flex w-full items-center gap-2 overflow-x-auto sm:justify-between sm:overflow-x-visible pb-2 px-2 sm:px-0 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-transparent snap-x snap-mandatory lg:snap-none">
                    @foreach ($weekDays as $day)
                        <button
                            type="button"
                            wire:click="selectDay('{{ $day['date'] }}')"
                            class="flex-shrink-0 snap-center lg:snap-none whitespace-nowrap rounded-full border px-4 py-3 text-left text-xs font-semibold transition
                                {{ $day['isSelected'] ? 'border-blue-600 bg-blue-600 text-white' : 'border-gray-200 bg-white text-gray-700 hover:border-gray-300 hover:bg-gray-50' }}"
                        >
                            <span class="block uppercase tracking-[0.18em] text-[10px]">{{ $day['label'] }}</span>
                            <span class="mt-1 block text-sm font-bold leading-none">{{ $day['day'] }}</span>
                        </button>
                    @endforeach
                </div>

                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Serviço</label>
                        <select class="mt-2 w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
                            <option>Selecione um serviço</option>
                            <option>Corte masculino</option>
                            <option>Barba</option>
                            <option>Corte + barba</option>
                            <option>Coloração</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Cliente</label>
                        <select class="mt-2 w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
                            <option>Selecione um cliente</option>
                            <option>Rafael Silva</option>
                            <option>Mariana Costa</option>
                            <option>Pedro Alves</option>
                            <option>Ana Beatriz</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6 rounded-3xl border border-gray-200 bg-gray-50 p-4">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-xs uppercase tracking-[0.24em] text-gray-500">Horários</p>
                            <p class="text-base font-semibold text-gray-900">{{ \Carbon\Carbon::parse($selectedDate ?? now())->format('d/m/Y') }}</p>
                        </div>
                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800">Mock</span>
                    </div>

                    <div class="mt-4 grid gap-2 sm:grid-cols-2">
                        @if (count($availableSlots))
                            @foreach ($availableSlots as $slot)
                                <button type="button" class="rounded-2xl border border-gray-200 bg-white px-3 py-3 text-left text-sm font-medium text-gray-900 transition hover:border-blue-300 hover:bg-blue-50">
                                    {{ $slot }}
                                </button>
                            @endforeach
                        @else
                            <div class="col-span-full rounded-2xl border border-dashed border-gray-300 bg-white p-4 text-center text-sm text-gray-500">
                                Nenhum horário disponível neste dia.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-5 flex justify-end">
                    <button type="button" class="rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                        Agendar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
