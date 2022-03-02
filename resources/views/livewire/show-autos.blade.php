<div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="my-2 flex flex-row-reverse">
        @livewire('create-auto')
    </div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <x-tabla>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-base text-gray-500 uppercase w-12">Acción
                    </th>
                    <th scope="col" wire:click="ordenar('marca')"
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Detalle <i class="fa-solid fa-sort"></i></th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-base text-gray-500 uppercase w-12">Estado
                    </th>
                    <th scope="col" wire:click="ordenar('kms')"
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Kilometros <i class="fa-solid fa-sort"></i>
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                        colspan='2'>
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($autos as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="vender({{ $item }})"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fa-solid fa-cart-plus"></i> Vender</button>
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
                        <td class="px-6 py-4 whitespace-nowrap cursor-pointer" wire:click="reservar({{$item}})">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($item->reservado==2) bg-red-600 @else bg-green-600 @endif  text-white"> 
                        @if($item->reservado==2) Reservado @else Sin Reserva @endif </span>
                          </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $item->kms }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap w-6">
                            <button wire:click="edit({{ $item }})"
                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fa-solid fa-edit"></i></button>
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
    <!------------------------------------- Modal editar Autos ------------------------------------------------>
    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            Editar Coche
        </x-slot>
        <x-slot name="content">
            @wire
            <x-form-select name="auto.marca" label="Marca">
                @foreach ($marcas as $item)
                    <option>{{ $item }}</option>
                @endforeach

            </x-form-select>

            <x-form-input name='auto.modelo' placeholder="Modelo" label="Modelo" />
            <x-form-input name='auto.kms' type='number' step='1' placeholder="Kilometros" label="Kilometros" />
            <x-form-group label="Reservado" inline>
                <x-form-radio name="auto.reservado" value="1" label="NO" /> &nbsp;
                <x-form-radio name="auto.reservado" value="2" label="SI" />
            </x-form-group>
            <x-form-errors name="auto.reservado" />
            @endwire
            <div class='flex mt-2'>
                <div>
                    <input type="file" class="form-control" name="foto" wire:model="foto" />
                </div>

                <div>
                    @if ($foto)
                        <img src="{{ $foto->temporaryUrl() }}" class="object-cover object-center" />
                    @else
                        <img src="{{ Storage::url($auto->foto) }}" class="object-cover object-center" />
                    @endif
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            <button wire:click="update" wire:loading.attr="disabled"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fa-solid fa-edit"></i> Editar</button>
        </x-slot>
    </x-jet-dialog-modal>
    <!----------------------------------------- Fin Modal ----------------------------------------------------->
</div>
