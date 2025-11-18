<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200    leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">




                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{ __("You're logged in!") }}

                    <div class="mt-8 flex flex-wrap gap-4">
                      
                        <a href="{{ route('tasks.create') }}"
                           class="inline-block px-6 py-3 bg-blue-600 text-white font-medium  rounded-lg hover:bg-blue-700 transition">
                             Create Task
                        </a>

                        <a href="{{   route('tasks.index') }}"




                           class="inline-block  px-6 py-3 bg-gray-600 text-white font-medium  rounded-lg hover:bg-gray-700 transition">
                            All Tasks
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>