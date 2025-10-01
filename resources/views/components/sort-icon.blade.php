@props(['field', 'sortField', 'sortDirection'])

@if ($sortField === $field)
    @if ($sortDirection === 'asc')
        <svg class="inline w-3 h-3 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path d="M8.574 14.828a.75.75 0 0 1 0 1.06l-2.5 2.5a.75.75 0 0 1-1.06 0l-2.5-2.5a.75.75 0 1 1 1.06-1.06L6 17.219V4.75a.75.75 0 0 1 1.5 0v12.47l1.946-1.947a.75.75 0 0 1 1.06 0Z"/>
            <path d="M15.426 9.172a.75.75 0 0 1 0-1.06l2.5-2.5a.75.75 0 0 1 1.06 0l2.5 2.5a.75.75 0 1 1-1.06 1.06L18 6.781V19.25a.75.75 0 0 1-1.5 0V6.781l-1.946 1.947a.75.75 0 0 1-1.06 0Z"/>
        </svg>
    @else
        <svg class="inline w-3 h-3 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path d="M8.574 9.172a.75.75 0 0 0 0 1.06l2.5 2.5a.75.75 0 1 0 1.06-1.06L10.189 9.726l1.946-1.947a.75.75 0 1 0-1.06-1.06l-2.5 2.5a.75.75 0 0 0 0 1.06Z"/>
            <path d="M15.426 14.828a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 0l-2.5 2.5a.75.75 0 1 0 1.06 1.06l1.947-1.947 1.946 1.947a.75.75 0 0 0 1.06 0Z"/>
        </svg>
    @endif
@else
    <svg class="inline w-3 h-3 ml-1 text-gray-400 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
        <path d="M8.574 18.354a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 0l-2.5 2.5a.75.75 0 1 0 1.06 1.06L6 16.781v5.469a.75.75 0 0 0 1.5 0v-5.469l1.946 1.947a.75.75 0 0 0 1.06 0Z"/>
        <path d="M15.426 5.646a.75.75 0 0 0 0 1.06l2.5 2.5a.75.75 0 0 0 1.06 0l2.5-2.5a.75.75 0 1 0-1.06-1.06L18 7.219V1.75a.75.75 0 0 0-1.5 0v5.469l-1.946-1.947a.75.75 0 0 0-1.06 0Z"/>
    </svg>
@endif
