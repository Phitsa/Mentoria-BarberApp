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
                    @php
                        $count = isset($availabilities[1]) ? count($availabilities[1]) : 0;
                    @endphp
                    @if ($count > 1)
                        <p class="text-xs text-gray-500 mt-1">{{ $count }} horarios definidos</p>
                    @elseif ($count > 0)
                        <p class="text-xs text-gray-500 mt-1">{{ $count }} horario definido</p>
                    @else
                        <p class="text-xs text-gray-500 mt-1">Fechado</p>
                    @endif
                </div>
                <button wire:click="openEditModal(1)" class="bg-gray-200/50 hover:bg-gray-200 transition cursor-pointer text-gray-700 hover:text-gray-900 font-medium rounded-xl px-3 py-1.5 text-sm">Editar</button>
            </div>
            <div class="mt-4 min-h-11 flex flex-wrap gap-2">
                @php
                    $dayAvailabilities = $availabilities[1] ?? [];
                    $visibleAvailabilities = array_slice($dayAvailabilities, 0, 5);
                    $totalAvailabilities = count($dayAvailabilities);
                @endphp

                @forelse ($visibleAvailabilities as $availability)
                    <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">{{ $availability['time'] }}</span>
                @empty
                    <p class="text-sm text-gray-500">Nenhum horário definido</p>
                @endforelse

                @if ($totalAvailabilities > 5)
                    <p class="text-sm text-gray-500 mt-1">e mais {{ $totalAvailabilities - 5 }} horário(s)</p>
                @endif
            </div>
        </div>

        <div class="shadow-md hover:shadow-lg transition border border-gray-200 rounded-xl p-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-medium">Terça-feira</p>
                    @php
                        $count = isset($availabilities[2]) ? count($availabilities[2]) : 0;
                    @endphp
                    @if ($count > 1)
                        <p class="text-xs text-gray-500 mt-1">{{ $count }} horarios definidos</p>
                    @elseif ($count > 0)
                        <p class="text-xs text-gray-500 mt-1">{{ $count }} horario definido</p>
                    @else
                        <p class="text-xs text-gray-500 mt-1">Fechado</p>
                    @endif
                </div>
                <button wire:click="openEditModal(2)" class="bg-gray-200/50 hover:bg-gray-200 transition cursor-pointer text-gray-700 hover:text-gray-900 font-medium rounded-xl px-3 py-1.5 text-sm">Editar</button>
            </div>
            <div class="mt-4 min-h-11 flex flex-wrap gap-2">
                @php
                    $dayAvailabilities = $availabilities[2] ?? [];
                    $visibleAvailabilities = array_slice($dayAvailabilities, 0, 5);
                    $totalAvailabilities = count($dayAvailabilities);
                @endphp

                @forelse ($visibleAvailabilities as $availability)
                    <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">{{ $availability['time'] }}</span>
                @empty
                    <p class="text-sm text-gray-500">Nenhum horário definido</p>
                @endforelse

                @if ($totalAvailabilities > 5)
                    <p class="text-sm text-gray-500 mt-1">e mais {{ $totalAvailabilities - 5 }} horário(s)</p>
                @endif
            </div>
        </div>

        <div class="shadow-md hover:shadow-lg transition border border-gray-200 rounded-xl p-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-medium">Quarta-feira</p>
                    @php
                        $count = isset($availabilities[3]) ? count($availabilities[3]) : 0;
                    @endphp
                    @if ($count > 1)
                        <p class="text-xs text-gray-500 mt-1">{{ $count }} horarios definidos</p>
                    @elseif ($count > 0)
                        <p class="text-xs text-gray-500 mt-1">{{ $count }} horario definido</p>
                    @else
                        <p class="text-xs text-gray-500 mt-1">Fechado</p>
                    @endif
                </div>
                <button wire:click="openEditModal(3)" class="bg-gray-200/50 hover:bg-gray-200 transition cursor-pointer text-gray-700 hover:text-gray-900 font-medium rounded-xl px-3 py-1.5 text-sm">Editar</button>
            </div>
            <div class="mt-4 min-h-11 flex flex-wrap gap-2">
                @php
                    $dayAvailabilities = $availabilities[3] ?? [];
                    $visibleAvailabilities = array_slice($dayAvailabilities, 0, 5);
                    $totalAvailabilities = count($dayAvailabilities);
                @endphp

                @forelse ($visibleAvailabilities as $availability)
                    <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">{{ $availability['time'] }}</span>
                @empty
                    <p class="text-sm text-gray-500">Nenhum horário definido</p>
                @endforelse

                @if ($totalAvailabilities > 5)
                    <p class="text-sm text-gray-500 mt-1">e mais {{ $totalAvailabilities - 5 }} horário(s)</p>
                @endif
            </div>
        </div>

        <div class="shadow-md hover:shadow-lg transition border border-gray-200 rounded-xl p-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-medium">Quinta-feira</p>
                    @php
                        $count = isset($availabilities[4]) ? count($availabilities[4]) : 0;
                    @endphp
                    @if ($count > 1)
                        <p class="text-xs text-gray-500 mt-1">{{ $count }} horarios definidos</p>
                    @elseif ($count > 0)
                        <p class="text-xs text-gray-500 mt-1">{{ $count }} horario definido</p>
                    @else
                        <p class="text-xs text-gray-500 mt-1">Fechado</p>
                    @endif
                </div>
                <button wire:click="openEditModal(4)" class="bg-gray-200/50 hover:bg-gray-200 transition cursor-pointer text-gray-700 hover:text-gray-900 font-medium rounded-xl px-3 py-1.5 text-sm">Editar</button>
            </div>
            <div class="mt-4 min-h-11 flex flex-wrap gap-2">
                @php
                    $dayAvailabilities = $availabilities[4] ?? [];
                    $visibleAvailabilities = array_slice($dayAvailabilities, 0, 5);
                    $totalAvailabilities = count($dayAvailabilities);
                @endphp

                @forelse ($visibleAvailabilities as $availability)
                    <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">{{ $availability['time'] }}</span>
                @empty
                    <p class="text-sm text-gray-500">Nenhum horário definido</p>
                @endforelse

                @if ($totalAvailabilities > 5)
                    <p class="text-sm text-gray-500 mt-1">e mais {{ $totalAvailabilities - 5 }} horário(s)</p>
                @endif
            </div>
        </div>

        <div class="shadow-md hover:shadow-lg transition border border-gray-200 rounded-xl p-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-medium">Sexta-feira</p>
                    @php
                        $count = isset($availabilities[5]) ? count($availabilities[5]) : 0;
                    @endphp
                    @if ($count > 1)
                        <p class="text-xs text-gray-500 mt-1">{{ $count }} horarios definidos</p>
                    @elseif ($count > 0)
                        <p class="text-xs text-gray-500 mt-1">{{ $count }} horario definido</p>
                    @else
                        <p class="text-xs text-gray-500 mt-1">Fechado</p>
                    @endif
                </div>
                <button wire:click="openEditModal(5)" class="bg-gray-200/50 hover:bg-gray-200 transition cursor-pointer text-gray-700 hover:text-gray-900 font-medium rounded-xl px-3 py-1.5 text-sm">Editar</button>
            </div>
            <div class="mt-4 min-h-11 flex flex-wrap gap-2">
                @php
                    $dayAvailabilities = $availabilities[5] ?? [];
                    $visibleAvailabilities = array_slice($dayAvailabilities, 0, 5);
                    $totalAvailabilities = count($dayAvailabilities);
                @endphp

                @forelse ($visibleAvailabilities as $availability)
                    <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">{{ $availability['time'] }}</span>
                @empty
                    <p class="text-sm text-gray-500">Nenhum horário definido</p>
                @endforelse

                @if ($totalAvailabilities > 5)
                    <p class="text-sm text-gray-500 mt-1">e mais {{ $totalAvailabilities - 5 }} horário(s)</p>
                @endif
            </div>
        </div>

        <div class="shadow-md hover:shadow-lg transition border border-gray-200 rounded-xl p-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-medium">Sabado</p>
                    @php
                        $count = isset($availabilities[6]) ? count($availabilities[6]) : 0;
                    @endphp
                    @if ($count > 1)
                        <p class="text-xs text-gray-500 mt-1">{{ $count }} horarios definidos</p>
                    @elseif ($count > 0)
                        <p class="text-xs text-gray-500 mt-1">{{ $count }} horario definido</p>
                    @else
                        <p class="text-xs text-gray-500 mt-1">Fechado</p>
                    @endif
                </div>
                <button wire:click="openEditModal(6)" class="bg-gray-200/50 hover:bg-gray-200 transition cursor-pointer text-gray-700 hover:text-gray-900 font-medium rounded-xl px-3 py-1.5 text-sm">Editar</button>
            </div>
            <div class="mt-4 min-h-11 flex flex-wrap gap-2">
                @php
                    $dayAvailabilities = $availabilities[6] ?? [];
                    $visibleAvailabilities = array_slice($dayAvailabilities, 0, 5);
                    $totalAvailabilities = count($dayAvailabilities);
                @endphp

                @forelse ($visibleAvailabilities as $availability)
                    <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">{{ $availability['time'] }}</span>
                @empty
                    <p class="text-sm text-gray-500">Nenhum horário definido</p>
                @endforelse

                @if ($totalAvailabilities > 5)
                    <p class="text-sm text-gray-500 mt-1">e mais {{ $totalAvailabilities - 5 }} horário(s)</p>
                @endif
            </div>
        </div>

        <div class="shadow-md hover:shadow-lg transition border border-gray-200 rounded-xl p-4 md:col-span-2 xl:col-span-1">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-medium">Domingo</p>
                    @php
                        $count = isset($availabilities[0]) ? count($availabilities[0]) : 0;
                    @endphp
                    @if ($count > 1)
                        <p class="text-xs text-gray-500 mt-1">{{ $count }} horarios definidos</p>
                    @elseif ($count > 0)
                        <p class="text-xs text-gray-500 mt-1">{{ $count }} horario definido</p>
                    @else
                        <p class="text-xs text-gray-500 mt-1">Fechado</p>
                    @endif

                </div>
                <button wire:click="openEditModal(0)" class="bg-gray-200/50 hover:bg-gray-200 transition cursor-pointer text-gray-700 hover:text-gray-900 font-medium rounded-xl px-3 py-1.5 text-sm">Editar</button>
            </div>
            <div class="mt-4 min-h-11 flex flex-wrap gap-2">
                @php
                    $dayAvailabilities = $availabilities[0] ?? [];
                    $visibleAvailabilities = array_slice($dayAvailabilities, 0, 5);
                    $totalAvailabilities = count($dayAvailabilities);
                @endphp

                @forelse ($visibleAvailabilities as $availability)
                    <span class="rounded-full border border-blue-200 bg-blue-50 text-blue-700 text-xs px-3 py-1">{{ $availability['time'] }}</span>
                @empty
                    <p class="text-sm text-gray-500">Nenhum horário definido</p>
                @endforelse

                @if ($totalAvailabilities > 5)
                    <p class="text-sm text-gray-500 mt-1">e mais {{ $totalAvailabilities - 5 }} horário(s)</p>
                @endif
            </div>
        </div>
    </div>

    <div wire:click.self="closeModal()" class=" {{ $editModal ? 'flex' : 'hidden' }} fixed inset-0 z-50 items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="w-full max-w-3xl rounded-xl bg-white shadow-2xl border border-gray-200 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-semibold">{{ $weekday ? Str::ucfirst($arrayWeekday[$weekday]) : "loading" }}</h2>
                    <p class="text-sm text-gray-500">Disponibilidades</p>
                </div>
                <button wire:click="closeModal" class="grid place-items-center cursor-pointer h-10 w-10 rounded-lg hover:bg-gray-100 transition">✕</button>
            </div>
            <div class="p-6">
                <div class="mb-4 rounded-xl border border-sky-200 bg-sky-50/80 px-4 py-3 text-sky-900">
                    <div class="flex items-center gap-2 tracking-wide text-sky-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 16v-4" />
                            <path d="M12 8h.01" />
                        </svg>
                        <p class="mt-1 text-sm text-sky-800">Passe o mouse sobre um horario para desativar ou excluir.</p>
                    </div>
                </div>
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-2">
                    @foreach (($availabilities[$weekday] ?? []) as $availability)
                        <div class="group relative h-10 overflow-hidden rounded-lg border border-gray-200 bg-white transition {{ $availability['active'] ? 'hover:border-amber-200 hover:bg-amber-50/40' : 'border-gray-300 bg-gray-50' }}">
                            <div class="flex h-full items-center justify-center px-2 transition duration-200 group-hover:-translate-y-10 group-hover:opacity-0">
                                <span class="text-sm {{ $availability['active'] ? 'text-gray-700' : 'text-gray-400 line-through' }}">{{ $availability['time'] }}</span>
                                @if (! $availability['active'])
                                    <span class="ml-2 rounded-full bg-gray-200 px-2 py-0.5 text-[10px] font-semibold uppercase text-gray-600">Inativo</span>
                                @endif
                            </div>

                            <div class="absolute inset-0 flex items-center justify-center gap-1.5 px-1.5 opacity-0 translate-y-10 transition duration-200 group-hover:translate-y-0 group-hover:opacity-100">
                                <button
                                    type="button"
                                    wire:click="toggleActive({{ $availability['id'] }})"
                                    class="h-7 rounded-md px-2 text-xs font-medium text-amber-700 bg-amber-100 hover:bg-amber-200 transition"
                                >
                                    {{ $availability['active'] ? 'Desativar' : 'Ativar' }}
                                </button>
                                <button
                                    type="button"
                                    wire:click="delete({{ $availability['id'] }})"
                                    class="h-7 rounded-md px-2 text-xs font-medium text-red-700 bg-red-100 hover:bg-red-200 transition"
                                >
                                    Excluir
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="border-t border-gray-200 flex justify-end gap-2 p-6">
                <button wire:click='closeModal' class="h-11 px-6 rounded-lg bg-blue-600 cursor-pointer hover:bg-blue-700 text-white font-semibold transition">Fechar</button>
            </div>
        </div>
    </div>

    <div wire:click.self="closeModal()" class="{{ $showModal ? 'flex' : 'hidden' }} fixed inset-0 z-50 items-center justify-center bg-black/40 backdrop-blur-sm"">
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
                        <option value="2">Terça-feira</option>
                        <option value="3">Quarta-feira</option>
                        <option value="4">Quinta-feira</option>
                        <option value="5">Sexta-feira</option>
                        <option value="6">Sabado</option>
                    </select>
                    @error('weekday')
                        <p class="text-red-700 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-md">Horario</label>
                    <input type="time" wire:model="time" name="time" step="1800" value="08:00" class="outline-none transition border border-gray-300 focus:ring-2 focus:ring-gray-300 rounded-lg w-full p-2">
                    @error('time')
                        <p class="text-red-700 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="inline-flex items-center gap-3 rounded-lg border border-gray-200 px-4 py-3 cursor-pointer hover:bg-gray-50 transition">
                        <input type="checkbox" name="active" wire:model="active" checked class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm text-gray-700">Horario ativo</span>
                    </label>
                    @error('active')
                        <p class="text-red-700 text-xs">{{ $message }}</p>
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
