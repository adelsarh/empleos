<div class="bg-gray-100 py-10">
    <h2 class="text-2xl md:text-4xl text-gray-600 text-center font-extrabold my-5">Buscar y Filtrar Vacantes</h2>

    <div class="max-w-7xl mx-auto">
        <form wire:submit="leerDatosFormulario">
            <div class="md:grid md:grid-cols-3 gap-5">
                <div class="mb-5">
                    <label
                        class="block mb-1 text-sm text-gray-700 uppercase font-bold "
                        for="termino">Término de Búsqueda
                    </label>
                    <input
                        id="termino"
                        type="text"
                        placeholder="Buscar por Término: ej. Vendedor"
                        wire:model="termino"
                        class="rounded-lg shadow-sm border-gray-200 focus:border-yellow-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
                    />
                </div>

                <div class="mb-5">
                    <label class="block mb-1 text-sm text-gray-700 uppercase font-bold">Categoría</label>
                    <select wire:model="categoria" class="border-gray-200 rounded-lg p-2 w-full">
                        <option>--Seleccione--</option>

                        @foreach ($categorias as $categoria )
                            <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-5">
                    <label class="block mb-1 text-sm text-gray-700 uppercase font-bold">Salario Mensual</label>
                    <select wire:model="salario" class="border-gray-200 p-2 w-full rounded-lg">
                        <option>-- Seleccione --</option>
                        @foreach ($salarios as $salario)
                            <option value="{{ $salario->id }}">{{$salario->salario}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <button wire:click="$dispatch('limpiarFiltros');" type="button"
                        class=" hover:bg-red-600 transition-colors font-semibold text-xs text-black underline uppercase tracking-widest px-10 py-2 rounded-3xl cursor-pointer w-full md:w-auto">
                    Limpiar
                </button>

                <input
                    type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 transition-colors font-semibold text-xs text-white uppercase tracking-widest px-10 py-2 rounded-3xl cursor-pointer w-full md:w-auto"
                    value="Buscar"
                />

            </div>
        </form>
    </div>
</div>
