@php use App\Enums\UserRoles;use Illuminate\Support\Facades\Auth; @endphp
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    @if(session('success'))
        <div class="uppercase border border-green-500 bg-green-100 text-green-600 font-semibold p-2 my-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(Auth::user()->rol_id == UserRoles::RECLUTADOR)
        <div
            class="bg-gradient-to-r from-yellow-50 to-yellow-100 border-l-4 border-yellow-400 rounded-lg p-4 shadow-sm w-96">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-yellow-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Créditos disponibles</p>
                        <p class="text-2xl font-bold text-gray-800">
                            {{ auth()->user()->creditos }}

                        </p>
                    </div>
                </div>
                <a href="{{ route('plan.index') }}"
                   class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 transition-colors duration-200">
                    Obtener más
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 -mr-0.5 h-4 w-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </a>
            </div>
            @if(auth()->user()->creditos > 0)
                <div class="mt-2 w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-yellow-500 h-2 rounded-full"
                         style="width: {{ (auth()->user()->creditos / (auth()->user()->creditos + auth()->user()->creditos_usados)) * 100 }}%">
                    </div>
                </div>
            @endif
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
                    <p class="text-sm text-gray-500">Último
                        día {{  Illuminate\Support\Carbon::create($vacante->ultimo_dia)->format('d-m-Y') }}</p>
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
