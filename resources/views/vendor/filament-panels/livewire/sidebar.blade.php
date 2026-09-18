<div>
    <aside
        x-data="{}"
        @if (filament()->isSidebarCollapsibleOnDesktop() || filament()->isSidebarFullyCollapsibleOnDesktop())
            x-cloak
        @else
            x-cloak="-lg"
        @endif
        x-bind:class="{ 'translate-x-0': $store.sidebar.isOpen, '-translate-x-full': !$store.sidebar.isOpen }"
        class="fixed left-0 top-0 h-full w-72 bg-surface-container-lowest z-50 flex flex-col justify-between shadow-[0_4px_24px_-4px_rgba(13,89,242,0.08)] transition-transform duration-300 lg:translate-x-0"
    >
        <div class="flex flex-col h-full">
            <div class="h-20 px-space-lg flex items-center justify-between bg-surface-container-low/50 shrink-0">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 shrink-0 rounded-xl bg-primary flex items-center justify-center shadow-[0_4px_14px_rgba(13,89,242,0.3)]">
                        <span class="material-symbols-outlined text-on-primary text-[22px]">cyclone</span>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <div class="flex items-center gap-1.5 whitespace-nowrap">
                            <span class="font-headline-sm text-headline-sm font-bold tracking-tight text-on-surface">青空</span>
                            <span class="font-headline-sm text-headline-sm font-bold tracking-tight text-primary">AOZORA</span>
                        </div>
                        <span class="font-label-badge text-[10px] text-outline uppercase whitespace-nowrap truncate">SMKN 1 Purwokerto</span>
                    </div>
                </div>
                <span class="font-label-badge text-[10px] shrink-0 bg-sakura-tint text-torii-vermilion px-2 py-0.5 rounded-full font-bold">部活</span>
            </div>
            
            <button x-on:click="$store.sidebar.close()" class="lg:hidden absolute top-4 right-4 text-on-surface">
                <span class="material-symbols-outlined">close</span>
            </button>

            <div class="px-space-lg pt-space-md pb-space-xs">
                <span class="font-label-badge text-label-badge text-outline uppercase tracking-wider">Navigasi Portal</span>
            </div>
            <nav class="flex flex-col gap-1.5 px-space-md">
                <a href="{{ \Filament\Pages\Dashboard::getUrl() }}" wire:navigate class="flex items-center gap-3 px-space-md py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('filament.admin.pages.dashboard') ? 'bg-primary text-on-primary font-bold shadow-[0_8px_20px_-4px_rgba(13,89,242,0.35)]' : 'text-on-surface-variant font-label-lg text-label-lg hover:bg-surface-container hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">space_dashboard</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ App\Filament\Resources\Events\EventResource::getUrl() }}" wire:navigate class="flex items-center gap-3 px-space-md py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('filament.admin.resources.events.*') ? 'bg-primary text-on-primary font-bold shadow-[0_8px_20px_-4px_rgba(13,89,242,0.35)]' : 'text-on-surface-variant font-label-lg text-label-lg hover:bg-surface-container hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">celebration</span>
                    <span>Manajemen Event</span>
                </a>
                <a href="/" class="flex items-center gap-3 px-space-md py-3 rounded-lg text-on-surface-variant font-label-lg text-label-lg hover:bg-surface-container hover:text-on-surface transition-all duration-200">
                    <span class="material-symbols-outlined text-[20px]">public</span>
                    <span>Ke Web Utama</span>
                </a>
            </nav>
        </div>
        <div class="p-space-md">
            <div class="p-space-md rounded-xl bg-surface-container-low flex flex-col gap-2 relative overflow-hidden">
                <div class="flex items-center justify-between">
                    <span class="font-label-badge text-label-badge text-primary uppercase font-bold">Status Server</span>
                    <span class="flex h-2 w-2 rounded-full bg-aozora-sky animate-pulse"></span>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Sistem aktif: Bunkasai 2026 Sync Online</p>
                <span class="font-label-badge text-label-badge text-outline">v2.4.1 Anime-HUD Engine</span>
            </div>
        </div>
    </aside>
    <x-filament-actions::modals />
</div>
