<div class='p-10'>
    <div class="mb-5 p-4">
        <h3 class="font-bold text-3xl text-gray-800 my-3">
            {{ $vacante->titulo }}
        </h3>

        <div class="gap-4 my-5 md:grid md:grid-cols-2">
            <div class="bg-gray-50 p-4 rounded-lg shadow">
                <p class="font-semibold text-sm uppercase text-gray-800">Empresa:
                    <span class="normal-case font-normal block mt-1"> {{$vacante->empresa}} </span>
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow">
                <p class="font-semibold text-sm uppercase text-gray-800">Último día para postularse:
                    <span class="normal-case font-normal block mt-1"> {{$vacante->ultimo_dia->toFormattedDateString()}} </span>
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow">
                <p class="font-semibold text-sm uppercase text-gray-800">Categoría:
                    <span class="normal-case font-normal block mt-1"> {{$vacante->categoria->categoria}} </span>
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow">
                <p class="font-semibold text-sm uppercase text-gray-800">Salario:
                    <span class="normal-case font-normal block mt-1"> {{$vacante->salario->salario}} </span>
                </p>
            </div>
        </div>
    </div>

    <div class="md:grid md:grid-cols-6 gap-4"> 
        <div class="md:col-span-2">
            <img class="rounded-xl" 
            src='{{ asset('storage/public/vacantes/' . $vacante->imagen)}}' alt="vacante">

        </div>

        <div class="md:col-span-4">
            <h2 class="font-bold text-2xl text-gray-800 my-3">Descripción del puesto</h2>
            <p>{{ $vacante->descripcion}}</p>
        </div>
    </div>

    @guest
        <div class="mt-5 bg-gray-50 border-dashed p-5 text-center">
            <p>¿Te gustaría postularte a esta vacante?
                <a href="{{ route('register') }}" 
                    class="inline-block bg-green-500 text-white py-2 px-4 rounded">
                    Postularme
                </a>
            </p>
        </div>
    @endguest

    @cannot('create', App\Models\Vacante::class)
         <livewire:postular-vacante />   
    @endcannot
</div>
