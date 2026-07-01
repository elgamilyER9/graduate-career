@props(['size' => 24])

<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <path d="M3 10.5L12 6L21 10.5L12 15L3 10.5Z" fill="currentColor" fill-opacity="0.18"/>
    <path d="M3 10.5L12 6L21 10.5L12 15L3 10.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
    <path d="M21 10.5V13.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
    <path d="M7 12V15.5C7 16.88 9.24 18 12 18C14.76 18 17 16.88 17 15.5V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
    <path d="M12 18V20.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
    <path d="M10 18.75L12 21L14 18.75" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
