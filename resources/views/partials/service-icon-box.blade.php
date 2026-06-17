@php
    $categoryIconMap = [
        'Custom Software Development' => 'custom-software',
        'CRM Development' => 'crm',
        'Web Development' => 'web',
        'Mobile Applications' => 'mobile',
        'Business Automation' => 'automation',
    ];
    $iconKey = $categoryIconMap[$category] ?? 'custom-software';
@endphp

<div class="w-12 h-12 rounded-2xl bg-pal-black border border-pal-yellow/30 flex items-center justify-center mb-5 group-hover:border-pal-yellow/60 group-hover:shadow-lg group-hover:shadow-pal-yellow/10 transition-all duration-300">
    <x-service-icon :icon="$iconKey" />
</div>
