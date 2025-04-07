<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Candidatos de la vacante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h1 class="text-2xl text-center mb-10">
                        Candidatos de la vacante <span class="font-semibold">{{ $vacante->titulo}}</span>
                    </h1>

                    <div class="md:flex md:justify-center p-5">
                        <ul class = "divide-y divide-gray-200 w-full">
                            @forelse($vacante->candidatos as $candidato)
                                <li class="p-4 flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="text-xl font-medium text-gray-800">{{ $candidato->user->name }}</p>
                                        <p class="text-sm font-medium text-gray-600">{{ $candidato->user->email }}</p>
                                        <p class="text-sm font-medium text-gray-600">Día que se postuló: <span class="font-semibold">{{ $candidato->created_at->diffForHumans() }}</span></p>
                                    </div>

                                    <div>
                                        <a href="{{ asset('storage/cv/' . $candidato->cv)}}" 
                                            target="__blank"
                                            rel="noopener noreferrer" 
                                         class="inline-flex items-center shadow-sm px-2.5 py-0.5 border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50">Ver</a>
                                    </div>

                                </li>
                            @empty
                                <li class="p-4 text-center text-sm text-gray-600">No hay candidatos</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
