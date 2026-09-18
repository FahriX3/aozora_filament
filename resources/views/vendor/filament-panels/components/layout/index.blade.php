@php
    use Filament\Support\Enums\Width;
    use Filament\Support\Facades\FilamentView;
    use Filament\Support\Icons\Heroicon;
    use Filament\View\PanelsIconAlias;
    use Filament\View\PanelsRenderHook;

    $livewire ??= null;

    $hasTopbar = filament()->hasTopbar();
    $isSidebarCollapsibleOnDesktop = filament()->isSidebarCollapsibleOnDesktop();
    $isSidebarFullyCollapsibleOnDesktop = filament()->isSidebarFullyCollapsibleOnDesktop();
    $hasTopNavigation = filament()->hasTopNavigation();
    $hasNavigation = filament()->hasNavigation();
    $renderHookScopes = $livewire?->getRenderHookScopes();
    $maxContentWidth ??= (filament()->getMaxContentWidth() ?? Width::SevenExtraLarge);

    if (is_string($maxContentWidth)) {
        $maxContentWidth = Width::tryFrom($maxContentWidth) ?? $maxContentWidth;
    }
@endphp

<x-filament-panels::layout.base
    :livewire="$livewire"
    @class([
        'fi-body-has-navigation' => $hasNavigation,
        'fi-body-has-sidebar-collapsible-on-desktop' => $isSidebarCollapsibleOnDesktop,
        'fi-body-has-sidebar-fully-collapsible-on-desktop' => $isSidebarFullyCollapsibleOnDesktop,
        'fi-body-has-topbar' => $hasTopbar,
        'fi-body-has-top-navigation' => $hasTopNavigation,
    ])
>
    <a href="#fi-main-content" class="fi-skip-link fi-sr-only">
        {{ __('filament-panels::layout.skip_to_content.label') }}
    </a>

    @if ($hasTopbar)
        {{ FilamentView::renderHook(PanelsRenderHook::TOPBAR_BEFORE, scopes: $renderHookScopes) }}

        @livewire(filament()->getTopbarLivewireComponent())

        {{ FilamentView::renderHook(PanelsRenderHook::TOPBAR_AFTER, scopes: $renderHookScopes) }}
    @elseif ($hasNavigation)
        <div
            @if ($isSidebarFullyCollapsibleOnDesktop)
                x-data="{}"
                x-bind:class="{ 'lg:fi-hidden': $store.sidebar.isOpen }"
            @endif
            @class([
                'fi-layout-sidebar-toggle-btn-ctn',
                'lg:fi-hidden' => ! $isSidebarFullyCollapsibleOnDesktop,
            ])
        >
            <x-filament::icon-button
                color="gray"
                :icon="Heroicon::OutlinedBars3"
                :icon-alias="PanelsIconAlias::SIDEBAR_EXPAND_BUTTON"
                icon-size="lg"
                :label="__('filament-panels::layout.actions.sidebar.expand.label')"
                x-cloak
                x-data="{}"
                aria-controls="fi-main-sidebar"
                x-bind:aria-expanded="$store.sidebar.isOpen"
                x-on:click="$store.sidebar.open()"
                class="fi-layout-sidebar-toggle-btn"
            />
        </div>
    @endif

    <div class="fi-layout">
        {{ FilamentView::renderHook(PanelsRenderHook::LAYOUT_START, scopes: $renderHookScopes) }}

        @if ($hasNavigation)
            <div
                x-cloak
                x-data="{}"
                x-on:click="$store.sidebar.close()"
                x-show="$store.sidebar.isOpen"
                x-transition.opacity.300ms
                class="fi-sidebar-close-overlay"
            ></div>

            @livewire(filament()->getSidebarLivewireComponent())
        @endif

        <div
            @if ($isSidebarCollapsibleOnDesktop)
                x-data="{}"
                x-bind:class="{
                    'lg:pl-72': $store.sidebar.isOpen,
                    'lg:pl-0': !$store.sidebar.isOpen
                }"
            @elseif ($isSidebarFullyCollapsibleOnDesktop)
                x-data="{}"
                x-bind:class="{
                    'lg:pl-72': $store.sidebar.isOpen,
                    'lg:pl-0': !$store.sidebar.isOpen
                }"
            @endif
            @class([
                'pt-20 min-h-screen bg-background w-full transition-all duration-300',
                'lg:pl-72' => !($isSidebarCollapsibleOnDesktop || $isSidebarFullyCollapsibleOnDesktop),
            ])
        >
            {{ FilamentView::renderHook(PanelsRenderHook::CONTENT_BEFORE, scopes: $renderHookScopes) }}

            <main
                id="fi-main-content"
                tabindex="-1"
                class="max-w-7xl mx-auto p-space-md lg:p-space-xl pb-32"
            >
                {{ FilamentView::renderHook(PanelsRenderHook::CONTENT_START, scopes: $renderHookScopes) }}

                {{ $slot }}

                {{ FilamentView::renderHook(PanelsRenderHook::CONTENT_END, scopes: $renderHookScopes) }}
            </main>

            {{ FilamentView::renderHook(PanelsRenderHook::CONTENT_AFTER, scopes: $renderHookScopes) }}

            {{ FilamentView::renderHook(PanelsRenderHook::FOOTER, scopes: $renderHookScopes) }}
        </div>

        {{ FilamentView::renderHook(PanelsRenderHook::LAYOUT_END, scopes: $renderHookScopes) }}
    </div>
</x-filament-panels::layout.base>
