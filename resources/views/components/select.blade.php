<label>
    <span class="sr-only">Make a selection</span>
    <select
        {{ $attributes->merge(['class' => 'block border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600']) }}>
        {{ $slot }}
    </select>
</label>
