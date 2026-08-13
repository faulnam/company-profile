<div class="bg-gray-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto flex items-center text-xs overflow-hidden h-10">
        <div class="bg-school text-white font-bold px-4 h-full flex items-center uppercase tracking-wider flex-shrink-0 relative">
            Berita Terbaru
            <!-- Triangle pointer -->
            <div class="absolute right-[-10px] top-0 w-0 h-0 border-t-[20px] border-t-transparent border-l-[10px] border-l-school border-b-[20px] border-b-transparent z-10"></div>
        </div>
        <!-- Ticker area -->
        <div class="flex-grow overflow-hidden relative h-full flex items-center bg-gray-50 ticker-container">
            <div class="ticker-content flex space-x-8 whitespace-nowrap text-gray-700 font-semibold items-center h-full text-[11px] sm:text-xs">
                @foreach($latest_news_marquee as $news)
                    <a href="{{ route('berita.show', $news->slug) }}" class="hover:text-school transition">&bull; {{ $news->title }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
<style>
.ticker-container {
    mask-image: linear-gradient(to right, transparent, black 10px, black calc(100% - 10px), transparent);
    -webkit-mask-image: linear-gradient(to right, transparent, black 10px, black calc(100% - 10px), transparent);
}
.ticker-content {
    display: inline-flex;
    padding-left: 100%; /* Start from outside the right edge */
    animation: ticker 25s linear infinite;
}
.ticker-content:hover {
    animation-play-state: paused;
}
@keyframes ticker {
    0% { transform: translate3d(0, 0, 0); }
    100% { transform: translate3d(-100%, 0, 0); }
}
</style>
