@props(['variant' => 'primary'])

<button {{ $attributes->merge(['class' => $variant === 'accent' ? 'btn-accent' : 'btn-primary']) }}>
    {{ $slot }}
</button>
