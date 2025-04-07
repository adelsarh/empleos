<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    @if(session('success'))
        <div class="uppercase border border-green-500 bg-green-100 text-green-600 font-semibold p-2 my-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @forelse($vacantes as $vacante)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-4">
            <div class="p-6 text-gray-900 md:flex md:justify-between">

                <div class="leading-10">
                    <a href="{{ route('vacantes.show', $vacante->id)}}" class="text-xl font-semibold md:font-bold">
                        {{ $vacante->titulo }}
                    </a>

                    <p class="text-sm text-gray-600 font-bold"> {{ $vacante->empresa }}</p>
                    <p class="text-sm text-gray-500">Último día {{  Illuminate\Support\Carbon::create($vacante->ultimo_dia)->format('d-m-Y') }}</p>
                </div>

                <div class="flex flex-col items-stretch gap-3 mt-5 md:flex-row md:items-center md:mt-0 ">
                    <a href="{{ route('candidatos.index', $vacante->id)}}"
                       class="bg-slate-800 py-2 px-4 rounded-lg text-white text-sm font-bold text-center ">
                       <span class="text-white"> {{ $vacante->candidatos->count() }}</span>
                        Candidatos 
                    </a>

                    <a href="{{ route('vacantes.edit', $vacante->id) }}"
                       class="bg-blue-800 py-2 px-4 rounded-lg text-white text-sm font-bold  text-center">
                        Editar
                    </a>

                    <button wire:click="$dispatch('mostrarConfirmacionEliminar',  {{ $vacante->id }} )"
                       class="bg-red-600 py-2 px-4 rounded-lg text-white text-sm font-bold text-center">
                        Eliminar
                    </button>
                </div>

            </div>
        </div>

    @empty
        <div>
            <p class="p-4 text-center text-sm text-gray-600">No hay vacantes aún. !Crea una nueva!</p>
        </div>

    @endforelse

    <div class="mt-10">
        {{ $vacantes->links() }}
    </div>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@script
    <script>
        Livewire.on('mostrarConfirmacionEliminar', vacanteId => {
                    Swal.fire({
                        title: "¿Está seguro?",
                        text: "Esta acción no se puede revertir",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Sí, eliminar",
                        cancelButtonText: "Cancelar"
                        }).then((result) => {
                        if (result.isConfirmed) {
                            // Eliminar la vacante
                            Livewire.dispatch('eliminarVacante', {vacante: vacanteId})

                            // Mostrar mensaje de éxito
                            Swal.fire({
                                title: "¡Eliminado!",
                                text: "La vacante ha sido eliminada correctamente",
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
