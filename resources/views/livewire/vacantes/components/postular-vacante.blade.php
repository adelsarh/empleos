@push('scripts')
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.4/dist/flowbite.min.css"/>
@endpush

<div class="max-w-md mx-auto p-8 my-4 bg-white rounded-2xl">
    @if(!$yaAplico)
        <!-- Encabezado con icono -->
        <div class="text-center mb-6">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800">Postularme a esta vacante</h3>
            <p class="mt-2 text-gray-500">Completa los datos para aplicar</p>
        </div>

        <!-- Mensaje de éxito -->
        @if (session()->has('message'))
            <div class="mb-6 p-4 bg-green-50 text-green-600 rounded-lg flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" viewBox="0 0 20 20"
                     fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                          clip-rule="evenodd"/>
                </svg>
                <span>{{ session('message') }}</span>
            </div>
        @endif

        <form wire:submit.prevent="postularse" class="space-y-6">
            <!-- Campo de CV -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Sube tu CV (PDF)</label>

                <div
                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-indigo-400 transition-colors duration-200">
                    <div class="space-y-1 text-center">
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label class="relative cursor-pointer">
                                <span
                                    class="font-medium text-indigo-600 hover:text-indigo-500">Haz clic para subir</span>
                                <input
                                    id="cv"
                                    type="file"
                                    class="sr-only"
                                    wire:model.live="cv"
                                    accept=".pdf"
                                >
                            </label>
                        </div>
                        <p class="text-xs text-gray-500">PDF de máximo 5MB</p>
                    </div>
                </div>

                <!-- Estado de carga del archivo -->
                <div wire:loading wire:target="cv" class="text-sm text-gray-500 flex items-center">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-indigo-500" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Subiendo archivo...
                </div>

                <!-- Nombre del archivo seleccionado -->
                <div wire:model.live="cv" class="text-sm text-indigo-600 truncate">
                    @if($cv)
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            {{ $cv->getClientOriginalName() }}
                        </span>
                    @endif
                </div>

                <x-input-error :messages="$errors->get('cv')" class="mt-1"/>
            </div>

            <!-- Botón de enviar -->
            <div class="pt-2">
                <button
                    type="submit"
                    class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-3xl shadow-sm text-sm font-medium text-white bg-yellow-400 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove wire:target="postularse">
                        Postularme ahora
                    </span>
                    <span wire:loading wire:target="postularse">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Enviando...
                    </span>
                </button>
            </div>
        </form>
    @else
        <div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow-md">
            <!-- Icono de verificación -->
            <div class="flex flex-col items-center justify-center space-y-4">
                <div class="p-4 bg-green-50 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <!-- Texto principal -->
                <h3 class="text-xl md:text-2xl font-semibold text-gray-800 text-center">
                    ¡Ya has aplicado a esta vacante!
                </h3>

                <!-- Detalle -->
                <p class="text-gray-600 text-center max-w-md">
                    Hemos recibido tu aplicación para <span
                        class="font-medium text-indigo-600">{{ $vacante->titulo }}</span>.
                    Revisaremos tu perfil y nos pondremos en contacto contigo si eres seleccionado.
                </p>



            </div>
        </div>
    @endif
</div>
