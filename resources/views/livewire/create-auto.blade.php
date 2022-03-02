<div>
    <button wire:click="$set('isOpen', true)"
        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        <i class="fa-solid fa-car"></i> Nuevo</button>
    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            Datos Coche
        </x-slot>
        <x-slot name="content">
            @wire
            <x-form-select name="marca" label="Marca">
                @foreach ($marcas as $item)
                    <option>{{ $item }}</option>
                @endforeach

            </x-form-select>

            <x-form-input name='modelo' placeholder="Modelo" label="Modelo" />
            <x-form-input name='kms' type='number' step='1' placeholder="Kilometros" label="Kilometros" />
            @endwire
            <div class='flex mt-2'>
                <div>
                    <input type="file" class="form-control" name="foto" wire:model="foto" accept="image/*" />
                    <x-jet-input-error for="foto" class="mt-2" />
                </div>

                <div>
                    @if ($foto)
                        <img src="{{ $foto->temporaryUrl() }}" class="object-cover object-center" />
                    @else
                        <img src="{{ asset('storage/noimage1.jpg') }}" class="object-cover object-center" />
                    @endif
                </div>
            </div>
            

        </x-slot>
        <x-slot name="footer">
            <button wire:click="guardar" wire:loading.attr="disabled"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fa-solid fa-save"></i> Guardar</button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
