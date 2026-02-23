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

    <div class="{{ $showModal ? 'flex' : 'hidden' }}
        fixed inset-0 z-50 items-center justify-center bg-black/40 backdrop-blur-xs"
        wire:click.self="closeModal()"
    >
        <form
            wire:submit.prevent="save($id)"
            method="POST"
            class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl border border-gray-200"
        >
        @csrf
            <div class="flex items-start justify-between p-6 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-semibold">{{ $isEditing ? 'Editar Agendamento' : 'Cadastrar Agendamento' }}</h2>
                    <p class="text-sm text-gray-400">{{ $isEditing ? 'Altere os dados do cliente' : 'Preencha os dados para cadastrar um novo cliente' }}</p>
                </div>
                <button
                    type="button"
                    wire:click="closeModal"
                    class="h-10 w-10 grid place-items-center rounded-lg cursor-pointer hover:bg-gray-100 transition"
                >
                    ✕
                </button>

            </div>

            <div class="grid grid-cols-2 gap-4 p-6">
                <div class="">
                    <label class="block text-gray-700 text-md">Cliente</label>
                    <select name="customer" wire:model="customer" class="outline-none transition border border-gray-300 focus:ring-2 focus:ring-gray-300 rounded-lg w-full p-2">
                        <option value="1">Anthony</option>
                        <option value="2">potato</option>
                        <option value="3">xuauau</option>
                        <option value="4">menino</option>
                    </select>
                    @error('customer')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div class="">
                    <label class="block text-gray-700 text-md ">Funcionário</label>
                    <select name="employee" wire:model="employee" class="outline-none transition border border-gray-300 focus:ring-2 focus:ring-gray-300 rounded-lg w-full p-2">
                        <option value="1">Gabriel</option>
                        <option value="2">potato</option>
                        <option value="3">xuauau</option>
                        <option value="4">menino</option>
                    </select>
                    @error('employee')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="">
                    <label class="block text-gray-700 text-md ">Serviço</label>
                    <select name="service" wire:model="service" class="outline-none transition border border-gray-300 focus:ring-2 focus:ring-gray-300 rounded-lg w-full p-2">
                        <option value="1">Cabelo</option>
                        <option value="2">barba</option>
                        <option value="3">xuauau</option>
                        <option value="4">menino</option>
                    </select>
                    @error('service')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="">
                    <label class="block text-gray-700 text-md ">Data e Hora</label>
                    <select name="time" wire:model="time" class="outline-none transition border border-gray-300 focus:ring-2 focus:ring-gray-300 rounded-lg w-full p-2">
                        <option value="1">16:30</option>
                        <option value="2">18:30</option>
                        <option value="3">xuauau</option>
                        <option value="4">menino</option>
                    </select>
                    @error('time')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="p-6 border-t border-gray-200 flex justify-end">
                <button
                    type="submit"
                    class="h-11 px-6 rounded-lg bg-blue-600 cursor-pointer hover:bg-blue-700 text-white font-semibold transition"
                >
                    Salvar agendamento
                </button>
            </div>
        </form>
    </div>


    <div class="{{ $isDeleting ? 'flex' : 'hidden' }}
        fixed inset-0 z-50 items-center justify-center
        bg-black/40 backdrop-blur-sm"
        wire:click.self="closeModal()"
    >
        <div class="
            w-full max-w-2xl rounded-xl bg-white shadow-2xl border border-gray-200
            max-h-[90vh] overflow-y-auto"
        >
        <div class="flex justify-between items-center p-6 border-b border-gray-300">
            <div>
                <h2 class="font-semibold text-xl">
                    Confirmar Exclusão
                </h2>
                <p class="text-sm text-gray-400">
                    Revise as informações antes de continuar.
                </p>
            </div>
            <button
                type="button"
                wire:click="closeModal()"
                class="cursor-pointer grid place-items-center h-12 w-12 rounded hover:bg-gray-700/50 transition"
            >
                ✕
            </button>
        </div>
        <div>
            <div class="p-6 space-y-4">

                    <p class="text-gray-700">
                        Você está prestes a excluir o agendamento de <strong class="text-gray-900">
                            @if($appointment)
                                {{Str::ucfirst($appointment->customer->name)}}
                            @endif
                        </strong>.
                    </p>


                    <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg p-4">
                        ⚠️ Esta ação é permanente e não poderá ser desfeita.
                    </div>

                    <ul class="text-sm text-gray-600 list-disc list-inside space-y-1">
                        <li>Você não será capaz de recuperar este agendamento.</li>
                        <li>Certifique-se de que deseja excluir este agendamento antes de prosseguir.</li>
                    </ul>

                </div>
            <div class="flex justify-end border-t border-gray-300 p-6">
                <button class="mr-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded cursor-pointer" wire:click="closeModal()">Cancelar</button>
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded cursor-pointer" wire:click="deleteAppointment()">Deletar</button>
            </div>
        </div>

        </div>
    </div>
</div>
