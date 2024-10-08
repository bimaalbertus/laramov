<div
    class="fixed left-5 top-1/4 translate-y-1/4 z-50 hidden md:flex md:flex-col md:items-center md:gap-5 md:rounded-full md:border md:border-slate-600 glass">
    <nav class="flex items-center flex-col p-3.5 gap-5">
        <div class="flex items-center flex-col gap-4 text-2xl font-thin">
            <a href="/" class="{{ Request::is('/') ? 'active py-2 px-3' : '' }}">
                <i class="ti ti-home"></i>
            </a>
            <a href="/search" class="{{ Request::is('/search') ? 'active py-2 px-3' : '' }}">
                <i class="ti ti-search"></i>
            </a>
            <a href="/favorites" class="{{ Request::is('/favorites') ? 'active py-2 px-3' : '' }}">
                <i class="ti ti-star"></i>
            </a>
            <a href="/watch-later" class="{{ Request::is('/watch-later') ? 'active py-2 px-3' : '' }}">
                <i class="ti ti-clock"></i>
            </a>
        </div>
        <div class="border-t w-10"></div>
        <div class="flex flex-col gap-4 text-2xl font-thin">
            <a href="/settings">
                <i class="ti ti-settings"></i>
            </a>
            <a href="/info">
                <i class="ti ti-info-circle"></i>
            </a>
        </div>
    </nav>
</div>

<!-- Bottom Bar untuk Mobile -->
<div id="bottom-nav"
    class="fixed bottom-0 left-0 right-0 z-50 md:hidden flex justify-center transition-transform duration-300">
    <nav class="flex items-center flex-row p-3.5 rounded-full border border-slate-600 glass gap-5 mb-4">
        <div class="flex items-center flex-row gap-4 text-2xl font-thin">
            <a href="/" class="{{ Request::is('/') ? 'active py-2 px-3' : '' }}">
                <i class="ti ti-home"></i>
            </a>
            <a href="/search" class="{{ Request::is('/search') ? 'active py-2 px-3' : '' }}">
                <i class="ti ti-search"></i>
            </a>
            <a href="/favorites" class="{{ Request::is('/request') ? 'active py-2 px-3' : '' }}">
                <i class="ti ti-star"></i>
            </a>
            <a href="/likes" class="{{ Request::is('/likes') ? 'active py-2 px-3' : '' }}">
                <i class="ti ti-heart"></i>
            </a>
        </div>
        <div class="horizontal-line h-10"></div>
        <div class="flex flex-row gap-4 text-2xl font-thin">
            <a href="/settings">
                <i class="ti ti-settings"></i>
            </a>
            <a href="/info">
                <i class="ti ti-info-circle"></i>
            </a>
        </div>
    </nav>
</div>

<script>
    let lastScrollY = 0;
    const sidebar = document.getElementById('bottom-nav');

    const controlSidebar = () => {
        const scrollY = window.scrollY;

        if (scrollY > 50) {
            if (scrollY > lastScrollY) {
                sidebar.style.transform = 'translateY(100%)';
            } else {
                sidebar.style.transform = 'translateY(0)';
            }
        } else {
            sidebar.style.transform = 'translateY(0)';
        }

        lastScrollY = scrollY;
    };

    window.addEventListener('scroll', controlSidebar);
</script>
