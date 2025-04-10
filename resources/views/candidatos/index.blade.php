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
                        <ul class="divide-y divide-gray-200 w-full">
                            @forelse($vacante->candidatos as $candidato)
                                <li class="p-4 flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="text-xl font-medium text-gray-800">{{ $candidato->user->name }}</p>
                                        <p class="text-sm font-medium text-gray-600">{{ $candidato->user->email }}</p>
                                        <p class="text-sm font-medium text-gray-600">Día que se postuló: <span
                                                class="font-semibold">{{ $candidato->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>

                                    <div class="flex items-center space-x-3">
                                        <!-- Botón Ver CV -->
                                        <a href="{{ asset('storage/cv/' . $candidato->cv) }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            Ver CV
                                        </a>

                                        <!-- Botón Enviar Email -->
                                        <a href="mailto:{{ $candidato->user->email }}?subject=Vacante {{ $vacante->titulo }}&body=Hola {{ explode(' ', $candidato->user->name)[0] }},"
                                           class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500"
                                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                            Contactar
                                        </a>
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
