@props([
    'labelKey' => null,
    'headingKey',
    'subheadingKey',
    'defaultLabel' => '',
    'defaultHeading' => '',
    'defaultSubheading' => '',
    'wrapperClass' => 'text-center mb-12',
    'headingClass' => 'heading-lg mt-4 mb-4',
    'subheadingClass' => 'text-pal-muted max-w-2xl mx-auto',
])

<div class="{{ $wrapperClass }}">
    @if($labelKey)
        <span class="section-label justify-center">{{ $setting($labelKey, $defaultLabel) }}</span>
    @endif
    <h1 class="{{ $headingClass }}">{{ $setting($headingKey, $defaultHeading) }}</h1>
    <p class="{{ $subheadingClass }}">{{ $setting($subheadingKey, $defaultSubheading) }}</p>
</div>
