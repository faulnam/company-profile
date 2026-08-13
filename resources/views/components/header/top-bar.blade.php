<div class="bg-school-darker border-b border-black/10">
    <div class="max-w-7xl mx-auto text-gray-200 text-[11px] py-1.5 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
    <div class="flex items-center space-x-4">
        <span class="flex items-center hover:text-white transition cursor-default">
            <span x-data="{ 
                datetime: '',
                updateTime() {
                    const now = new Date();
                    const dateOpts = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    const timeOpts = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
                    this.datetime = now.toLocaleDateString('id-ID', dateOpts) + ' | ' + now.toLocaleTimeString('id-ID', timeOpts).replace(/\./g, ':');
                }
            }" x-init="updateTime(); setInterval(() => updateTime(), 1000)" x-text="datetime"></span>
        </span>
    </div>
    <div class="flex items-center space-x-3 mt-2 md:mt-0">
        <a href="#" class="w-6 h-6 rounded flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white transition"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#" class="w-6 h-6 rounded flex items-center justify-center bg-pink-600 hover:bg-pink-700 text-white transition"><i class="fa-brands fa-instagram"></i></a>
        <a href="#" class="w-6 h-6 rounded flex items-center justify-center bg-red-600 hover:bg-red-700 text-white transition"><i class="fa-brands fa-youtube"></i></a>
    </div>
    </div>
</div>
