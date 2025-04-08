<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Usuarios') }}
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
                    Publica vacantes ilimitadas según tus necesidades
                </p>
            </div>

            <!-- Tarjetas de Planes -->
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($planes as $plan)
                    <div
                        class="relative bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <!-- Etiqueta destacada (opcional) -->
                        @if($plan->recomendado)
                            <div
                                class="absolute top-0 right-0 bg-indigo-500 text-white text-xs font-bold px-3 py-1 transform rotate-12 translate-x-2 -translate-y-2">
                                RECOMENDADO
                            </div>
                        @endif

                        <div class="p-6">
                            <!-- Nombre del Plan -->
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $plan->nombre }}</h3>

                            <!-- Precio -->
                            <div class="flex items-baseline mb-4">
                                <span
                                    class="text-4xl font-extrabold text-indigo-600">${{ number_format($plan->precio, 0) }}</span>
                                <span class="ml-1 text-lg text-gray-500">/mes</span>
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
                                    <span class="text-gray-700">Vigencia: {{ $plan->vigencia_dias }} días</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-700">Soporte prioritario</span>
                                </li>
                            </ul>

                            <!-- Botón de compra -->
                            <a href="{{ route('plan.show', $plan->id) }}"
                               class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg text-center transition duration-200">
                                Seleccionar Plan
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Tabla comparativa (versión detallada) -->
            <div class="mt-16 bg-white shadow-lg rounded-xl overflow-hidden">
                <h2 class="text-2xl font-bold text-gray-900 p-6 border-b">Comparativa de Planes</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Característica
                            </th>
                            @foreach($planes as $plan)
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $plan->nombre }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Créditos</td>
                            @foreach($planes as $plan)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">{{ $plan->creditos }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Precio</td>
                            @foreach($planes as $plan)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                    ${{ number_format($plan->precio, 0) }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Vigencia</td>
                            @foreach($planes as $plan)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">{{ $plan->vigencia_dias }}
                                    días
                                </td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Información adicional -->
            <div class="mt-12 bg-indigo-50 rounded-xl p-6 text-center">
                <h3 class="text-lg font-medium text-indigo-800">¿Necesitas un plan personalizado?</h3>
                <p class="mt-2 text-indigo-600">Contáctanos para crear una solución a tu medida</p>
                <a href="#"
                   class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-100">
                    Contactar a ventas
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
