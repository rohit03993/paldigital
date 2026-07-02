@if($clients->count())
<section class="section-padding bg-pal-black border-y border-white/5" id="clients">
    <div class="container-pal">
        <div class="text-center mb-12">
            <span class="section-label justify-center">{{ $setting('section_clients_label', 'Trusted By') }}</span>
            <h2 class="heading-lg mt-4">{{ $setting('section_clients_heading', 'Brands We Have Worked With') }}</h2>
            @if($setting('section_clients_subheading'))
                <p class="text-pal-muted mt-4 max-w-2xl mx-auto">{{ $setting('section_clients_subheading') }}</p>
            @endif
        </div>

        <div
            class="relative"
            x-data="{
                index: 0,
                perView: 4,
                total: {{ $clients->count() }},
                init() {
                    this.updatePerView();
                    window.addEventListener('resize', () => this.updatePerView());
                },
                updatePerView() {
                    if (window.innerWidth < 640) this.perView = 1;
                    else if (window.innerWidth < 1024) this.perView = 2;
                    else this.perView = 4;
                    this.index = Math.min(this.index, this.maxIndex);
                },
                get maxIndex() {
                    return Math.max(0, this.total - this.perView);
                },
                get canPrev() { return this.index > 0; },
                get canNext() { return this.index < this.maxIndex; },
                prev() { if (this.canPrev) this.index--; },
                next() { if (this.canNext) this.index++; },
                get translateX() {
                    const track = this.$refs.track;
                    const item = track?.children[0];
                    if (!item) return 0;
                    return this.index * item.offsetWidth;
                }
            }"
        >
            <div class="overflow-hidden">
                <div
                    x-ref="track"
                    class="flex transition-transform duration-500 ease-out"
                    :style="`transform: translateX(-${translateX}px)`"
                >
                    @foreach($clients as $client)
                        <div class="w-full sm:w-1/2 lg:w-1/4 shrink-0 px-2 sm:px-3">
                            <article class="client-card h-full">
                                <div class="client-logo-frame">
                                    @if($client->imageUrl('logo'))
                                        <img
                                            src="{{ $client->imageUrl('logo') }}"
                                            alt="{{ $client->company_name }} logo"
                                            class="client-logo-img"
                                            loading="lazy"
                                        >
                                    @endif
                                </div>
                                <div class="client-card-body text-center">
                                    <h3 class="font-display font-semibold text-white text-sm sm:text-base leading-snug">
                                        {{ $client->company_name }}
                                    </h3>
                                    @if($client->category)
                                        <p class="text-pal-yellow text-xs sm:text-sm mt-1">{{ $client->category }}</p>
                                    @endif
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>

            @if($clients->count() > 1)
                <div class="flex items-center justify-center gap-3 mt-8">
                    <button
                        type="button"
                        @click="prev()"
                        :disabled="!canPrev"
                        class="client-carousel-btn"
                        aria-label="Previous clients"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button
                        type="button"
                        @click="next()"
                        :disabled="!canNext"
                        class="client-carousel-btn"
                        aria-label="Next clients"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            @endif
        </div>
    </div>
</section>
@endif
