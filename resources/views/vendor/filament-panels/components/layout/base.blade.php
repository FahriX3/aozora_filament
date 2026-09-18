@props([
    'livewire' => null,
])

@php
    use Filament\Livewire\Notifications;
    use Filament\Support\Facades\FilamentView;
    use Filament\View\PanelsRenderHook;

    $renderHookScopes = $livewire?->getRenderHookScopes();
@endphp

<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}"
    @class([
        'fi',
        'dark' => filament()->hasDarkMode() && filament()->hasDarkModeForced(),
    ])
>
    <head>
        {{ FilamentView::renderHook(PanelsRenderHook::HEAD_START, scopes: $renderHookScopes) }}

        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        @if ($favicon = filament()->getFavicon())
            <link rel="icon" href="{{ $favicon }}" />
        @endif

        @php
            $title = trim(strip_tags($livewire?->getTitle() ?? ''));
            $brandName = trim(strip_tags(filament()->getBrandName()));
        @endphp

        <title>
            {{ filled($title) ? $title : null }}
            {{ filled($brandName) && filled($title) ? ' - ' : null }}
            {{ filled($brandName) ? $brandName : null }}
        </title>

        {{ FilamentView::renderHook(PanelsRenderHook::STYLES_BEFORE, scopes: $renderHookScopes) }}

        <style>
            [x-cloak=''],
            [x-cloak='x-cloak'],
            [x-cloak='1'] {
                display: none !important;
            }

            [x-cloak='inline-flex'] {
                display: inline-flex !important;
            }

            @media (max-width: 1023px) {
                [x-cloak='-lg'] {
                    display: none !important;
                }
            }

            @media (min-width: 1024px) {
                [x-cloak='lg'] {
                    display: none !important;
                }
            }
        </style>

        @filamentStyles

        <!-- Injected Custom Fonts from Aozora Admin Portal -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
        
        <script src="https://cdn.tailwindcss.com"></script>
        <script id="tailwind-config">
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        colors: {
                            primary: "#0043c0", "inverse-primary": "#b5c4ff", "on-tertiary-fixed": "#410001", "gold-shrine": "#F59E0B",
                            "outline-variant": "#c3c5d8", outline: "#737687", "on-primary-fixed": "#00164e", "surface-container-highest": "#dfe3e8",
                            surface: "#f6f9fe", "on-secondary-container": "#5f637a", "cloud-white": "#FFFFFF", error: "#ba1a1a",
                            "secondary-fixed": "#dde1fc", secondary: "#595d74", background: "#f6f9fe", "primary-fixed": "#dce1ff",
                            "inverse-surface": "#2d3135", "surface-container-low": "#f1f4f9", "on-secondary-fixed": "#161b2e",
                            "aozora-sky": "#38BDF8", "on-secondary-fixed-variant": "#41465b", "primary-fixed-dim": "#b5c4ff",
                            "on-tertiary-container": "#ffe0dc", "on-surface-variant": "#434655", "surface-tint": "#0050e2",
                            "on-background": "#181c20", "tertiary-fixed": "#ffdad5", "on-tertiary-fixed-variant": "#930007",
                            "error-container": "#ffdad6", "on-primary": "#ffffff", "surface-variant": "#dfe3e8", "surface-dim": "#d7dadf",
                            "torii-vermilion": "#E83A30", "tertiary-fixed-dim": "#ffb4aa", "tertiary-container": "#c9221d",
                            "on-primary-fixed-variant": "#003cad", "indigo-night": "#0B1021", "secondary-container": "#dde1fc",
                            "on-error": "#ffffff", "inverse-on-surface": "#eef1f6", tertiary: "#a40009", "surface-container": "#ebeef3",
                            "surface-bright": "#f6f9fe", "surface-container-high": "#e5e8ed", "on-error-container": "#93000a",
                            "on-tertiary": "#ffffff", "surface-container-lowest": "#ffffff", "primary-container": "#0d59f2",
                            "on-secondary": "#ffffff", "on-primary-container": "#e2e6ff", "on-surface": "#181c20",
                            "sakura-tint": "#FDE8E8", "secondary-fixed-dim": "#c1c5df"
                        },
                        spacing: {
                            "space-md": "1rem", "space-xs": "0.25rem", margin: "3rem", "space-sm": "0.5rem", "space-lg": "1.5rem",
                            "space-2xl": "4rem", "margin-mobile": "1.25rem", "space-xl": "2.5rem", gutter: "1.5rem", "gutter-mobile": "0.875rem"
                        },
                        fontFamily: {
                            "body-md": ["Be Vietnam Pro"], "label-lg": ["Space Grotesk"], "headline-lg": ["Plus Jakarta Sans"],
                            "headline-md": ["Plus Jakarta Sans"], "label-badge": ["Space Grotesk"], "display-hero-mobile": ["Plus Jakarta Sans"],
                            "label-md": ["Space Grotesk"], "body-sm": ["Be Vietnam Pro"], "display-hero": ["Plus Jakarta Sans"],
                            "headline-lg-mobile": ["Plus Jakarta Sans"], "body-lg": ["Be Vietnam Pro"], "headline-sm": ["Plus Jakarta Sans"]
                        },
                        fontSize: {
                            "label-badge": ["0.625rem", { lineHeight: "1rem", letterSpacing: "0.05em" }],
                            "label-md": ["0.875rem", { lineHeight: "1.25rem", letterSpacing: "0.01em" }],
                            "label-lg": ["1rem", { lineHeight: "1.5rem", letterSpacing: "0.01em" }],
                            "body-sm": ["0.875rem", { lineHeight: "1.25rem" }],
                            "body-md": ["1rem", { lineHeight: "1.5rem" }],
                            "body-lg": ["1.125rem", { lineHeight: "1.75rem" }],
                            "headline-sm": ["1.25rem", { lineHeight: "1.75rem", letterSpacing: "-0.01em" }],
                            "headline-md": ["1.75rem", { lineHeight: "2.25rem", letterSpacing: "-0.02em" }],
                            "headline-lg": ["2.25rem", { lineHeight: "2.75rem", letterSpacing: "-0.02em" }],
                            "display-hero": ["3.5rem", { lineHeight: "4rem", letterSpacing: "-0.02em" }],
                        }
                    }
                }
            };
        </script>

        {{ filament()->getTheme()->getHtml() }}
        {{ filament()->getFontPreloadHtml() }}
        {{ filament()->getMonoFontPreloadHtml() }}
        {{ filament()->getSerifFontPreloadHtml() }}
        {{ filament()->getFontHtml() }}
        {{ filament()->getMonoFontHtml() }}
        {{ filament()->getSerifFontHtml() }}

        <style>
            :root {
                --font-family: 'Be Vietnam Pro', sans-serif;
                --mono-font-family: '{!! filament()->getMonoFontFamily() !!}';
                --serif-font-family: '{!! filament()->getSerifFontFamily() !!}';
                --sidebar-width: {{ filament()->getSidebarWidth() }};
                --collapsed-sidebar-width: {{ filament()->getCollapsedSidebarWidth() }};
                --default-theme-mode: {{ filament()->getDefaultThemeMode()->value }};
            }

            html.fi {
                --livewire-progress-bar-color: var(--primary-500);
            }
            
            /* Hide Filament's default topbar since we have our own */
            .fi-topbar {
                display: none !important;
            }
            .fi-main-ctn {
                padding-top: 0 !important;
            }
        </style>

        @stack('styles')

        {{ FilamentView::renderHook(PanelsRenderHook::STYLES_AFTER, scopes: $renderHookScopes) }}

        @if (! filament()->hasDarkMode())
            <script>
                localStorage.setItem('theme', 'light')
            </script>
        @elseif (filament()->hasDarkModeForced())
            <script>
                localStorage.setItem('theme', 'dark')
            </script>
        @else
            <script>
                const loadDarkMode = () => {
                    window.theme = localStorage.getItem('theme') ?? @js(filament()->getDefaultThemeMode()->value)

                    if (
                        window.theme === 'dark' ||
                        (window.theme === 'system' &&
                            window.matchMedia('(prefers-color-scheme: dark)')
                                .matches)
                    ) {
                        document.documentElement.classList.add('dark')
                    }
                }

                loadDarkMode()

                document.addEventListener('livewire:navigated', loadDarkMode)
            </script>
        @endif

        {{ FilamentView::renderHook(PanelsRenderHook::HEAD_END, scopes: $renderHookScopes) }}
    </head>

    <body
        {{
            $attributes
                ->merge($livewire?->getExtraBodyAttributes() ?? [], escape: false)
                ->class([
                    'fi-body bg-background font-body-md text-body-md text-on-surface',
                    'fi-panel-' . filament()->getId(),
                ])
        }}
    >
        {{ FilamentView::renderHook(PanelsRenderHook::BODY_START, scopes: $renderHookScopes) }}

        {{ $slot }}

        @livewire(Notifications::class)

        {{ FilamentView::renderHook(PanelsRenderHook::SCRIPTS_BEFORE, scopes: $renderHookScopes) }}

        @filamentScripts(withCore: true)

        @if (filament()->hasBroadcasting() && config('filament.broadcasting.echo'))
            <script data-navigate-once>
                window.Echo = new window.EchoFactory(@js(config('filament.broadcasting.echo')))

                window.dispatchEvent(new CustomEvent('EchoLoaded'))
            </script>
        @endif

        @if (filament()->hasDarkMode() && (! filament()->hasDarkModeForced()))
            <script>
                loadDarkMode()
            </script>
        @endif

        @stack('scripts')

        {{ FilamentView::renderHook(PanelsRenderHook::SCRIPTS_AFTER, scopes: $renderHookScopes) }}

        {{ FilamentView::renderHook(PanelsRenderHook::BODY_END, scopes: $renderHookScopes) }}
    </body>
</html>
