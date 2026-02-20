@php
    $count = $customers->count()
@endphp
<div>
    <div class="flex justify-between items-center">
        <h2 class="text-xl">
            Lista de clientes
        </h2>
        <button wire:click="create" class="flex bg-gray-100 hover:bg-gray-200 transition shadow-md border border-gray-200 cursor-pointer p-2 rounded text-md gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
            <p>
                Adicionar Cliente
            </p>
        </button>
    </div>

    <div class="mt-6 w-full shadow-xl">
        <div class="bg-gray-100 rounded-lg shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-400 flex items-center justify-between">
                <div class="text-sm text-gray-800">Exibindo {{ $count }} {{ $count === 1 ? 'produto' : 'produtos' }}</div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-400">
                    <thead class="bg-gray-200">
                        <tr class="text-sm text-gray-900">
                            <th class="px-2 py-3 text-left">Nome</th>
                            <th class="px-2 py-3 text-left">CPF</th>
                            <th class="px-2 py-3 text-left">Celular</th>
                            <th class="px-2 py-3 text-left">Data de Nascimento</th>
                            <th class="px-2 py-3 text-right">Ações</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-300">
                        @forelse ($customers as $customer)
                        <tr class="hover:bg-gray-200 text-gray-800">
                            <td class="p-2" >{{ $customer->name }}</td>
                            <td class="p-2">{{ $customer->tax_id }}</td>
                            <td class="p-2">{{ $customer->phone}}</td>
                            <td class="p-2">{{ $customer->birth_date}}</td>
                            <td class="p-2 text-right">
                                {{-- TODO adicionar função see() para apenas mostrar os dados por completo sem opção de alterar. --}}
                                <button wire:click="edit({{ $customer->id }})" class="cursor-pointer text-indigo-600 hover:text-indigo-700 p-2 rounded-lg hover:bg-gray-300 transition mr-3">Editar</button>
                                <button wire:click="delete({{ $customer->id }})" class="cursor-pointer text-red-600 hover:text-red-700 p-2 rounded-lg hover:bg-gray-300 transition">Remover</button>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-400">Nenhum cliente     cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 bg-gray-100 border-t border-gray-400">
                {{ $customers->onEachSide(5)->links() }}
            </div>
        </div>
    </div>

    <div class="{{ $showModal ? 'flex' : 'hidden' }} fixed inset-0 z-50 items-center justify-center bg-black/40 backdrop-blur-xs">
        <form
            wire:submit.prevent="save($id)"
            method="POST"
            class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl border border-gray-200"
        >
        @csrf
            <div class="flex items-start justify-between p-6 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-semibold">{{ $isEditing ? 'Editar cliente' : 'Cadastrar cliente' }}</h2>
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
                @if(!$isEditing)
                    <div class="">
                        <label class="block text-gray-700 text-md">Email</label>
                        <input type="text" wire:model="email" placeholder="user@user.com" class="outline-none transition border border-gray-300 focus:ring-2 focus:ring-gray-300 rounded-lg w-full p-2" required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="">
                        <label class="block text-gray-700 text-md">Senha</label>
                        <input type="password" step="0.01" wire:model="password" placeholder="••••••" class="outline-none transition border border-gray-300 focus:ring-2 focus:ring-gray-300 rounded-lg w-full p-2" required>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <div class="">
                    <label class="block text-gray-700 text-md">Nome</label>
                    <input type="text" wire:model="name" placeholder="Nome do cliente" class="border border-gray-300 focus:ring-2 focus:ring-gray-300 outline-none border-gray-300 rounded-lg w-full p-2" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div class="">
                    <label class="block text-gray-700 text-md ">CPF</label>
                    <input type="number" step="0.01" wire:model="tax_id" placeholder="000.000.000-00" class=" outline-none transition border border-gray-300 focus:ring-2 focus:ring-gray-300 rounded-lg w-full p-2" required>
                    @error('tax_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="">
                    <label class="block text-gray-700 text-md ">Data de Nascimento</label>
                    <input wire:model="birth_date" type="date" value="" class="outline-none transition border border-gray-300 focus:ring-2 focus:ring-gray-300 rounded-lg w-full p-2">
                    @error('birth_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="">
                    <label class="block text-gray-700 text-md ">Celular</label>
                    <input type="number" step="0.01" wire:model="phone" placeholder="(00) 00000-0000" class="outline-none transition border border-gray-300 focus:ring-2 focus:ring-gray-300 rounded-lg w-full p-2" required>
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="p-6 border-t border-gray-200 flex justify-end">
                <button
                    type="submit"
                    class="h-11 px-6 rounded-lg bg-blue-600 cursor-pointer hover:bg-blue-700 text-white font-semibold transition"
                >
                    Salvar cliente
                </button>
            </div>
        </form>
    </div>


    <div class="{{ $isDeleting ? 'inline' : 'hidden' }}
                z-50 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
                bg-white border border-gray-700 max-w-lg rounded py-10 px-8"
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

        <p class="text-sm text-gray-800 mb-3">
            Você tem certeza que deseja deletar <strong class="text-black ">{{ $name }}</strong>?
        </p>
            <button type="submit" wire:click="confirmDelete()" class="w-full transition cursor-pointer bg-blue-600 hover:bg-blue-800 text-black  py-2 px-4 rounded">
                Deletar cliente
            </button>

    </div>
</div>
