<?php

namespace Database\Seeders;

use App\Models\Industry;
use App\Models\Portfolio;
use App\Models\SeoMeta;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Solution;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSiteSettings();
        $this->seedInnerPages();
        $this->seedAboutContent();
        $this->seedServices();
        $this->seedIndustries();
        $this->seedSolutions();
        $this->seedSeo();
        $this->seedTestimonials();
        $this->seedPortfolio();
    }

    private function seedSiteSettings(): void
    {
        $settings = [
            'site_name' => 'Pal Digital',
            'tagline' => 'Custom software that actually gets your business — not the other way around',
            'hero_heading' => 'Software That Actually Fits How You Work',
            'hero_subheading' => 'ERP, CRM, mobile apps, automations — we build the tools your business deserves. Not some generic template your team will hate.',
            'hero_message' => 'Your business doesn\'t run like everyone else\'s. So why would your software? We build around you — not the other way around.',
            'hero_stat_1_value' => '25+', 'hero_stat_1_label' => 'Modules Shipped',
            'hero_stat_2_value' => '8+', 'hero_stat_2_label' => 'Industries Cracked',
            'hero_stat_3_value' => '0', 'hero_stat_3_label' => 'Templates Used',
            'message_line_1' => 'Your business doesn\'t run like everyone else\'s.',
            'message_line_2' => 'So why would your software?',
            'message_line_3' => 'We build around you — not the other way around.',
            'contact_email' => 'info@paldigital.in',
            'contact_phone' => '+91 98765 43210',
            'whatsapp' => '+919876543210',
            'whatsapp_message' => 'Hey Pal Digital 👋 I want to talk about building custom software for my business.',
            'address' => 'India',
            'site_url' => config('app.url'),
            'section_demo_panel_title' => 'What You Can Explore',
            'section_clients_label' => 'Trusted By',
            'section_clients_heading' => 'Brands We Have Worked With',
            'section_clients_subheading' => 'Schools, businesses, and teams who trusted us to build software around how they work.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }

        SiteSetting::setJson('process_steps', [
            ['number' => '01', 'title' => 'We Listen', 'description' => 'You talk. We actually pay attention.'],
            ['number' => '02', 'title' => 'We Map It', 'description' => 'Your process, documented — every step.'],
            ['number' => '03', 'title' => 'We Design It', 'description' => 'UI your team won\'t hate using.'],
            ['number' => '04', 'title' => 'We Build It', 'description' => 'Clean code. Modern stack. No duct tape.'],
            ['number' => '05', 'title' => 'We Break It', 'description' => 'QA until it\'s bulletproof.'],
            ['number' => '06', 'title' => 'We Ship It', 'description' => 'Go live without the chaos.'],
            ['number' => '07', 'title' => 'We Stick Around', 'description' => 'Updates, fixes, new features — we\'re here.'],
        ]);

        SiteSetting::setJson('demo_bullets', [
            ['text' => 'Live walkthrough — not a slideshow'],
            ['text' => 'Features picked for YOUR business'],
            ['text' => 'Dev team on the call, not just sales'],
        ]);

        SiteSetting::setJson('demo_cards', [
            ['title' => 'Education ERP', 'subtitle' => '11 modules', 'detail' => 'Admissions · Fees · Attendance · CRM', 'icon' => 'erp'],
            ['title' => 'CRM Platform', 'subtitle' => 'Lead → Close', 'detail' => 'Pipeline · Follow-ups · Reports', 'icon' => 'crm'],
            ['title' => 'Mobile Apps', 'subtitle' => 'iOS + Android', 'detail' => 'Portals · Field apps · Notifications', 'icon' => 'mobile'],
            ['title' => 'Automation', 'subtitle' => 'WhatsApp & more', 'detail' => 'Workflows · Alerts · Integrations', 'icon' => 'automation'],
        ]);

        SiteSetting::setJson('demo_agenda', [
            ['time' => '0–10 min', 'step' => 'Your goals & workflow — we listen first'],
            ['time' => '10–25 min', 'step' => 'Live demo tailored to your industry'],
            ['time' => '25–30 min', 'step' => 'Q&A with the dev team — no sales script'],
        ]);
    }

    private function seedInnerPages(): void
    {
        $pages = [
            'inner_services_label' => 'The Arsenal',
            'inner_services_heading' => 'Everything We Build',
            'inner_services_subheading' => 'From ERPs to WhatsApp bots — if your business needs it, we code it. No off-the-shelf nonsense.',
            'inner_services_cta' => 'Got Something Wild in Mind? Tell Us →',
            'inner_contact_label' => 'Contact',
            'inner_contact_heading' => "Let's Talk",
            'inner_contact_subheading' => 'Quick form. No spam. We reply within 24 hours.',
            'inner_portfolio_label' => 'Our Work',
            'inner_portfolio_heading' => 'Portfolio',
            'inner_portfolio_subheading' => "Projects we've delivered across industries.",
            'inner_portfolio_empty' => 'Portfolio items coming soon. Contact us to see our work.',
            'inner_industries_label' => 'Who We Serve',
            'inner_industries_heading' => 'Industries We Serve',
            'inner_industries_subheading' => 'Pal Digital builds custom software for any industry.',
            'inner_solutions_label' => 'What We Ship',
            'inner_solutions_heading' => "Proven Solutions We've Built",
            'inner_solutions_subheading' => 'Real software, real results — customized for your industry.',
            'inner_case_studies_label' => 'Success Stories',
            'inner_case_studies_heading' => 'Case Studies',
            'inner_case_studies_subheading' => "How we've helped businesses transform with custom software.",
            'inner_case_studies_empty' => 'Case studies coming soon.',
            'inner_blog_label' => 'Insights',
            'inner_blog_heading' => 'Blog',
            'inner_blog_subheading' => 'Insights on custom software, automation, and digital transformation.',
            'inner_blog_empty' => 'Blog posts coming soon.',
        ];

        foreach ($pages as $key => $value) {
            SiteSetting::set($key, $value);
        }
    }

    private function seedAboutContent(): void
    {
        $settings = [
            'about_hero_label' => 'My Story',
            'about_hero_heading' => 'Why I Started Pal Digital',
            'about_hero_subheading' => 'From 8+ years of client projects to a full-time mission in 2024 — helping businesses automate, scale, and win in the AI era.',
            'about_ceo_name' => 'Rohit Pal',
            'about_ceo_title' => 'Developer & CEO, Pal Digital',
            'about_ceo_education' => 'IIT Roorkee · Artificial Intelligence & Data Science',
            'about_ceo_tagline' => 'Your workflow deserves software built around it — not a template.',
            'about_story_intro_label' => 'The Narrative',
            'about_story_intro_heading' => 'Rohit Pal — From Client Projects to Pal Digital',
            'about_story_intro_text' => 'This isn\'t a corporate About page. It\'s the honest version — why I build software, what I saw over 8+ years, and why 2024 was the year I decided to help businesses properly.',
            'about_2024_heading' => 'Why 2024 Changed Everything',
            'about_2024_text' => 'For years I delivered projects alongside other work. Clients got results — but I knew we could go deeper. In 2024, I chose full-time development under Pal Digital so every business we take on gets full focus: proper discovery, real automation, and software that grows with them — not against them.',
            'about_2024_text_2' => 'Today, that means helping schools, clinics, factories, startups, and service businesses replace manual work with systems they control. In the AI era, that\'s not optional — it\'s how you stay ahead.',
            'about_why_label' => 'Our Purpose',
            'about_why_heading' => 'Why Pal Digital Exists',
            'about_why_text' => 'I started Pal Digital because I was tired of watching capable people struggle with incapable tools. Spreadsheets pretending to be ERPs. WhatsApp threads pretending to be CRMs. Software that almost works — until your business outgrows it.',
            'about_mission_text' => 'We exist to give businesses something better: custom software and automation designed around how you actually operate — so you can grow faster, make fewer mistakes, and compete in an AI-driven world without starting from scratch every year.',
            'about_pull_quote' => 'I don\'t sell software. I solve the workflow problems that keep businesses stuck.',
            'about_help_label' => 'Who We Help',
            'about_help_heading' => 'People & Businesses Ready to Move Forward',
            'about_help_text' => 'If you\'re running a school, clinic, factory, agency, or any operation that has outgrown spreadsheets — we\'re built for you. From 2024 onward, every project we take is about one thing: helping you automate, scale, and win.',
            'about_cta_heading' => 'Let\'s Write the Next Chapter — Yours',
            'about_cta_text' => 'Tell me what\'s broken in your workflow. I\'ll show you what custom software and automation can actually do for your business.',
            'about_stat_1_value' => '8+',
            'about_stat_1_label' => 'Years in the Field',
            'about_stat_2_value' => 'Multi',
            'about_stat_2_label' => 'Industries Served',
            'about_stat_3_value' => '2024',
            'about_stat_3_label' => 'Full-Time Mission',
            'about_stat_4_value' => 'AI',
            'about_stat_4_label' => 'Era Ready',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }

        SiteSetting::setJson('about_story_chapters', [
            [
                'chapter' => '01',
                'label' => 'Where It Started',
                'title' => '8+ Years Building for Real Clients',
                'body' => 'Before Pal Digital, I spent over eight years hands-on with clients — shipping ERP systems, CRM platforms, admission workflows, and custom tools across education, healthcare, operations, and more. Every project was different. Every industry had its own chaos. But one pattern kept repeating: teams were working harder than they needed to because their tools weren\'t built for them.',
            ],
            [
                'chapter' => '02',
                'label' => 'What I Kept Seeing',
                'title' => 'Businesses Deserve Better Than Workarounds',
                'body' => 'Schools running admissions on Excel. Teams coordinating on WhatsApp. Owners paying for software that almost fits — then bending their entire process to match it. I studied Artificial Intelligence and Data Science at IIT Roorkee, and that lens made it obvious: the problem wasn\'t lack of technology. It was lack of software built around how people actually work.',
            ],
            [
                'chapter' => '03',
                'label' => 'The 2024 Decision',
                'title' => 'Why I Went Full-Time',
                'body' => 'In 2024, I made a clear decision — stop treating this as side work and go all in. Pal Digital became my full-time mission: help people and businesses escape manual chaos, automate what slows them down, and build systems that scale in the AI era. Not templates. Not one-size-fits-all. Real software for real workflows.',
            ],
            [
                'chapter' => '04',
                'label' => 'Why Pal Digital',
                'title' => 'Built to Help You Grow — Not Just Go Live',
                'body' => 'Pal Digital exists because I\'ve seen what happens when the right system clicks — teams move faster, errors drop, and owners finally have visibility. We don\'t just write code. We map your process, automate the boring parts, and ship software your team will actually use. That\'s the story. That\'s why we\'re here.',
            ],
        ]);

        SiteSetting::setJson('about_timeline', [
            ['year' => '8+ Yrs', 'title' => 'Client Projects', 'description' => 'Successful delivery across education, healthcare, CRM, ERP, and custom platforms.'],
            ['year' => 'IIT', 'title' => 'AI & Data Science', 'description' => 'IIT Roorkee — foundation for building intelligent, automation-first systems.'],
            ['year' => '2024', 'title' => 'Pal Digital Full-Time', 'description' => 'Committed fully to helping businesses with custom software and automation.'],
            ['year' => 'Now', 'title' => 'Helping You Scale', 'description' => 'Partnering with businesses to grow rapidly in the AI era.'],
        ]);

        SiteSetting::setJson('about_focus_areas', [
            ['title' => 'Listen First', 'description' => 'We map your actual workflow before writing a single line of code.'],
            ['title' => 'Automate the Chaos', 'description' => 'Replace spreadsheets, manual follow-ups, and disconnected tools with one system.'],
            ['title' => 'Build for the AI Era', 'description' => 'Software that scales today and adapts as your business and technology evolve.'],
        ]);
    }

    private function seedServices(): void
    {
        $services = [
            'Custom Software Development' => [
                'Business Management Software',
                'ERP Systems',
                'Internal Tools',
                'Workflow Automation',
                'Operations Management',
            ],
            'CRM Development' => [
                'Lead Management',
                'Sales CRM',
                'Customer Support CRM',
                'Admission CRM',
                'Service CRM',
            ],
            'Web Development' => [
                'Corporate Websites',
                'Dynamic Portals',
                'Booking Systems',
                'E-commerce Platforms',
                'Membership Websites',
            ],
            'Mobile Applications' => [
                'Android Apps',
                'iOS Apps',
                'Customer Portals',
                'Employee Applications',
            ],
            'Business Automation' => [
                'WhatsApp Automation',
                'Reporting Systems',
                'Process Automation',
                'Data Management',
            ],
        ];

        $order = 0;
        foreach ($services as $category => $items) {
            foreach ($items as $title) {
                $slug = \Illuminate\Support\Str::slug($title);
                Service::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'category' => $category,
                        'title' => $title,
                        'sort_order' => $order++,
                        'is_active' => true,
                    ]
                );
            }
        }
    }

    private function seedIndustries(): void
    {
        $industries = [
            ['title' => 'Education', 'subtitle' => 'Schools, Colleges, Coaching Institutes', 'icon' => 'academic-cap'],
            ['title' => 'Healthcare', 'subtitle' => 'Hospitals, Clinics, Diagnostic Centers', 'icon' => 'heart'],
            ['title' => 'Real Estate', 'subtitle' => 'Builders, Property Dealers, Housing Projects', 'icon' => 'building'],
            ['title' => 'Manufacturing', 'subtitle' => 'Inventory, Production, Employee Management', 'icon' => 'cog'],
            ['title' => 'Travel & Tourism', 'subtitle' => 'Booking, Customer Management, Operations', 'icon' => 'globe'],
            ['title' => 'Service Businesses', 'subtitle' => 'Customer Management and Workflow Tracking', 'icon' => 'briefcase'],
            ['title' => 'NGOs & Organizations', 'subtitle' => 'Member and Donation Management', 'icon' => 'users'],
            ['title' => 'Custom Requirements', 'subtitle' => 'Any industry, any workflow', 'icon' => 'sparkles'],
        ];

        foreach ($industries as $i => $industry) {
            Industry::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($industry['title'])],
                [
                    ...$industry,
                    'sort_order' => $i,
                    'is_active' => true,
                ]
            );
        }
    }

    private function seedSolutions(): void
    {
        Solution::updateOrCreate(
            ['slug' => 'education-erp-admission-crm'],
            [
                'title' => 'Education ERP & Admission CRM',
            'description' => 'Our most mature and successful implementation — a complete platform for educational institutions with admission management, student lifecycle, and marketing CRM.',
            'features' => [
                'Admission Management',
                'Visitor Tracking',
                'Student Management',
                'Attendance',
                'Fee Management',
                'Homework',
                'Examination',
                'Results',
                'Marketing Team CRM',
                'Student Portal',
                'Unified Search System',
            ],
            'is_flagship' => true,
            'sort_order' => 0,
                'is_active' => true,
            ]
        );
    }

    private function seedSeo(): void
    {
        $pages = [
            'home' => [
                'title' => 'Pal Digital | Custom Software, CRM & Automation Solutions',
                'description' => 'Pal Digital builds custom software for any industry. ERP, CRM, web apps, mobile apps, and automation tailored to your business workflow.',
                'keywords' => 'custom software, ERP, CRM, web development, mobile apps, automation, India',
            ],
            'about' => [
                'title' => 'Rohit Pal | Developer & CEO, Pal Digital | IIT Roorkee',
                'description' => 'Rohit Pal is Developer & CEO of Pal Digital — IIT Roorkee (AI & Data Science). 8+ years in custom software, ERP, CRM, automation, and AI-ready solutions for businesses across India.',
                'keywords' => 'Rohit Pal, Pal Digital, Rohit Pal developer, IIT Roorkee, custom software developer, AI, automation, CEO India',
            ],
            'services' => [
                'title' => 'Our Services | Custom Software Development',
                'description' => 'Custom software development, CRM, ERP, web development, mobile apps, and business automation services.',
            ],
            'industries' => [
                'title' => 'Industries We Serve | Custom Software for Every Sector',
                'description' => 'Custom software for education, healthcare, real estate, manufacturing, travel, NGOs, and more.',
            ],
            'solutions' => [
                'title' => 'Software Solutions | ERP, CRM & Custom Platforms',
                'description' => 'Explore Pal Digital solutions including Education ERP, CRM platforms, and industry-specific software.',
            ],
            'portfolio' => [
                'title' => 'Portfolio | Custom Software Projects by Pal Digital',
                'description' => 'See custom software projects delivered by Pal Digital across multiple industries.',
            ],
            'case-studies' => [
                'title' => 'Case Studies | Pal Digital Success Stories',
                'description' => 'Read how Pal Digital helped businesses transform operations with custom software.',
            ],
            'blog' => [
                'title' => 'Blog | Software, Automation & Digital Insights',
                'description' => 'Insights on custom software development, CRM, ERP, automation, and digital transformation.',
            ],
            'contact' => [
                'title' => 'Contact Pal Digital | Book Free Consultation',
                'description' => 'Get in touch with Pal Digital for a free consultation, demo, or project discussion.',
            ],
        ];

        foreach ($pages as $page => $meta) {
            SeoMeta::updateOrCreate(['page' => $page], $meta);
        }
    }

    private function seedTestimonials(): void
    {
        $items = [
            [
                'name' => 'Principal, ABC School',
                'role' => 'Principal',
                'company' => 'ABC International School',
                'content' => 'Pal Digital built a complete ERP for our school. Admission, fees, attendance — everything in one system. Highly recommended.',
                'rating' => 5,
                'sort_order' => 0,
            ],
            [
                'name' => 'Director, XYZ Coaching',
                'role' => 'Director',
                'company' => 'XYZ Coaching Institute',
                'content' => 'The admission CRM transformed our marketing team workflow. Lead tracking and follow-ups are now seamless.',
                'rating' => 5,
                'sort_order' => 1,
            ],
        ];

        foreach ($items as $item) {
            Testimonial::updateOrCreate(
                ['name' => $item['name']],
                [...$item, 'is_active' => true]
            );
        }
    }

    private function seedPortfolio(): void
    {
        Portfolio::updateOrCreate(
            ['slug' => 'education-erp-admission-crm'],
            [
                'title' => 'Education ERP & Admission CRM',
                'description' => 'Full-stack education management platform with admission workflow, student portal, fee management, and marketing CRM.',
                'client' => 'Educational Institutions',
                'industry' => 'Education',
                'sort_order' => 0,
                'is_active' => true,
            ]
        );
    }
}
