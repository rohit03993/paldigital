@extends('layouts.app')

@section('content')
@php
    $photo = \App\Models\SiteSetting::asset('about_ceo_photo');
    $name = $setting('about_ceo_name', 'Rohit Pal');

    $storyChapters = $settingJson('about_story_chapters', [
        ['chapter' => '01', 'label' => 'Where It Started', 'title' => '8+ Years Building for Real Clients', 'body' => 'Before Pal Digital, I spent over eight years hands-on with clients — shipping ERP systems, CRM platforms, admission workflows, and custom tools across education, healthcare, operations, and more. Every project was different. Every industry had its own chaos. But one pattern kept repeating.'],
        ['chapter' => '02', 'label' => 'What I Kept Seeing', 'title' => 'Businesses Deserve Better Than Workarounds', 'body' => 'Schools running admissions on Excel. Teams coordinating on WhatsApp. Owners paying for software that almost fits — then bending their entire process to match it. I studied AI & Data Science at IIT Roorkee, and that lens made it obvious: the problem wasn\'t lack of technology. It was lack of software built around how people actually work.'],
        ['chapter' => '03', 'label' => 'The 2024 Decision', 'title' => 'Why I Went Full-Time', 'body' => 'In 2024, I made a clear decision — stop treating this as side work and go all in. Pal Digital became my full-time mission: help people and businesses escape manual chaos, automate what slows them down, and build systems that scale in the AI era. Not templates. Not one-size-fits-all. Real software for real workflows.'],
        ['chapter' => '04', 'label' => 'Why Pal Digital', 'title' => 'Built to Help You Grow — Not Just Go Live', 'body' => 'Pal Digital exists because I\'ve seen what happens when the right system clicks — teams move faster, errors drop, and owners finally have visibility. We don\'t just write code. We map your process, automate the boring parts, and ship software your team will actually use. That\'s the story. That\'s why we\'re here.'],
    ]);

    $timeline = $settingJson('about_timeline', []);
    $focusAreas = $settingJson('about_focus_areas', []);
@endphp

{{-- ═══ HERO ═══ --}}
<section class="relative min-h-[90vh] flex items-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-pal-black via-[#0a0a0a] to-pal-black"></div>
    <div class="absolute inset-0 hero-grid opacity-50"></div>
    <div class="absolute top-1/4 -left-32 w-96 h-96 bg-pal-yellow/8 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-1/4 -right-32 w-80 h-80 bg-pal-yellow/6 rounded-full blur-[100px]"></div>

    <div class="container-pal relative z-10 section-padding w-full">
        <div class="max-w-4xl mx-auto text-center">
            <span class="section-label justify-center">{{ $setting('about_hero_label', 'My Story') }}</span>

            <h1 class="heading-xl mt-6 mb-3">
                <span class="text-gradient">{{ $name }}</span>
            </h1>

            <p class="text-lg sm:text-xl font-display font-semibold text-white/90 mb-2">
                {{ $setting('about_ceo_title', 'Developer & CEO, Pal Digital') }}
            </p>

            <p class="text-sm sm:text-base text-pal-yellow/90 mb-5">
                {{ $setting('about_ceo_education', 'IIT Roorkee · Artificial Intelligence & Data Science') }}
            </p>

            <p class="text-base sm:text-lg font-display font-medium text-white/80 mb-3">
                {{ $setting('about_hero_heading', 'Why I Started Pal Digital') }}
            </p>

            <p class="text-body-lg text-white/65 max-w-2xl mx-auto mb-12">
                {{ $setting('about_hero_subheading', 'From 8+ years of client projects to a full-time mission in 2024 — helping businesses automate, scale, and win in the AI era.') }}
            </p>

            {{-- Founder card --}}
            <div class="relative max-w-md mx-auto">
                <div class="absolute -inset-1 bg-gradient-to-b from-pal-yellow/30 via-pal-yellow/5 to-transparent rounded-3xl blur-xl"></div>
                <div class="relative card !p-8 border-pal-yellow/20 text-center">
                    @if($photo)
                        <img src="{{ $photo }}" alt="{{ $name }} — Developer and CEO of Pal Digital, IIT Roorkee AI and Data Science" class="w-28 h-28 sm:w-32 sm:h-32 mx-auto rounded-2xl object-cover border-2 border-pal-yellow/40 shadow-lg shadow-pal-yellow/10 mb-5" loading="eager" width="128" height="128">
                    @else
                        <div class="w-28 h-28 sm:w-32 sm:h-32 mx-auto rounded-2xl bg-gradient-to-br from-pal-yellow/25 to-pal-yellow/5 border-2 border-pal-yellow/40 flex items-center justify-center mb-5">
                            <span class="text-5xl font-display font-bold text-pal-yellow">{{ substr($name, 0, 1) }}</span>
                        </div>
                    @endif

                    <h2 class="font-display text-2xl sm:text-3xl font-bold text-white mb-1">{{ $name }}</h2>
                    <p class="text-pal-yellow font-semibold text-sm sm:text-base mb-2">{{ $setting('about_ceo_title', 'Developer & CEO, Pal Digital') }}</p>
                    <p class="text-xs sm:text-sm text-pal-muted mb-4">{{ $setting('about_ceo_education', 'IIT Roorkee · Artificial Intelligence & Data Science') }}</p>

                    <div class="about-quote text-left max-w-sm mx-auto">
                        <p class="text-sm sm:text-base text-white/85 italic leading-relaxed">
                            "{{ $setting('about_ceo_tagline', 'Your workflow deserves software built around it — not a template.') }}"
                        </p>
                    </div>
                </div>
            </div>

            <a href="#my-story" class="inline-flex flex-col items-center gap-2 mt-14 text-pal-muted hover:text-pal-yellow transition-colors text-xs uppercase tracking-widest">
                <span>Read the story</span>
                <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ═══ STATS ═══ --}}
<section class="relative z-10 -mt-6 sm:-mt-10">
    <div class="container-pal px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 max-w-5xl mx-auto">
            @foreach([
                [$setting('about_stat_1_value', '8+'), $setting('about_stat_1_label', 'Years in the Field')],
                [$setting('about_stat_2_value', 'Multi'), $setting('about_stat_2_label', 'Industries Served')],
                [$setting('about_stat_3_value', '2024'), $setting('about_stat_3_label', 'Full-Time Mission')],
                [$setting('about_stat_4_value', 'AI'), $setting('about_stat_4_label', 'Era Ready')],
            ] as [$value, $label])
                <div class="about-stat-card">
                    <div class="stat-value">{{ $value }}</div>
                    <div class="stat-label">{{ $label }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ STORY INTRO ═══ --}}
<section id="my-story" class="section-padding">
    <div class="container-pal max-w-3xl mx-auto text-center mb-16 sm:mb-20">
        <span class="section-label justify-center">{{ $setting('about_story_intro_label', 'The Narrative') }}</span>
        <h2 class="heading-lg mt-5 mb-5">
            {{ $setting('about_story_intro_heading', 'From Client Projects to a Company With a Purpose') }}
        </h2>
        <p class="text-body-lg">
            {{ $setting('about_story_intro_text', 'This isn\'t a corporate About page. It\'s the honest version — why I build software, what I saw over 8+ years, and why 2024 was the year I decided to help businesses properly.') }}
        </p>
    </div>

    {{-- Story chapters --}}
    <div class="container-pal max-w-4xl mx-auto space-y-16 sm:space-y-20">
        @foreach($storyChapters as $index => $chapter)
            <article class="story-chapter group">
                <div class="story-chapter-num">{{ $chapter['chapter'] ?? str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                <div class="card !p-8 sm:!p-10 border-white/5 group-hover:border-pal-yellow/20 transition-colors">
                    <span class="text-[11px] font-semibold uppercase tracking-[0.2em] text-pal-yellow mb-3 block">{{ $chapter['label'] ?? '' }}</span>
                    <h3 class="heading-md !text-xl sm:!text-2xl mb-4 text-white">{{ $chapter['title'] ?? '' }}</h3>
                    <p class="text-pal-muted leading-[1.8] text-[15px] sm:text-base">{{ $chapter['body'] ?? '' }}</p>
                </div>
            </article>
        @endforeach
    </div>
</section>

{{-- ═══ 2024 HIGHLIGHT ═══ --}}
<section class="section-padding bg-pal-dark/60 border-y border-white/5 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-pal-yellow/5 via-transparent to-pal-yellow/5"></div>
    <div class="container-pal relative">
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center max-w-6xl mx-auto">
            <div>
                <span class="year-pill mb-6">Since 2024</span>
                <h2 class="heading-lg mb-5">
                    {{ $setting('about_2024_heading', 'Why 2024 Changed Everything') }}
                </h2>
                <p class="text-pal-muted leading-[1.8] mb-5">
                    {{ $setting('about_2024_text', 'For years I delivered projects alongside other work. Clients got results — but I knew we could go deeper. In 2024, I chose full-time development under Pal Digital so every business we take on gets full focus: proper discovery, real automation, and software that grows with them — not against them.') }}
                </p>
                <p class="text-pal-muted leading-[1.8]">
                    {{ $setting('about_2024_text_2', 'Today, that means helping schools, clinics, factories, startups, and service businesses replace manual work with systems they control. In the AI era, that\'s not optional — it\'s how you stay ahead.') }}
                </p>
            </div>

            <div class="card !p-8 sm:!p-10 border-pal-yellow/15">
                <span class="section-label">The Journey</span>
                <h3 class="heading-md mt-3 mb-8">Timeline</h3>
                <div class="space-y-0 relative">
                    <div class="absolute left-[11px] top-2 bottom-2 w-px bg-gradient-to-b from-pal-yellow/40 via-pal-yellow/20 to-pal-yellow/5"></div>
                    @foreach($timeline as $item)
                        <div class="relative pl-10 pb-8 last:pb-0 group">
                            <span class="absolute left-0 top-1.5 w-6 h-6 rounded-full bg-pal-yellow/20 border-2 border-pal-yellow flex items-center justify-center group-hover:bg-pal-yellow/30 transition-colors">
                                <span class="w-2 h-2 rounded-full bg-pal-yellow"></span>
                            </span>
                            <p class="text-xs font-semibold text-pal-yellow uppercase tracking-wider mb-1">{{ $item['year'] ?? '' }}</p>
                            <h4 class="font-display font-bold text-white mb-1">{{ $item['title'] ?? '' }}</h4>
                            <p class="text-sm text-pal-muted leading-relaxed">{{ $item['description'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ WHY PAL DIGITAL ═══ --}}
<section class="section-padding">
    <div class="container-pal">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-start max-w-6xl mx-auto">
            <div>
                <span class="section-label">{{ $setting('about_why_label', 'Our Purpose') }}</span>
                <h2 class="heading-lg mt-4 mb-6">
                    {{ $setting('about_why_heading', 'Why Pal Digital Exists') }}
                </h2>
                <p class="text-pal-muted leading-[1.8] mb-6">
                    {{ $setting('about_why_text', 'I started Pal Digital because I was tired of watching capable people struggle with incapable tools. Spreadsheets pretending to be ERPs. WhatsApp threads pretending to be CRMs. Software that almost works — until your business outgrows it.') }}
                </p>
                <p class="text-pal-muted leading-[1.8]">
                    {{ $setting('about_mission_text', 'We exist to give businesses something better: custom software and automation designed around how you actually operate — so you can grow faster, make fewer mistakes, and compete in an AI-driven world without starting from scratch every year.') }}
                </p>

                <blockquote class="about-quote mt-10">
                    <p class="text-lg sm:text-xl font-display font-semibold text-white leading-snug">
                        "{{ $setting('about_pull_quote', 'I don\'t sell software. I solve the workflow problems that keep businesses stuck.') }}"
                    </p>
                    <footer class="mt-3 text-sm text-pal-yellow font-medium">— {{ $name }}</footer>
                </blockquote>
            </div>

            <div class="grid gap-4 sm:gap-5">
                @foreach($focusAreas as $i => $area)
                    <div class="card !p-6 flex gap-5 items-start group hover:border-pal-yellow/25">
                        <div class="shrink-0 w-12 h-12 rounded-xl bg-pal-yellow/15 flex items-center justify-center font-display font-bold text-pal-yellow text-lg">
                            {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-lg text-white mb-1 group-hover:text-pal-yellow transition-colors">{{ $area['title'] ?? '' }}</h3>
                            <p class="text-sm text-pal-muted leading-relaxed">{{ $area['description'] ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ═══ WHO WE HELP ═══ --}}
<section class="section-padding bg-pal-dark/50 border-t border-white/5">
    <div class="container-pal max-w-4xl mx-auto text-center">
        <span class="section-label justify-center">{{ $setting('about_help_label', 'Who We Help') }}</span>
        <h2 class="heading-lg mt-5 mb-5">{{ $setting('about_help_heading', 'People & Businesses Ready to Move Forward') }}</h2>
        <p class="text-body-lg mb-10 max-w-2xl mx-auto">
            {{ $setting('about_help_text', 'If you\'re running a school, clinic, factory, agency, or any operation that has outgrown spreadsheets — we\'re built for you. From 2024 onward, every project we take is about one thing: helping you automate, scale, and win.') }}
        </p>

        <div class="flex flex-wrap justify-center gap-3">
            @foreach(['Education', 'Healthcare', 'Manufacturing', 'Real Estate', 'Startups', 'Service Businesses', 'Custom Workflows'] as $tag)
                <span class="px-4 py-2 rounded-full text-sm border border-white/10 text-pal-muted bg-pal-card">{{ $tag }}</span>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ CTA ═══ --}}
<section class="section-padding">
    <div class="container-pal">
        <div class="relative overflow-hidden rounded-3xl border border-pal-yellow/25 max-w-4xl mx-auto">
            <div class="absolute inset-0 bg-gradient-to-br from-pal-yellow/10 via-pal-card to-pal-card"></div>
            <div class="relative !p-10 sm:!p-16 text-center">
                <h2 class="heading-lg mb-4">{{ $setting('about_cta_heading', 'Let\'s Write the Next Chapter — Yours') }}</h2>
                <p class="text-pal-muted mb-8 max-w-lg mx-auto leading-relaxed">
                    {{ $setting('about_cta_text', 'Tell me what\'s broken in your workflow. I\'ll show you what custom software and automation can actually do for your business.') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact') }}?type=consultation" class="btn-primary">Talk to Rohit — Free Consult</a>
                    <button type="button" @click="demoOpen = true" class="btn-outline">See a Live Demo</button>
                </div>
            </div>
        </div>
    </div>
</section>

@if($team->where('name', '!=', $name)->count())
<section class="section-padding bg-pal-dark border-t border-white/5">
    <div class="container-pal">
        <h2 class="heading-md text-center mb-8">The Team Behind Pal Digital</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
            @foreach($team->where('name', '!=', $name) as $member)
                <div class="card text-center">
                    @if($member->imageUrl('photo'))
                        <img src="{{ $member->imageUrl('photo') }}" alt="{{ $member->name }}" class="w-20 h-20 mx-auto rounded-full object-cover mb-4" loading="lazy">
                    @else
                        <div class="w-20 h-20 mx-auto rounded-full bg-pal-yellow/20 flex items-center justify-center text-2xl font-bold text-pal-yellow mb-4">
                            {{ substr($member->name, 0, 1) }}
                        </div>
                    @endif
                    <h3 class="font-semibold">{{ $member->name }}</h3>
                    <p class="text-sm text-pal-yellow">{{ $member->role }}</p>
                    @if($member->bio)<p class="text-sm text-pal-muted mt-2">{{ $member->bio }}</p>@endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
