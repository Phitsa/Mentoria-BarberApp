@php
    $count = $services->count();
@endphp
<div>
    {{-- Header? --}}
    <div class="flex flex-row justify-between items-center">
        <h1 class="text-xl">Lista de serviços</h1>
        <button
            wire:click="create"
            class="flex flex-row items-center gap-1 cursor-pointer p-2 rounded bg-gray-100 hover:bg-gray-200 transition shadow-md border border-gray-200"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
            <p class="text-md rounded">Cadastrar serviço</p>
        </button>
    </div>

    {{-- Lista de serviços TABLE--}}
    <div class="mt-6 w-full shadow-xl">
        <div class="bg-gray-100 rounded-lg shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-400 flex items-center justify-between">
                <div class="text-sm text-gray-800">Exibindo {{ $count }} {{ $count === 1 ? 'serviço' : 'serviços' }}</div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-400">
                    <thead class="bg-gray-200">
                        <tr class="text-sm font-medium text-gray-800">
                            <th class="px-2 py-3 text-left">Serviço</th>
                            <th class="px-2 py-3 text-left">Preço</th>
                            <th class="px-2 py-3 text-left">Descrição</th>
                            <th class="px-2 py-3 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-100 divide-y divide-gray-300">
                        @forelse ($services as $service)
                        <tr class="hover:bg-gray-200 text-gray-800">
                            <td class="p-2">{{ $service->name }}</td>
                            <td class="p-2">R$ {{ number_format($service->price, 2, ',', '.') }}</td>
                            <td class="p-2"> {{ Str::words($service->description, 6, '...') }}</td>
                            <td class="p-2 text-right">
                                {{-- TODO adicionar função see() para apenas mostrar os dados por completo sem opção de alterar. --}}
                                <button wire:click="edit({{ $service->id }})" class="cursor-pointer text-indigo-600 hover:text-indigo-700 p-2 rounded-lg hover:bg-gray-300 transition mr-3">Editar</button>
                                <button wire:click="delete({{ $service->id }})" class="cursor-pointer text-red-600 hover:text-red-700 p-2 rounded-lg hover:bg-gray-300 transition">Remover</button>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-400">Nenhum serviço cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-400">
                {{ $services->links() }}
            </div>
        </div>
    </div>

    <div class=" {{ $showModal ? 'flex' : 'hidden' }} z-50 fixed inset-0 items-center justify-center bg-black/40 backdrop-blur-xs">
        <form
            wire:submit.prevent="save"
            method="POST"
            class="{{ $showModal ? 'inline' : 'hidden' }}
                w-full max-w-2xl rounded-xl shadow-2xl bg-white border border-gray-300"
        >
        @csrf
            <div class="flex justify-between gap-10 items-center p-6 border-b border-gray-300">
                <div>
                    <h2 class="text-3xl font-semibold">{{ $isEditing ? 'Editar Serviço' : 'Cadastrar Serviço' }}</h2>
                    <p class="text-sm text-gray-400">{{ $isEditing ? 'Altere os dados do serviço' : 'Preencha os dados para cadastrar um novo serviço' }}</p>
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
                <div class="">
                    <label class="block text-gray-800 text-md">Nome</label>
                    <input type="text" wire:model="name" placeholder="Nome do Serviço" class="border outline-none focus:ring-2 focus:ring-gray-300 border-gray-300 rounded-lg w-full p-2" required>
                </div>

                <div class="">
                    <label class="block text-gray-800 text-md">Preço</label>
                    <input type="number" step="0.01" wire:model="price" placeholder="00,00" class="outline-none focus:ring-2 focus:ring-gray-300 transition border border-gray-300 rounded-lg w-full p-2" required>
                </div>
                <div class="col-span-2 my-1 ">
                    <label class="block text-gray-800 text-md">Descrição</label>
                    <textarea name="" wire:model="description" id="" rows="5" placeholder="Descrição do kit, ou condições da promoção..." class="resize-none outline-none focus:ring-2 focus:ring-gray-300 transition border border-gray-300 rounded-lg w-full p-2"></textarea>
                </div>
            </div>




            <div class="w-full flex p-6 border-t border-gray-300 justify-end">
                <button type="submit" class="transition text-white cursor-pointer bg-blue-600 hover:bg-blue-800 text-gray-800 font-bold py-2 px-4 rounded">
                    Salvar Serviço
                </button>
            </div>

        </form>
    </div>

    {{-- Delete Modal --}}
    <div class="{{ $isDeleting ? 'inline' : 'hidden' }}
                z-50 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
                bg-white border border-gray-300 max-w-lg rounded-xl py-10 px-8"
    >
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl mb-1">
                Deletar Serviço?
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
            Você tem certeza que deseja deletar <strong class="text-red-800 ">{{ $name }}</strong>?
        </p>
            <button type="submit" wire:click="confirmDelete({{ $serviceId }})" class="w-full transition cursor-pointer bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                Deletar Serviço
            </button>

    </div>
</div>
