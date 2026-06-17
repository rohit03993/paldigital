@php
    $slugIconMap = [
        'education' => 'academic-cap',
        'healthcare' => 'heart',
        'real-estate' => 'building',
        'manufacturing' => 'cog',
        'travel-tourism' => 'globe',
        'service-businesses' => 'briefcase',
        'ngos-organizations' => 'users',
        'custom-requirements' => 'sparkles',
    ];
    $iconKey = $industry->icon ?: ($slugIconMap[$industry->slug] ?? 'sparkles');
    $inline = $inline ?? false;
@endphp

<div @class([
    'rounded-2xl bg-pal-black border border-pal-yellow/30 flex items-center justify-center group-hover:border-pal-yellow/60 group-hover:shadow-lg group-hover:shadow-pal-yellow/10 transition-all duration-300 shrink-0',
    'w-11 h-11 sm:w-14 sm:h-14 mx-auto mb-3 sm:mb-4' => ! $inline,
    'w-12 h-12 sm:w-14 sm:h-14' => $inline,
])>
    <x-industry-icon :icon="$iconKey" />
</div>
