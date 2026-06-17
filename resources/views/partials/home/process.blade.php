<section class="section-padding">
    <div class="container-pal">
        <div class="text-center mb-14">
            <span class="section-label justify-center">{{ $setting('section_process_label', 'The Process') }}</span>
            <h2 class="heading-lg mt-4">{{ $setting('section_process_heading', 'No Templates. No Shortcuts.') }}</h2>
            <p class="text-pal-muted mt-3 max-w-xl mx-auto">{{ $setting('section_process_subheading', 'We map your workflow first, then write code.') }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($settingJson('process_steps', []) as $index => $step)
                <div class="card relative {{ $index >= 4 ? 'lg:col-span-1' : '' }}">
                    <span class="text-5xl font-display font-extrabold text-pal-yellow/10 absolute top-3 right-4">{{ $step['number'] ?? '' }}</span>
                    <h3 class="font-display font-bold mb-2 relative">{{ $step['title'] ?? '' }}</h3>
                    <p class="text-sm text-pal-muted relative">{{ $step['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
