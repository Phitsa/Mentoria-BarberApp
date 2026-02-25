@php
    $count = $customers->count()
@endphp
<div class="pt-4">
    <div class="flex flex-row justify-between items-center">
        <h1 class="text-xl">Lista de Clientes</h1>
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
            <span>Cadastrar Cliente</span>
        </button>
    </div>

    <div class="mt-6 w-full shadow-xl">
        <div class="bg-gray-100 rounded-lg shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-400 flex items-center justify-between">
                <div class="text-sm text-gray-800">Exibindo {{ $count }} {{ $count === 1 ? 'cliente' : 'clientes' }}</div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-400">
                    <thead class="bg-gray-200">
                        <tr class="text-sm text-gray-900">
                            <th class="px-2 py-3 text-left">Nome</th>
                            <th class="px-2 py-3 text-left">CPF</th>
                            <th class="px-2 py-3 text-left">Celular</th>
                            <th class="px-2 py-3 text-left">Data de Nascimento</th>
                            <th class="px-2 py-3 pr-4 text-right">Ações</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-300">
                        @forelse ($customers as $cust)
                        <tr class="hover:bg-gray-200 text-gray-800">
                            <td class="p-2">{{ $cust->name }}</td>
                            <td class="p-2">{{ $cust->tax_id }}</td>
                            <td class="p-2">{{ $cust->phone}}</td>
                            <td class="p-2">{{ $cust->birth_date}}</td>
                            <td class="p-2 text-right">
                                {{-- TODO adicionar função see() para apenas mostrar os dados por completo sem opção de alterar. --}}
                                <button wire:click="edit({{ $cust->id }})" class="cursor-pointer text-indigo-600 hover:text-indigo-700 p-2 rounded-lg hover:bg-gray-300 transition mr-3">Editar</button>
                                <button wire:click="delete({{ $cust->id }})" class="cursor-pointer text-red-600 hover:text-red-700 p-2 rounded-lg hover:bg-gray-300 transition">Remover</button>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-400">Nenhum cliente cadastrado.</td>
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
                        Você está prestes a excluir o cliente <strong class="text-gray-900">
                            @if($customer)
                                {{Str::ucfirst($customer->name)}}
                            @endif
                        </strong>.
                    </p>


                    <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg p-4">
                        ⚠️ Esta ação é permanente e não poderá ser desfeita.
                    </div>

                    <ul class="text-sm text-gray-600 list-disc list-inside space-y-1">
                        <li>Você não será capaz de recuperar este cliente.</li>
                        <li>Certifique-se de que deseja excluir este cliente antes de prosseguir.</li>
                    </ul>

                </div>
            <div class="flex justify-end border-t border-gray-300 p-6">
                <button class="mr-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded cursor-pointer" wire:click="closeModal()">Cancelar</button>
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded cursor-pointer" wire:click="deleteCustomer()">Deletar</button>
            </div>
        </div>

        </div>
    </div>
</div>
