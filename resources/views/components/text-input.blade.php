@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-xl border-slate-300 text-sm focus:border-primary-600 focus:ring-primary-600']) }}>