@php
    use App\Models\DemoRequest;
    $defaultProduct = old('product', 'education-erp');
    $defaultTime = old('preferred_time', '');
@endphp

<div x-show="demoOpen" x-cloak
     class="fixed inset-0 z-[100] flex items-end sm:items-center justify-center p-0 sm:p-4"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100">
    <div class="absolute inset-0 bg-black/75 backdrop-blur-md" @click="demoOpen = false"></div>

    <div class="relative w-full sm:max-w-md bg-pal-card border border-white/10 sm:rounded-2xl rounded-t-2xl shadow-2xl"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-6 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         @click.stop>

        <div class="px-5 py-4 flex items-start justify-between border-b border-white/5">
            <div>
                <h3 class="font-display font-bold text-lg tracking-tight">Book a Demo</h3>
                <p class="text-pal-muted text-xs mt-0.5">30 mins · Free · No sales pitch</p>
            </div>
            <button @click="demoOpen = false" class="p-1.5 rounded-lg hover:bg-white/5 text-pal-muted mt-0.5" aria-label="Close">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        @if(session('demo_success'))
            <div class="p-8 text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-pal-yellow/15 border border-pal-yellow/30 flex items-center justify-center">
                    <svg class="w-7 h-7 text-pal-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <p class="font-display font-semibold mb-1">You're on the list!</p>
                <p class="text-pal-muted text-sm">{{ session('demo_success') }}</p>
                <button @click="demoOpen = false" class="btn-outline mt-6 !text-sm !py-2">Close</button>
            </div>
        @else
            <form action="{{ route('demo-requests.store') }}" method="POST" class="p-5 space-y-4"
                  x-data="{ product: '{{ $defaultProduct }}', time: '{{ $defaultTime }}' }">
                @csrf
                <input type="hidden" name="product" :value="product">
                <input type="hidden" name="preferred_time" :value="time">

                {{-- Product chips --}}
                <div>
                    <p class="text-[11px] font-medium text-pal-muted uppercase tracking-wider mb-2">What to show you</p>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach([
                            'education-erp' => 'Education ERP',
                            'crm' => 'CRM',
                            'custom-software' => 'Custom App',
                            'mobile-app' => 'Mobile',
                            'other' => 'Other',
                        ] as $value => $label)
                            <button type="button" @click="product = '{{ $value }}'"
                                    :class="product === '{{ $value }}' ? 'contact-chip contact-chip-active' : 'contact-chip'">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Core fields --}}
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="input-field-sm" placeholder="Full name *">

                <div class="grid grid-cols-2 gap-2.5">
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="input-field-sm" placeholder="Email *">
                    <input type="tel" name="phone" value="{{ old('phone') }}" required
                           class="input-field-sm" placeholder="Phone *">
                </div>

                <input type="text" name="company" value="{{ old('company') }}"
                       class="input-field-sm" placeholder="Company (optional)">

                {{-- Schedule (optional) --}}
                <div class="rounded-xl border border-white/5 bg-pal-dark/50 p-3 space-y-2.5">
                    <p class="text-[11px] font-medium text-pal-muted uppercase tracking-wider">When suits you? <span class="normal-case text-pal-muted/60">(optional)</span></p>
                    <input type="date" name="preferred_date" value="{{ old('preferred_date') }}" min="{{ date('Y-m-d') }}"
                           class="input-field-sm !py-2">
                    <div class="flex flex-wrap gap-1.5">
                        @foreach(['morning' => 'Morning', 'afternoon' => 'Afternoon', 'evening' => 'Evening'] as $value => $label)
                            <button type="button" @click="time = time === '{{ $value }}' ? '' : '{{ $value }}'"
                                    :class="time === '{{ $value }}' ? 'contact-chip contact-chip-active' : 'contact-chip'">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <textarea name="message" rows="2" class="input-field-sm resize-none"
                          placeholder="Anything specific you want to see?">{{ old('message') }}</textarea>

                <button type="submit" class="btn-primary w-full !py-2.5 !text-sm font-semibold">
                    Book My Demo →
                </button>
                <p class="text-center text-[11px] text-pal-muted">We'll confirm within 24 hours.</p>
            </form>
        @endif
    </div>
</div>
