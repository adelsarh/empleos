<div>

    <livewire:vacantes.components.filtrar-vacantes />

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <h3 class="font-extrabold text-4xl text-gray-800 mb-12">Nuestras vacantes disponibles</h3>

            <div class="bg-white shadow-sm rounded-lg p-6">
                @forelse ($vacantes as $vacante)
                    <div class="md:flex md:justify-between md:items-center py-6 bg-white rounded-2xl shadow-md mt-6 hover:shadow-lg transition-shadow p-6 space-y-4 md:space-y-0">
                        <div class="md:flex-1 space-y-2">
                            <a class="text-3xl font-extrabold text-gray-800 hover:text-gray-900 transition-colors" href="{{ route('vacantes.show', $vacante->id) }}">
                                {{ $vacante->titulo }}
                            </a>
                            <p class="text-gray-500 text-base flex items-center gap-2">

                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 32 32"><path fill="#666666" d="M8 8h2v4H8zm0 6h2v4H8zm6-6h2v4h-2zm0 6h2v4h-2zm-6 6h2v4H8zm6 0h2v4h-2z"/><path fill="#666666" d="M30 14a2 2 0 0 0-2-2h-6V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v26h28ZM4 4h16v24H4Zm18 24V14h6v14Z"/></svg>
                                {{ $vacante->empresa }}
                            </p>
                            <p class="font-bold text-sm text-gray-600 flex items-center gap-2">

                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 24 24"><g fill="none" stroke="#ef4444" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M12 6v6h6"/><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2S2 6.477 2 12s4.477 10 10 10"/></g></svg>
                                Último día para postularse:
                                <span class="font-normal text-gray-700">{{ $vacante->ultimo_dia->format('m/d/Y') }}</span>
                            </p>

                            <p class="font-bold text-sm text-gray-600 flex items-center gap-2">

                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 24 24"><path fill="none" stroke="#eab308" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.857 12.506C6.37 10.646 4.596 8.6 3.627 7.45c-.3-.356-.398-.617-.457-1.076c-.202-1.572-.303-2.358.158-2.866S4.604 3 6.234 3h11.532c1.63 0 2.445 0 2.906.507c.461.508.36 1.294.158 2.866c-.06.459-.158.72-.457 1.076c-.97 1.152-2.747 3.202-5.24 5.065a1.05 1.05 0 0 0-.402.747c-.247 2.731-.475 4.227-.617 4.983c-.229 1.222-1.96 1.957-2.888 2.612c-.552.39-1.222-.074-1.293-.678a196 196 0 0 1-.674-6.917a1.05 1.05 0 0 0-.402-.755" color="#eab308"/></svg>

                                Categoría: <span class="font-normal text-gray-700">{{ $vacante->categoria->categoria }}</span>
                            </p>

                            <p class="text-gray-700 flex items-center gap-2 text-lg font-semibold">

                                <svg class="w-5 h-5 xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 256 256"><path fill="#16a34a" d="M128 166a38 38 0 1 0-38-38a38 38 0 0 0 38 38m0-64a26 26 0 1 1-26 26a26 26 0 0 1 26-26m112-44H16a6 6 0 0 0-6 6v128a6 6 0 0 0 6 6h224a6 6 0 0 0 6-6V64a6 6 0 0 0-6-6M22 108.82A54.73 54.73 0 0 0 60.82 70h134.36A54.73 54.73 0 0 0 234 108.82v38.36A54.73 54.73 0 0 0 195.18 186H60.82A54.73 54.73 0 0 0 22 147.18Zm212-12.53A42.8 42.8 0 0 1 207.71 70H234ZM48.29 70A42.8 42.8 0 0 1 22 96.29V70ZM22 159.71A42.8 42.8 0 0 1 48.29 186H22ZM207.71 186A42.8 42.8 0 0 1 234 159.71V186Z"></path></svg>

                                Salario: <span class="text-green-700">{{ $vacante->salario->salario }} / mes</span>
                            </p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <a href="{{ route('vacantes.show', $vacante->id) }}">
                                <x-primary-button>
                                    {{ 'Ver vacante' }}
                                </x-primary-button>

                            </a>
                        </div>
                    </div>
                @empty
                    <p>No hay vacantes</p>
                @endforelse
            </div>
        </div>



    </div>

</div>
