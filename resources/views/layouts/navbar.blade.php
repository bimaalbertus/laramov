<div class="flex justify-center font-sf-pro-display">
    <nav class="flex items-center py-2.5 px-3 fixed top-5 rounded-full z-50 border border-slate-600 gap-10 glass">
        <div class="flex gap-4 mr-8">
            <a @click.prevent="activeTab = 'movies'" :class="activeTab === 'movies' ? activeClasses : inactiveClasses"
                href="#">
                Movies
            </a>
            <a @click.prevent="activeTab = 'genres'" :class="activeTab === 'genres' ? activeClasses : inactiveClasses"
                href="#">
                Genres
            </a>
            <a @click.prevent="activeTab = 'series'" :class="activeTab === 'series' ? activeClasses : inactiveClasses"
                href="#">
                TV-Series
            </a>
        </div>
        <div class="flex items-center gap-5 text-xl">
            <x-theme-toggle />
            <i class="ti ti-bell"></i>
        </div>
        <div class="horizontal-line h-10"></div>
        <div class="flex items-center gap-2 mr-3">
            <img src="https://legendary-digital-network-assets.s3.amazonaws.com/wp-content/uploads/2024/07/29151704/Doctor-Doom-with-energy-fist.jpg"
                alt="user-name" class="w-10 h-10 object-cover rounded-full" />
            <span class="username">Victor Von Doom</span>
        </div>
    </nav>
</div>
