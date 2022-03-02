<x-app-layout>
    <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-tabla>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-900 text-white">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        <i class="fa-solid fa-user"></i>&nbsp;Vendedor</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        <i class="fa-solid fa-envelope"></i>&nbsp;email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        <i class="fa-solid fa-cart-shopping"></i>&nbsp;Total Ventas</th>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($totales as $item)
                  <tr @if($loop->index%2==0) class="bg-white" @else class="bg-gray-300" @endif>
                    <td class="px-6 py-4 whitespace-nowrap">
                     {{$item->name}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{$item->email}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{$item->total}}
                    </td>
                   
                  </tr>
                  @endforeach
                  <!-- More people... -->
                </tbody>
              </table>
        </x-tabla>
    </div>
</x-app-layout>