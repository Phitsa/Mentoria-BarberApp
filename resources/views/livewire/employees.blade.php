@php
    $count = $employees->count()
@endphp
<div>
    <div class="flex justify-between items-center">
        <h2 class="text-xl">
            Lista de Funcionários
        </h2>
        <button wire:click="create" class="flex bg-gray-100 hover:bg-gray-200 transition shadow-md border border-gray-200 cursor-pointer p-2 rounded text-md gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
            <p>
                Adicionar Funcionário
            </p>
        </button>
    </div>

    <div class="mt-6 w-full shadow-xl">
        <div class="bg-gray-100 rounded-lg shadow-sm overflow-hidden ">
            <div class="px-4 py-3 border-b border-gray-400 flex items-center justify-between">
                <div class="text-sm text-gray-800">Exibindo {{ $count }} {{ $count === 1 ? 'funcionário' : 'funcionários' }}</div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-400">
                    <thead class="bg-gray-200">
                        <tr class="text-sm text-gray-900">
                            <th class="px-4 py-3 text-left">Nome</th>
                            <th class="px-4 py-3 text-left">CPF</th>
                            <th class="px-4 py-3 text-left">Celular</th>
                            <th class="px-4 py-3 text-left">Data de Nascimento</th>
                            <th class="px-4 py-3 text-left">Ativo?</th>
                            <th class="px-4 py-3 text-right">Ações</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-300">
                        @forelse ($employees as $employee)
                        <tr class="hover:bg-gray-200 text-gray-800">
                            <td class="p-2" >{{ $employee->name }}</td>
                            <td class="p-2">{{ $employee->tax_id }}</td>
                            <td class="p-2">{{ $employee->phone}}</td>
                            <td class="p-2">{{ $employee->birth_date}}</td>
                            <td class="p-2">{{ $employee->active ? 'Sim' : 'Não' }}</td>
                            <td class="p-2 text-right">
                                {{-- TODO adicionar função see() para apenas mostrar os dados por completo sem opção de alterar. --}}
                                <button wire:click="info({{ $employee->id }})" class="cursor-pointer text-gray-600 hover:text-gray-700 p-2 rounded-lg hover:bg-gray-300 transition mr-3">Visualizar</button>
                                <button wire:click="edit({{ $employee->id }})" class="cursor-pointer text-indigo-600 hover:text-indigo-700 p-2 rounded-lg hover:bg-gray-300 transition mr-3">Editar</button>
                                <button wire:click="delete({{ $employee->id }})" class="cursor-pointer text-red-600 hover:text-red-700 p-2 rounded-lg hover:bg-gray-300 transition">Remover</button>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-400">Nenhum funcionário cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-400">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
    <div class="{{ $showModal ? 'flex' : 'hidden' }} fixed inset-0 z-50 backdrop-blur-xs bg-black/40">
        <form
            wire:submit.prevent="save($id)"
            method="POST"
            class="
                w-full max-w-2xl rounded-xl shadow bg-white shadow-2xl border border-gray-200
                absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
        >
        @csrf
            <div class="flex justify-between gap-10 items-center p-6">
                <div>
                    <h2 class="text-2xl font-semibold">{{ $isEditing ? 'Editar Funcionário' : 'Cadastrar Funcionário' }}</h2>
                    <p class="text-sm text-gray-400">{{ $isEditing ? 'Altere os dados do funcionário' : 'Preencha os dados para cadastrar um novo funcionário' }}</p>
                </div>

                <button
                    type="button"
                    wire:click="closeModal"
                    class="grid place-items-center cursor-pointer h-10 w-10 rounded-lg hover:bg-gray-100 transition"
                >
                    ✕
                </button>

            </div>

            <div class="grid grid-cols-2 gap-2 p-6">
                <div class="flex flex-col">
                    <label for="" class="text-md text-gray-700">Email</label>
                    <input type="email" wire:model="email" class="border p-2 rounded-lg border-gray-300 focus:ring focus:ring-gray-300 outline-none" placeholder="user@email.com">
                </div>
                <div class="flex flex-col">
                    <label for="" class="text-md text-gray-700">Senha</label>
                    <input type="password" wire:model="password" class="border p-2 rounded-lg border-gray-300 focus:ring focus:ring-gray-300 outline-none" placeholder="••••••">
                </div>

                <div class="">
                    <label class="text-md text-gray-700">Nome</label>
                    <input type="text" wire:model="name" placeholder="Seu Nome" class="border focus:ring transition focus:ring-gray-300 outline-none border-gray-300 rounded-lg w-full p-2" required>
                </div>
                <div class="">
                    <label class="text-md text-gray-700">CPF</label>
                    <input type="number" step="0.01" wire:model="tax_id" placeholder="000.000.000-00" class="outline-none focus:ring focus:ring-gray-300 transition border border-gray-300 rounded-lg w-full p-2" required>
                </div>

                <div class="">
                    <label class="text-md text-gray-700">phone</label>
                    <input type="text" step="0.01" wire:model="phone" placeholder="(00) 00000-0000" class="outline-none focus:ring focus:ring-gray-300 transition border border-gray-300 rounded-lg w-full p-2" required>
                </div>
                <div class="">
                    <label class="text-md text-gray-700">Data de Nascimento</label>
                    <input wire:model="birth_date" type="date" value="" class="outline-none focus:ring focus:ring-gray-300 transition border border-gray-300 rounded-lg w-full p-2">
                </div>

                <div>
                    <label class="text-md text-gray-700">Serviços</label>
                    <select
                        name="services[]"
                        multiple
                        wire:model="selectedServices"
                        class="w-full min-h-[120px] rounded-xl border border-gray-300
                            bg-white px-4 py-3 text-sm
                            shadow-sm
                            focus:border-black focus:ring-2 focus:ring-black/20
                            transition-all duration-200
                            scrollbar-thin scrollbar-thumb-gray-300"
                    >
                        @foreach($services as $service)
                            <option
                                value="{{ $service->id }}"
                                class="py-2"
                            >
                                {{ $service->name }} - R$ {{ number_format($service->price, 2, ',', '.') }}
                            </option>
                        @endforeach
                    </select>

                </div>

                <div class="col-span-1 my-1 ">
                    <label class="block text-md text-gray-700">Ativo?</label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input wire:model="active" type="checkbox" value="" class="sr-only peer">
                        <div class="relative w-14 h-8 bg-gray-300 peer-focus:outline-none dark:peer-focus:ring-brand-soft rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-buffer after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-blue-500"></div>
                    </label>
                </div>
            </div>
            <div class="border-t border-gray-300 flex justify-end p-6">
                    <button type="submit" class="border-gray-300  col-span-2 transition cursor-pointer bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                        Salvar Funcionário
                    </button>
                </div>
        </form>
    </div>


    <div class="{{ $isDeleting ? 'inline' : 'hidden' }}
                z-50 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
                bg-gray-800 border border-gray-700 max-w-lg rounded py-10 px-8"
    >
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl mb-1">
                Deletar Produto?
            </h2>
            <button
                type="button"
                wire:click="closeModal()"
                class="cursor-pointer grid place-items-center h-12 w-12 rounded hover:bg-gray-700/50 transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="w-7 h-7" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="m15 9-6 6"/>
                    <path d="m9 9 6 6"/>
                </svg>
            </button>
        </div>

        <p class="text-sm text-gray-300 mb-3">
            Você tem certeza que deseja deletar <strong class="text-black ">{{ $name }}</strong>?
        </p>
            <button type="submit" wire:click="confirmDelete()" class="w-full transition cursor-pointer bg-blue-600 hover:bg-blue-800 text-black text-gray-700 py-2 px-4 rounded">
                Deletar Serviço
            </button>

    </div>

    <div class="{{ $showInfo ? 'flex' : 'hidden' }} fixed inset-0 z-50 backdrop-blur-xs bg-black/40">
        <div class="w-full max-w-2xl bg-white rounded-xl shadow-2xl border border-gray-200
                absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-6"
        >
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-xl text-bold">Serviços do profissional</h3>
                    <p class="text-sm text-gray-500">Adicione ou retire serviços na aba de editar</p>
                </div>

                <button
                    type="button"
                    wire:click="closeModal"
                    class="grid place-items-center cursor-pointer h-10 w-10 rounded-lg hover:bg-gray-100 transition"
                >
                    ✕
                </button>
            </div>
            <div class="rounded-lg shadow-sm mt-2">
                <table class="w-full divide-y divide-gray-400">
                    <thead class="divide-y divide-gray-400 p-2">
                        <tr>
                            <th class="px-4 py-3 text-left">Nome</th>
                            <th class="px-4 py-3 text-left">Price</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        <tr>
                            @foreach ($employee->services as $service)
                                <td>
                                    <th class="p-4">{{ $service->name }}</th>
                                    <td class="p-4">{{ $service->price }}</td>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
                <div class="p-4 border-t border-gray-400"> links...</div>
            </div>

        </div>
    </div>
</div>
