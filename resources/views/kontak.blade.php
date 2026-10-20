<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hubungi Kami') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-700 space-y-4">
                <h3 class="text-2xl font-bold text-gray-900">Pusat Layanan</h3>
                <p class="leading-relaxed">Jika memiliki kendala teknis terkait penggunaan sistem ini, silakan hubungi tim pengembang:</p>
                <ul class="list-disc list-inside space-y-1 text-gray-600">
                    <li>Email: support@metanouva.co.id</li>
                    <li>Program Internship / PKL PT Metanouva Informatika</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>