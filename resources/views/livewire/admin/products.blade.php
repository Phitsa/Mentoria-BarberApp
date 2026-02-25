@php
    $count = $products->count()
@endphp
<div>
    <div class="flex justify-between items-center">
        <h2 class="text-xl">
            Lista de produtos
        </h2>
        <button wire:click="create" class="flex bg-gray-100 border border-gray-200 shadow-md hover:bg-gray-200 cursor-pointer p-2 rounded text-md gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
            <p>
                Cadastrar produto
            </p>
        </button>
    </div>

    <div class="mt-6 w-full shadow-lg">
        <div class="bg-gray-100 rounded shadow-sm overflow-hidden mb-2">
            <div class="px-4 py-3 border-b border-gray-300 flex items-center justify-between">
                <div class="text-sm text-gray-800">Exibindo {{ $count }} {{ $count === 1 ? 'produto' : 'produtos' }}</div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-200">
                        <tr class="text-sm font-medium text-gray-800">
                            <th class="px-4 py-3 text-left">Produto</th>
                            <th class="px-4 py-3 text-left">Preço</th>
                            <th class="px-4 py-3 text-left">Em Stock</th>
                            <th class="px-4 py-3 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-100 divide-y divide-gray-300">
                        @forelse ($products as $product)
                        <tr class="hover:bg-gray-200 text-gray-800">
                            <td class="px-4 py-4">{{ $product->name }}</td>
                            <td class="px-4 py-4">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                            <td class="px-4 py-4"> {{ $product->hasStock ? $product->amount : 'N/A' }}</td>
                            <td class="px-4 py-4 text-right">
                                {{-- TODO adicionar função see() para apenas mostrar os dados por completo sem opção de alterar. --}}
                                <button wire:click="edit({{ $product->id }})" class="cursor-pointer text-indigo-600 hover:text-indigo-700 p-2 rounded-lg hover:bg-gray-300 transition mr-3">Editar</button>
                                <button wire:click="delete({{ $product->id }})" class="cursor-pointer text-red-600 hover:text-red-700 p-2 rounded-lg hover:bg-gray-300 transition">Remover</button>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-400">Nenhum produto cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{ $products->links() }}
    </div>
    <form
        wire:submit.prevent="save"
        method="POST"
        class="{{ $showModal ? 'inline' : 'hidden' }}
               z-50 w-1/2 max-w-lg rounded shadow bg-gray-800 py-10 px-8 border border-gray-700
               absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
    >
    @csrf
        <div class="flex justify-between gap-10 items-center mb-8">
            <h2 class="text-3xl font-semibold">{{ $isEditing ? 'Editar Produto' : 'Cadastrar Produto' }}</h2>

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
                <label class="block text-white text-md font-bold">Nome</label>
                <input type="text" wire:model="name" placeholder="Cabelo e barba..." class="border hover:border-blue-400/50 outline-none focus:ring-2 focus:ring-blue-400 border-gray-500 rounded w-full p-2" required>
            </div>

            <div class="">
                <label class="block text-white text-md font-bold">Preço</label>
                <input type="number" step="0.01" wire:model="price" placeholder="90,00" class="hover:border-green-400/50 outline-none focus:ring-2 focus:ring-green-400 transition border border-gray-500 rounded w-full p-2" required>
            </div>

            <div class="col-span-1 my-1 ">
                <label class="block text-white text-md font-bold">Acompanhar Stock?</label>
                <label class="inline-flex items-center cursor-pointer">
                    <input wire:model="hasStock" type="checkbox" value="" class="sr-only peer">
                    <div class="relative w-9 h-5 bg-neutral-quaternary peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-soft dark:peer-focus:ring-brand-soft rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-buffer after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-brand"></div>
                </label>
            </div>

            <div>
                <label class="block text-white text-md font-bold">Quantidade</label>
                <input type="number" step="0.01" wire:model="amount" placeholder="15" class="hover:border-green-400/50 outline-none focus:ring-2 focus:ring-green-400 transition border border-gray-500 rounded w-full p-2" required>
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
            Você tem certeza que deseja deletar <strong class="text-white ">{{ $name }}</strong>?
        </p>
            <button type="submit" wire:click="confirmDelete()" class="w-full transition cursor-pointer bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                Deletar Serviço
            </button>

    </div>
</div>
