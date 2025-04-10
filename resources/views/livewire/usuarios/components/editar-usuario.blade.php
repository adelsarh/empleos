@push('scripts')
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.4/dist/flowbite.min.css"/>

@endpush

<form action="" class="md:w-1/2 space-y-5" wire:submit.prevent='editarUsuario' novalidate>

    <div>
        <x-input-label for="nombre" :value="__('Nombre del usuario')"/>
        <x-text-input id="nombre"
                      class="block mt-1 w-full"
                      type="text"
                      wire:model.live="nombre"
                      :value="old('nombre')"
                      required
                      autofocus
        />
        <x-input-error :messages="$errors->get('nombre')" class="mt-2"/>
    </div>


    <div>
        <x-input-label for="email" :value="__('Email del usuario')"/>
        <x-text-input id="email"
                      class="block mt-1 w-full"
                      type="email"
                      wire:model.live="email"
                      :value="old('email')"
                      required
                      disabled
                      autofocus
        />
        <x-input-error :messages="$errors->get('empresa')" class="mt-2"/>
    </div>


    <div>
        <x-input-label for="estado" :value="__('Estado')"/>

        <select
            id="estado"
            wire:model="estado"
            class="rounded-md shadow-sm border-gray-300 focus:ring-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 w-full"
        >
            <option value=''>-- Estado --</option>
                <option
                    value="0">Inactivo
                </option>

            <option
                value="1">Activo
            </option>
        </select>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Al seleccionar "Inactivo" el usuario no podra iniciar sesión.</p>

        <x-input-error :messages="$errors->get('imagen_nueva')" class="mt-2"/>
    </div>

    <x-primary-button>
        Guardar cambios
    </x-primary-button>

</form>
