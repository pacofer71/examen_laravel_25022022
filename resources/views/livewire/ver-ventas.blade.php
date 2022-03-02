<div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <x-jet-input type='search' wire:model="search" class="my-2" placeholder="Buscar vendedor..." />&nbsp;<i
        class="text-white fas fa-search"></i>
    @if ($autos->count())
        <x-tabla>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" wire:click="ordenar('id')"
                            class="px-6 py-3 text-left text-xs font-base text-gray-500 uppercase w-12 whitespace-nowrap">
                            Id <i class="fa-solid fa-sort"></i>
                        </th>
                        <th scope="col" wire:click="ordenar('marca')"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Detalle <i class="fa-solid fa-sort"></i></th>
                        <th scope="col" wire:click="ordenar('user_id')"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Vendedor <i class="fa-solid fa-sort"></i>
                        </th>
                        <th scope="col" wire:click="ordenar('updated_at')"
                            class="whitespace-nowrap cursor-pointer px-6 py-3 text-left text-xs font-base text-gray-500 uppercase w-12">
                            Fecha de Venta <i class="fa-solid fa-sort"></i>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($autos as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $item->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex">
                                        <img class="h-16 w-24 object-cover object-center"
                                            src="{{ Storage::url($item->foto) }}" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->marca }}</div>
                                        <div class="text-sm text-gray-500">{{ $item->modelo }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href=""
                                    class="rounded-full py-2 px-4 italic text-white bg-blue-400 hover:bg-blue-500">
                                    {{ $item->user->email }} </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap italic text-gray-500">
                                {{ $this->formatFecha($item->updated_at) }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap w-6">
                                <button wire:click="borrar({{ $item }})"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    <i class="fa-solid fa-trash"></i></button>
                            </td>

                        </tr>
                    @endforeach
                    <!-- More people... -->
                </tbody>
            </table>
        </x-tabla>
        <div class="mt-2">
            {{ $autos->links() }}
        </div>
    @else
        <div class="mt-2 py-2 px-4 bg-slate-300 text-lg italic rounded-lg shadow-xl">
            No se encontró ningún vendedor.
            
        </div>
    @endif
</div>
