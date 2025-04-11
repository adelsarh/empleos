<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Encabezado con título y detalles principales -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $vacante->titulo }}</h1>
                <p class="text-yellow-600 font-medium mt-1">{{ $vacante->empresa }}</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                {{ $vacante->categoria->categoria }}
            </span>
        </div>

        <!-- Grid de detalles -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <p class="text-xs font-semibold uppercase text-gray-500">Salario</p>
                <p class="text-lg font-medium text-gray-900 mt-1">{{ $vacante->salario->salario }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <p class="text-xs font-semibold uppercase text-gray-500">Ubicación</p>
                <p class="text-lg font-medium text-gray-900 mt-1">{{ $vacante->departamento->nombre }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <p class="text-xs font-semibold uppercase text-gray-500">Cierre</p>
                <p class="text-lg font-medium text-gray-900 mt-1">{{ $vacante->ultimo_dia->toFormattedDateString() }}</p>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Columna izquierda (imagen) -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <img class="w-full h-auto object-cover"
                     src="{{ asset('storage/vacantes/' . $vacante->imagen) }}"
                     alt="{{ $vacante->titulo }}">
            </div>

            <!-- Sección de acción para invitados -->
            @guest
                <div class="mt-6 bg-white rounded-2xl shadow-sm p-6 text-center border border-gray-200">
                    <p class="text-gray-600 mb-4">¿Te interesa esta oportunidad?</p>
                    <a href="{{ route('register') }}">
                        <x-primary-button class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-200">
                            Regístrate para postularte
                        </x-primary-button>
                    </a>

                    <p class="text-sm text-gray-500 mt-4">Ya tienes cuenta? <a href="{{ route('login') }}" class="text-yellow-600 hover:text-yellow-500">Inicia sesión</a></p>


                </div>
            @endguest
        </div>

        <!-- Columna derecha (descripción) -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Descripción del puesto</h2>
                <div class="prose prose-indigo max-w-none text-gray-600">
                    {!! nl2br(e($vacante->descripcion)) !!}
                </div>
            </div>

            <!-- Componente de postulación para autenticados -->
            @auth
                @can('postularse', App\Models\Vacante::class)
                    <div class="mt-6">
                        <livewire:vacantes.components.postular-vacante :vacante="$vacante" />
                    </div>
                @endcan
            @endauth
        </div>
    </div>
</div>
