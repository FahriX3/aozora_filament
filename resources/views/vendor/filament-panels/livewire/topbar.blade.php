<div class="fi-topbar-ctn">
    <header class="fixed top-0 lg:left-72 left-0 right-0 h-20 bg-surface-container-lowest/90 backdrop-blur-xl z-40 flex items-center justify-between px-space-md lg:px-space-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
        <div class="flex items-center gap-4">
            <!-- Mobile menu button -->
            <button x-data="{}" x-on:click="$store.sidebar.open()" class="lg:hidden text-on-surface hover:text-primary">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <div class="hidden lg:flex items-center gap-2 bg-surface-container-low px-3 py-1.5 rounded-full">
                <span class="material-symbols-outlined text-[18px] text-aozora-sky">school</span>
                <span class="font-label-md text-label-md text-on-surface font-semibold">SMKN 1 Purwokerto</span>
                <span class="text-outline-variant font-body-sm text-body-sm">•</span>
                <span class="font-label-md text-label-md text-primary font-bold">Admin Gate</span>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="relative hidden sm:flex items-center">
                <input type="text" placeholder="Cari agenda, peserta..." class="w-64 pl-10 pr-4 py-2 rounded-xl bg-surface-container-low text-on-surface placeholder:text-outline font-body-sm text-body-sm focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary/20 transition-all">
                <span class="material-symbols-outlined absolute left-3 text-outline text-[20px]">search</span>
            </div>
            <button class="relative w-10 h-10 rounded-xl bg-surface-container-low hover:bg-surface-container text-on-surface flex items-center justify-center transition-colors">
                <span class="material-symbols-outlined text-[20px]">notifications</span>
            </button>
            <div class="h-8 w-[1px] bg-surface-container-high hidden sm:block"></div>
            <div class="flex items-center gap-3 pl-1">
                <div class="hidden sm:flex flex-col text-right">
                    <span class="font-label-lg text-label-lg text-on-surface font-bold">{{ auth()->user()->name ?? 'Admin' }}</span>
                    <span class="font-label-badge text-label-badge text-torii-vermilion uppercase font-semibold">Pembina Utama</span>
                </div>
                
                @if(filament()->hasUserMenu())
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center overflow-hidden cursor-pointer">
                        <x-filament-panels::user-menu />
                    </div>
                @else
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
                    </div>
                @endif
            </div>
        </div>
    </header>
    <x-filament-actions::modals />
</div>
