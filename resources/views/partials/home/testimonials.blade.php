@if($testimonials->count())
<section class="section-padding bg-pal-dark">
    <div class="container-pal">
        <div class="text-center mb-12">
            <span class="section-label justify-center">{{ $setting('section_testimonials_label', 'Real People. Real Results.') }}</span>
            <h2 class="heading-lg mt-4">{{ $setting('section_testimonials_heading', "Don't Take Our Word For It") }}</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $testimonial)
                <div class="card">
                    <div class="flex gap-1 mb-4">
                        @for($i = 0; $i < $testimonial->rating; $i++)
                            <svg class="w-4 h-4 text-pal-yellow" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-pal-muted text-sm leading-relaxed mb-6">"{{ $testimonial->content }}"</p>
                    <div class="flex items-center gap-3">
                        @if($testimonial->imageUrl('avatar'))
                            <img src="{{ $testimonial->imageUrl('avatar') }}" alt="{{ $testimonial->name }}" class="w-10 h-10 rounded-full object-cover" loading="lazy">
                        @endif
                        <div>
                            <p class="font-semibold">{{ $testimonial->name }}</p>
                            @if($testimonial->role || $testimonial->company)
                                <p class="text-sm text-pal-yellow">
                                    {{ collect([$testimonial->role, $testimonial->company])->filter()->join(', ') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
