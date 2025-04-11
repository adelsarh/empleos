<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Planes disponibles') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Encabezado -->
            <div class="text-center mb-12">
                <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Elige el plan perfecto para tu negocio
                </h1>
                <p class="mt-3 text-xl text-gray-500">
                    Publica vacantes según tus necesidades
                </p>
            </div>

            <!-- Tarjetas de Planes -->
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                @foreach($planes as $plan)
                    <div
                        class="relative bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">

                        <div class="p-6">
                            <!-- Nombre del Plan -->
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $plan->nombre }}</h3>

                            <!-- Precio -->
                            <div class="flex items-baseline mb-4">
                                <span
                                    class="text-4xl font-extrabold text-yellow-500">{{ number_format($plan->precio, 0) }} L</span>
                            </div>

                            <!-- Características -->
                            <ul class="space-y-3 mb-6">
                                <li class="flex items-center">
                                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-700">{{ $plan->creditos }} créditos para vacantes</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-700">Créditos sin fecha de expiración</span>
                                </li>
                            </ul>

                            @can('enviar', $plan)
                                <!-- Botón de compra -->
                                @if(!$solicitudPendiente)
                                    <a href="{{ route('plan.show', $plan->id) }}" class="block w-full text-center">
                                        <x-primary-button>
                                            {{ __('Seleccionar Plan') }}
                                        </x-primary-button>
                                    </a>
                                    <!-- Mensaje de solicitud pendiente -->
                                @else($solicitudPendiente)
                                    <div class="mt-4 text-center">
                                        <p class="text-red-500 font-semibold">Solicitud pendiente</p>
                                        <p class="text-sm text-gray-500">Tu solicitud está en proceso de revisión.</p>

                                    </div>
                                @endif
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
