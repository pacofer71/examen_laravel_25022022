<x-guest-layout>
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="py-2 px-4 bg-orange-200 rounded text-sm text-gray-400 dark:text-gray-500 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}"
                    class="py-2 px-4 bg-orange-200 rounded text-sm text-gray-400 dark:text-gray-500 underline">Log
                    in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="py-2 px-4 bg-orange-200 rounded ml-4 text-sm text-gray-700 dark:text-gray-00 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 ">
            @foreach ($autos as $item)
                <article
                    class="border-4 border-gray-700 hover:border-indigo-200/100   w-full h-80  bg-center bg-cover @if ($loop->first) lg:col-span-2 @endif"
                    style="background-image:url({{ Storage::url($item->foto) }}) ">
                    <div class="flex flex-col justify-center w-full h-full">
                        <div class="font-bold text-gray-700 ml-2 mb-2 text-xl">
                            {{ $item->marca }} {{ $item->modelo }}
                        </div>
                        <div class="ml-2 italic text-red-900 font-bold text-lg">
                            Kilómetros: ({{ $item->kms }})
                        </div>
                        <div class="items-center ml-2 mt-20">
                            <form action="{{ route('autos.reserva', $item) }}" method="POST" name="a">
                                @csrf
                                @method('put')
                                @if ($item->reservado == 1)
                                
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        <i class="fa-solid fa-cart-shopping"></i> Reservar
                                    </button>
                                @else
                            
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        <i class="fa-solid fa-circle-info"></i> Quitar Reserva
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>

                </article>
            @endforeach
        </div>
        <div class="mt-2">
            {{ $autos->links() }}
        </div>
    </div>
    @if(session('info'))
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Información',
            text: "{{ session('info') }}",

        })
    </script>
    @endif

</x-guest-layout>
