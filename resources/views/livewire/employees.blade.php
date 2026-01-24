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
        <div class="bg-gray-100 rounded shadow-sm overflow-hidden mb-2">
            <div class="px-4 py-3 border-b border-gray-300 flex items-center justify-between">
                <div class="text-sm text-gray-800">Exibindo {{ $count }} {{ $count === 1 ? 'produto' : 'produtos' }}</div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-300">
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

                    <tbody class="divide-y divide-gray-700">
                        @forelse ($employees as $employee)
                        <tr class="hover:bg-gray-200 text-gray-800">
                            <td class="px-4 py-4" >{{ $employee->name }}</td>
                            <td class="px-4 py-4">{{ $employee->taxId }}</td>
                            <td class="px-4 py-4">{{ $employee->phone}}</td>
                            <td class="px-4 py-4">{{ $employee->birth_date}}</td>
                            <td class="px-4 py-4">{{ $employee->active}}</td>
                            <td class="px-4 py-4 text-right">
                                {{-- TODO adicionar função see() para apenas mostrar os dados por completo sem opção de alterar. --}}
                                <button wire:click="edit({{ $employee->id }})" class="cursor-pointer text-indigo-600 hover:text-indigo-700 p-2 rounded-lg hover:bg-gray-300 transition mr-3">Editar</button>
                                <button wire:click="delete({{ $employee->id }})" class="cursor-pointer text-red-600 hover:text-red-700 p-2 rounded-lg hover:bg-gray-300 transition">Remover</button>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-400">Nenhum produto cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{ $employees->links() }}
    </div>
    <form
        wire:submit.prevent="save($id)"
        method="POST"
        class="{{ $showModal ? 'inline' : 'hidden' }}
               z-50 w-1/2 max-w-lg rounded-xl shadow bg-white shadow-md py-10 px-8 border border-gray-200
               absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
    >
    @csrf
        <div class="flex justify-between gap-10 items-center mb-8">
            <h2 class="text-3xl font-semibold">{{ $isEditing ? 'Editar Funcionário' : 'Cadastrar Funcionário' }}</h2>

            <button
                type="button"
                wire:click="closeModal"
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

        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label class="block text-black text-md font-bold">Nome</label>
                <input type="text" wire:model="name" placeholder="Cabelo e barba..." class="border hover:border-blue-400/50 outline-none focus:ring-2 focus:ring-blue-400 border-gray-500 rounded w-full p-2" required>
            </div>


            <div class="">
                <label class="block text-black text-md font-bold">CPF</label>
                <input type="number" step="0.01" wire:model="tax_id" placeholder="00000000000" class="hover:border-green-400/50 outline-none focus:ring-2 focus:ring-green-400 transition border border-gray-500 rounded w-full p-2" required>
            </div>

            <div class="">
                <label class="block text-black text-md font-bold">phone</label>
                <input type="number" step="0.01" wire:model="phone" placeholder="00000000000" class="hover:border-green-400/50 outline-none focus:ring-2 focus:ring-green-400 transition border border-gray-500 rounded w-full p-2" required>
            </div>

            <div class="">
                <label class="block text-black text-md font-bold">Data de Nascimento</label>
                <input wire:model="birth_date" type="date" value="" class="hover:border-purple-400/50 outline-none focus:ring-2 focus:ring-purple-400 transition border border-gray-500 rounded w-full p-2">
            </div>

            <div class="col-span-1 my-1 ">
                <label class="block text-black text-md font-bold">Ativo?</label>
                <label class="inline-flex items-center cursor-pointer">
                    <input wire:model="active" type="checkbox" value="" class="sr-only peer">
                    <div class="relative w-14 h-8 bg-gray-300 peer-focus:outline-none dark:peer-focus:ring-brand-soft rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-buffer after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-blue-500"></div>
                </label>
            </div>
            <button type="submit" class="col-span-2 transition cursor-pointer bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                Salvar Produto
            </button>
        </div>
    </form>

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
            <button type="submit" wire:click="confirmDelete()" class="w-full transition cursor-pointer bg-blue-600 hover:bg-blue-800 text-black font-bold py-2 px-4 rounded">
                Deletar Serviço
            </button>

    </div>
</div>
