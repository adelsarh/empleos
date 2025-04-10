<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Componente de filtrado -->
    <livewire:vacantes.components.filtrar-vacantes />

    <!-- Título principal -->
    <div class="text-center mb-12">
        <h2 class="text-4xl font-extrabold text-gray-900 mb-2">Nuestras Vacantes Disponibles</h2>
        <p class="text-lg text-gray-600">Encuentra la oportunidad perfecta para tu carrera profesional</p>
    </div>

    <!-- Grid de 3 columnas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($vacantes as $vacante)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border border-gray-200 flex flex-col h-full">
                <!-- Imagen de la vacante (opcional) -->
                <div class="h-40 bg-gray-100 overflow-hidden">
                    <img class="w-full h-full object-cover"
                         src="{{ asset('storage/vacantes/' . $vacante->imagen) }}"
                         alt="{{ $vacante->titulo }}">
                </div>

                <!-- Contenido -->
                <div class="p-6 flex-grow">
                    <div class="flex justify-between items-start mb-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            {{ $vacante->categoria->categoria }}
                        </span>
                        <span class="text-xs text-gray-500">{{ $vacante->created_at->diffForHumans() }}</span>
                    </div>

                    <a href="{{ route('vacantes.show', $vacante->id) }}" class="block">
                        <h3 class="text-xl font-bold text-gray-900 hover:text-yellow-600 transition-colors mb-2 line-clamp-2">
                            {{ $vacante->titulo }}
                        </h3>
                    </a>

                    <p class="text-gray-600 mb-4 flex items-center">
                        <svg class="w-4 h-4 mr-1 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                        Cierre: {{ $vacante->ultimo_dia->format('d/m/Y') }}
                    </p>

                    <div class="flex items-center text-gray-700 mb-4">
                        <svg class="w-4 h-4 mr-1 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                            <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                        </svg>
                        {{ $vacante->empresa }}
                    </div>

                    <div class="flex items-center text-lg font-semibold text-gray-900 mb-4">
                        <svg class="w-4 h-4 mr-1 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                        </svg>
                        {{ $vacante->salario->salario }}
                    </div>
                </div>

                <!-- Footer de la tarjeta -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    <a href="{{ route('vacantes.show', $vacante->id) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200">
                        Ver detalles
                        <svg class="ml-2 -mr-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No hay vacantes disponibles</h3>
                <p class="mt-1 text-gray-500">Prueba ajustando tus filtros de búsqueda.</p>
            </div>
        @endforelse
    </div>

    <!-- Paginación (si es necesario) -->
    @if($vacantes->hasPages())
        <div class="mt-8">
            {{ $vacantes->links() }}
        </div>
    @endif
</div>
