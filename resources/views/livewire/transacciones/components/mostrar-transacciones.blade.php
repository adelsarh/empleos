<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    @if(session('success'))
        <div class="uppercase border border-green-500 bg-green-100 text-green-600 font-semibold p-2 my-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="p-6">
        <h1 class="text-2xl font-semibold mb-6 text-gray-800">Transacciones</h1>

        <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-100">
            <div>
                <!-- Filtros -->
                <div class="flex space-x-4 m-6">
                    <button
                        wire:click="cambiarFiltro('pendientes')"
                        @class([
                            'px-4 py-2 rounded-lg font-medium',
                            'bg-blue-600 text-white' => $filtro === 'pendientes',
                            'bg-gray-200 text-gray-700 hover:bg-gray-300' => $filtro !== 'pendientes'
                        ])
                    >
                        Pendientes ({{ $contadores['pendientes'] }})
                    </button>

                    <button
                        wire:click="cambiarFiltro('aprobadas')"
                        @class([
                            'px-4 py-2 rounded-lg font-medium',
                            'bg-green-600 text-white' => $filtro === 'aprobadas',
                            'bg-gray-200 text-gray-700 hover:bg-gray-300' => $filtro !== 'aprobadas'
                        ])
                    >
                        Aprobadas ({{ $contadores['aprobadas'] }})
                    </button>
                </div>

                <!-- Tabla (manteniendo tu estructura actual) -->
                <table class="min-w-full divide-y divide-gray-200">
                    <!-- Encabezados... -->

                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Usuario
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Plan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monto
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha
                            aprobación
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Enviado
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($transacciones as $transaccion)
                        <tr wire:key="trans-{{ $transaccion->id }}">
                            <!-- Celdas... -->
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $transaccion->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 capitalize">{{ $transaccion->user->name }}</td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $transaccion->plan->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $transaccion->plan->precio }}</td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($transaccion->estado == 'aprobado')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aprobado</span>
                                @else
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pendiente</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if ($transaccion->fecha_aprobacion)
                                    <span
                                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $transaccion->fecha_aprobacion }}</span>
                                @else
                                    <span
                                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Sin aprobar aún</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $transaccion->created_at->diffForHumans() }}</td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                @if($transaccion->estado == 'pendiente')

                                    <div class="flex items-center space-x-2">
                                        <a href="{{ asset('storage/comprobantes/' . $transaccion->comprobante) }}"
                                           target="_blank"
                                           class="text-blue-600 hover:text-blue-900">
                                            Ver Comprobante
                                        </a>

                                        <button
                                            wire:click="$dispatch('mostrarConfirmacion', {{ $transaccion->id }})"
                                            class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition"
                                        >
                                            Aprobar
                                        </button>

                                    </div>
                                @else

                                    <div class="flex flex-col">
                                        <a href="{{ asset('storage/comprobantes/' . $transaccion->comprobante) }}"
                                           target="_blank"
                                           class="text-blue-600 hover:text-blue-900">
                                            Ver Comprobante
                                        </a>
                                        <span class="text-sm text-gray-500 font-semibold">
                                            Aprobado por: {{ $transaccion->aprobador->name }}
                                         </span>
                                    </div>

                                @endif
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                No hay transacciones disponibles.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $transacciones->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @script
    <script>
        Livewire.on('mostrarConfirmacion', (transaccionId) => {
            Swal.fire({
                title: "¿Está seguro que quieres aprobar esta transacción?",
                text: "Esta acción no se puede revertir",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#22c55e",
                cancelButtonColor: "#b4b4b4",
                confirmButtonText: "Sí, aprobar transacción",
                cancelButtonText: "Cancelar",
                allowOutsideClick: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Disparamos el evento de eliminación
                    Livewire.dispatch('confirmarTransaccion', {transaccion: transaccionId});

                    Swal.fire({
                        title: "¡Aprobada!",
                        text: "La transaccion ha sido comprobada correctamente",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        });


    </script>
    @endscript
@endpush
