@extends('layouts.app')

@php
    $setting = fn($key, $default = '') => \App\Models\SiteSetting::get($key, $default);
    $whatsapp = preg_replace('/[^0-9]/', '', $setting('whatsapp', ''));
    $defaultType = old('type', request('type', 'consultation'));
@endphp

@section('content')
<section class="section-padding mobile-main lg:!pt-28">
    <div class="container-pal max-w-4xl mx-auto">
        <div class="text-center mb-8 lg:mb-10">
            @include('partials.inner-page-header', [
                'labelKey' => 'inner_contact_label',
                'headingKey' => 'inner_contact_heading',
                'subheadingKey' => 'inner_contact_subheading',
                'defaultLabel' => 'Contact',
                'defaultHeading' => "Let's Talk",
                'defaultSubheading' => 'Quick form. No spam. We reply within 24 hours.',
                'wrapperClass' => '',
                'headingClass' => 'heading-lg mt-3 !text-2xl sm:!text-3xl lg:!text-4xl mb-2',
                'subheadingClass' => 'text-body max-w-sm mx-auto !text-sm',
            ])
        </div>

        <div class="grid lg:grid-cols-5 gap-6 lg:gap-8 items-start">
            {{-- Quick contact --}}
            <div class="lg:col-span-2 space-y-3">
                @if($whatsapp)
                    <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener"
                       class="flex items-center gap-3 p-4 rounded-xl bg-[#25D366]/10 border border-[#25D366]/25 hover:border-[#25D366]/50 transition-colors group">
                        <span class="w-10 h-10 rounded-lg bg-[#25D366] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-white group-hover:text-[#25D366] transition-colors">WhatsApp</p>
                            <p class="text-xs text-pal-muted">Fastest way to reach us</p>
                        </div>
                    </a>
                @endif

                @if($setting('contact_email'))
                    <a href="mailto:{{ $setting('contact_email') }}"
                       class="flex items-center gap-3 p-4 rounded-xl bg-pal-card border border-white/5 hover:border-pal-yellow/30 transition-colors">
                        <span class="w-10 h-10 rounded-lg bg-pal-yellow/10 border border-pal-yellow/20 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-pal-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </span>
                        <div class="min-w-0">
                            <p class="text-sm font-semibold">Email</p>
                            <p class="text-xs text-pal-muted truncate">{{ $setting('contact_email') }}</p>
                        </div>
                    </a>
                @endif

                @if($setting('contact_phone'))
                    <a href="tel:{{ $setting('contact_phone') }}"
                       class="flex items-center gap-3 p-4 rounded-xl bg-pal-card border border-white/5 hover:border-pal-yellow/30 transition-colors">
                        <span class="w-10 h-10 rounded-lg bg-pal-yellow/10 border border-pal-yellow/20 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-pal-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </span>
                        <div>
                            <p class="text-sm font-semibold">Call</p>
                            <p class="text-xs text-pal-muted">{{ $setting('contact_phone') }}</p>
                        </div>
                    </a>
                @endif

                <button type="button" @click="demoOpen = true"
                        class="w-full flex items-center justify-center gap-2 p-3 rounded-xl border border-dashed border-pal-yellow/30 text-pal-yellow text-sm font-medium hover:bg-pal-yellow/5 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    Book a demo instead
                </button>
            </div>

            {{-- Compact form --}}
            <div class="lg:col-span-3">
                <form action="{{ route('leads.store') }}" method="POST"
                      class="rounded-2xl border border-white/10 bg-pal-card/60 backdrop-blur-sm p-5 sm:p-6 space-y-4"
                      x-data="{ type: '{{ $defaultType }}' }">
                    @csrf
                    <input type="hidden" name="type" :value="type">

                    <div>
                        <label class="block text-xs font-medium text-pal-muted mb-2 uppercase tracking-wider">I'm interested in</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach([
                                'consultation' => 'Consultation',
                                'demo' => 'Demo',
                                'project' => 'Project',
                                'contact' => 'General',
                            ] as $value => $label)
                                <button type="button" @click="type = '{{ $value }}'"
                                        :class="type === '{{ $value }}' ? 'contact-chip contact-chip-active' : 'contact-chip'">
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="input-field-sm" placeholder="Name *">
                            @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="input-field-sm" placeholder="Email *">
                            @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <input type="tel" name="phone" value="{{ old('phone') }}" class="input-field-sm" placeholder="Phone">
                        <input type="text" name="company" value="{{ old('company') }}" class="input-field-sm" placeholder="Company">
                    </div>

                    <textarea name="message" rows="3" class="input-field-sm resize-none"
                              placeholder="What's on your mind? (optional)">{{ old('message') }}</textarea>

                    <button type="submit" class="btn-primary w-full !py-2.5 !text-sm">
                        Send →
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
