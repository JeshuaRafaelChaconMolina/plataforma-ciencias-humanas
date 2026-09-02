@props(['color' => 'primary'])

<span @class([
    'inline-block rounded-full px-3 py-1 text-xs font-semibold',
    'bg-primary-100 text-primary-800' => $color === 'primary',
    'bg-accent-500/20 text-primary-800' => $color === 'accent',
    'bg-slate-100 text-slate-600' => $color === 'neutral',
])>
    {{ $slot }}
</span>
