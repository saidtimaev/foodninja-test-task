<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Общее количество кликов</p>
            <p class="text-3xl font-bold text-primary-600 mt-1">
                {{ $this->record->visits()->count() }}
            </p>
        </div>
        
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm md:col-span-2">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Куда ведет ссылка</p>
            <p class="text-base font-semibold text-gray-700 dark:text-gray-300 mt-2 truncate">
                {{ $this->record->original_url }}
            </p>
        </div>
    </div>

    <div>
        {{ $this->table }}
    </div>
</x-filament-panels::page>