<x-app-layout>
    <div class="pt-4 bg-gray-100">
        <div class="flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-authentication-card-logo />
            </div>

            <div class="w-full sm:max-w-2xl p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                {!! $terms !!}
            </div>
        </div>
    </div>
</x-app-layout>
