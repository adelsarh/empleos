<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    @if(session('success'))
        <div class="uppercase border border-green-500 bg-green-100 text-green-600 font-semibold p-2 my-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

        <div class="p-6">
            <h1 class="text-2xl font-semibold mb-6 text-gray-800">Usuarios</h1>

            <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo usuario</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registrado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Verificado</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($usuarios as $usuario)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $usuario->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 capitalize">{{ $usuario->roles->nombre }}</td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $usuario->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $usuario->created_at->diffForHumans() }}</td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($usuario->estado == 1)
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Activo</span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactivo</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if ($usuario->email_verified_at)
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Sí</span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">No</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('user.edit', $usuario->id) }}" class="px-3 py-1.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition duration-200 shadow-sm">Editar</a>
                                    <button wire:click="$dispatch('mostrarConfirmacionEliminar', {{ $usuario->id }})" class="px-3 py-1.5 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition duration-200 shadow-sm">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">

            </div>
        </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @script
    <script>
        // Listener persistente para la confirmación de eliminación
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('mostrarConfirmacionEliminar', (userId) => {
                Swal.fire({
                    title: "¿Está seguro?",
                    text: "Esta acción no se puede revertir",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar",
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Disparamos el evento de eliminación
                        Livewire.dispatch('eliminarUsuario', { user: userId });
                    }
                });
            });

            // Listener para mostrar confirmación de eliminación exitosa
            Livewire.on('usuarioEliminado', () => {
                Swal.fire({
                    title: "¡Eliminado!",
                    text: "El usuario ha sido eliminado correctamente",
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        });
    </script>
    @endscript
@endpush
