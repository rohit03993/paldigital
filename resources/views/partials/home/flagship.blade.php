@if($flagship)
<section id="solutions" class="section-padding">
    <div class="container-pal">
        <div class="text-center mb-12 sm:mb-16">
            <span class="section-label justify-center">{{ $setting('section_flagship_label', 'The Proof') }}</span>
            <h2 class="heading-lg mt-4">{{ $flagship->title }}</h2>
            <p class="text-pal-muted mt-4 max-w-3xl mx-auto">
                {{ $setting('section_flagship_subtitle', $flagship->description) }}
            </p>
        </div>

        <div class="relative">
            <div class="absolute -inset-1 bg-gradient-to-r from-pal-yellow/20 to-transparent rounded-2xl blur-xl"></div>
            <div class="relative card !p-8 sm:!p-10 border-pal-yellow/30">
                @if($flagship->imageUrl())
                    <img src="{{ $flagship->imageUrl() }}" alt="{{ $flagship->title }}" class="w-full rounded-xl mb-8 object-cover max-h-72" loading="lazy">
                @endif

                <div class="flex items-center gap-3 mb-8 flex-wrap">
                    <span class="px-3 py-1 bg-pal-yellow text-pal-black text-xs font-bold rounded-full uppercase">{{ $setting('section_flagship_badge', 'Flagship Product') }}</span>
                    <span class="text-pal-muted text-sm">{{ $flagship->description }}</span>
                </div>

                @if($flagship->features)
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                        @foreach($flagship->features as $feature)
                            <div class="flex items-center gap-2 p-3 rounded-lg bg-pal-dark border border-pal-border">
                                <svg class="w-4 h-4 text-pal-yellow shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm">{{ $feature }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-8 p-4 sm:p-6 rounded-xl bg-pal-yellow/5 border border-pal-yellow/20">
                    <p class="text-sm sm:text-base text-pal-muted">
                        {{ $setting('section_flagship_note', 'Built for schools first — but the same engine powers hospitals, factories, and custom workflows.') }}
                    </p>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <button type="button" @click="demoOpen = true" class="btn-primary">I Need to See This</button>
                    <a href="{{ route('solutions') }}" class="btn-outline">All Solutions →</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
