<x-app-layout>

    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6 my-10 mb-8">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Confirmar Plan: <span
                    class="text-yellow-600">{{ $plan->nombre }}</span></h2>
            <p class="text-gray-600 mt-2">Precio: <span
                    class="font-semibold">{{ number_format($plan->precio, 2) }} L</span>
            </p>
            <p class="text-gray-600">Créditos: <span class="font-semibold">{{ $plan->creditos }} vacantes</span></p>
        </div>

        <form action="{{ route('plan.store.comprobante', $plan) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Input Referencia Bancaria -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="referencia">
                    Referencia Bancaria (opcional)
                </label>
                <input type="text" name="referencia" id="referencia"
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                       placeholder="Ej: 12345678"
                       value="{{ old('referencia') }}"
                >


                <x-input-error :messages="$errors->get('referencia')" class="mt-2"/>
            </div>

            <!-- Input Comprobante -->

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="comprobante">
                    Subir Comprobante *
                </label>
                <input type="file" name="comprobante" id="comprobante"
                       class="block w-full text-sm text-gray-500
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-lg file:border-0
                          file:text-sm file:font-semibold
                          file:bg-yellow-50 file:text-yellow-700
                          hover:file:bg-yellow-100">
                <p class="mt-1 text-xs text-gray-500">Formatos: PDF, JPG, PNG (Máx. 2MB)</p>

                <x-input-error :messages="$errors->get('comprobante')" class="mt-2"/>
            </div>

            <!-- Botones -->
            <div class="flex justify-between items-center">
                <a href="{{ route('plan.index') }}"
                   class="text-gray-600 hover:text-gray-800 font-medium">
                    ← Volver a planes
                </a>

                @can('enviar', $plan)
                    <x-primary-button class="font-bold">
                        {{ __('Enviar Comprobante') }}
                    </x-primary-button>
                @endcan
            </div>
        </form>
    </div>

</x-app-layout>
