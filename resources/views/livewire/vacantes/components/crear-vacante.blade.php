@push('scripts')
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.4/dist/flowbite.min.css"/>
@endpush

<form action="" class="md:w-1/2 space-y-5" wire:submit.prevent='crearVacante' novalidate>

    <div>
        <x-input-label for="titulo" :value="__('Titulo Vacante')"/>
        <x-text-input id="titulo"
                      class="block mt-1 w-full"
                      type="text"
                      wire:model.live="titulo"
                      :value="old('titulo')"
                      placeholder="Desarrollador web"
                      required
                      autofocus
        />
        <x-input-error :messages="$errors->get('titulo')" class="mt-2"/>
    </div>

    <div>
        <x-input-label for="salario" :value="__('Salario mensual')"/>
        <select
            id="salario"
            wire:model.live="salario"
            class="rounded-md shadow-sm border-gray-300 focus:ring-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 w-full"
        >
            <option value="">-- Salario --</option>

            @foreach($salarios as $salario)
                <option value=" {{$salario->id }}">{{ $salario->salario }}</option>
            @endforeach

        </select>
        <x-input-error :messages="$errors->get('salario')" class="mt-2"/>
    </div>

    <div>
        <x-input-label for="categoria" :value="__('Categoria')"/>
        <select
            id="categoria"
            wire:model.live="categoria"
            class="rounded-md shadow-sm border-gray-300 focus:ring-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 w-full"
        >
            <option value="">-- Categoría --</option>

            @foreach($categorias as $categoria)
                <option value=" {{$categoria->id }}">{{ $categoria->categoria }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('categoria')" class="mt-2"/>
    </div>

    <div>
        <x-input-label for="empresa" :value="__('Empresa')"/>
        <x-text-input id="empresa"
                      class="block mt-1 w-full"
                      type="text"
                      wire:model.live="empresa"
                      :value="old('empresa')"
                      placeholder="Facebook Inc."
                      required
                      autofocus
        />
        <x-input-error :messages="$errors->get('empresa')" class="mt-2"/>
    </div>

    <div>
        <x-input-label for="ultimo_dia" :value="__('Ultimo dia para postularse')"/>
        <x-text-input id="ultimo_dia"
                      class="block mt-1 w-full"
                      type="date"
                      wire:model.live="ultimo_dia"
                      :value="old('ultimo_dia')"
                      required
                      autofocus
        />
        <x-input-error :messages="$errors->get('ultimo_dia')" class="mt-2"/>
    </div>

    <div>
        <textarea id="descripcion"
                  class="rounded-md shadow-sm border-gray-300 focus:ring-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 w-full h-72"
                  type="text"
                  wire:model.live="descripcion"
                  value="{{ old('descripcion') }}"
                  placeholder="Descripcion de la vacante"
                  required
                  autofocus
        >
        </textarea>
        <x-input-error :messages="$errors->get('descripcion')" class="mt-2"/>
    </div>

    <div>
        <x-input-label for="imagen" :value="__('Imagen')"/>
        <x-text-input id="imagen"
                      class="block mt-1 w-full"
                      type="file"
                      wire:model.live="imagen"
                      required
                      autofocus
                      accept="image/*"
        />

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX.
            800x400px).</p>

        <div class="my-5 w-80">
            @if($imagen)

                <span class="font-semibold text-lg">Previsualización de la imagen </span>

                <img class="rounded-xl mt-5" src="{{ $imagen->temporaryUrl() }}" alt="">

            @endif
        </div>

        <x-input-error :messages="$errors->get('imagen')" class="mt-2"/>
    </div>

    <x-primary-button>
        Crear Vacante
    </x-primary-button>

</form>
