<div class="bg-white" x-data="{
    date: new Date(),
    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    get year() { return this.date.getFullYear(); },
    get month() { return this.date.getMonth(); },
    get daysInMonth() { return new Date(this.year, this.month + 1, 0).getDate(); },
    get blankDays() { 
        let dayOfWeek = new Date(this.year, this.month, 1).getDay();
        return (dayOfWeek + 6) % 7; 
    },
    get days() {
        let daysArray = [];
        for (let i = 1; i <= this.daysInMonth; i++) {
            daysArray.push(i);
        }
        return daysArray;
    },
    get currentMonthName() { return this.monthNames[this.month]; },
    get prevMonthName() { 
        let prev = new Date(this.year, this.month - 1, 1);
        return prev.toLocaleDateString('en-US', { month: 'short' });
    },
    get nextMonthName() { 
        let next = new Date(this.year, this.month + 1, 1);
        return next.toLocaleDateString('en-US', { month: 'short' });
    },
    prevMonth() {
        this.date = new Date(this.year, this.month - 1, 1);
    },
    nextMonth() {
        this.date = new Date(this.year, this.month + 1, 1);
    },
    isToday(day) {
        const today = new Date();
        return day === today.getDate() && this.month === today.getMonth() && this.year === today.getFullYear();
    }
}">
    <!-- Header KALENDER -->
    <div class="border-b border-[#0f766e] mb-4 relative">
        <div class="bg-[#0f766e] text-white font-bold px-4 py-2 uppercase tracking-widest text-sm inline-block" style="clip-path: polygon(0 0, calc(100% - 15px) 0, 100% 100%, 0 100%); padding-right: 30px;">
            Kalender
        </div>
    </div>

    <!-- Calendar Container -->
    <div class="bg-gray-50 p-4 border border-gray-100 shadow-sm">
        
        <!-- Month Year Display -->
        <div class="bg-gray-200 border border-gray-400 text-center py-2 text-sm text-gray-800 mb-2 font-medium">
            <span x-text="currentMonthName + ' ' + year"></span>
        </div>

        <!-- Table -->
        <div class="border-t border-l border-gray-200 bg-white">
            <!-- Headers -->
            <div class="grid grid-cols-7 text-center font-bold text-[#001f3f] text-xs">
                <template x-for="day in ['M', 'T', 'W', 'T', 'F', 'S', 'S']">
                    <div class="py-2 border-b border-r border-gray-200 bg-gray-50" x-text="day"></div>
                </template>
            </div>
            
            <!-- Grid Days -->
            <div class="grid grid-cols-7 text-center text-sm text-gray-700">
                <!-- Blank Days -->
                <template x-for="blank in blankDays">
                    <div class="py-2 border-b border-r border-gray-200"></div>
                </template>
                
                <!-- Actual Days -->
                <template x-for="day in days">
                    <div class="py-2 border-b border-r border-gray-200 flex items-center justify-center">
                        <span x-text="day" 
                              :class="{'text-[#0d9488] font-bold': isToday(day), 'text-gray-800': !isToday(day)}">
                        </span>
                    </div>
                </template>

                <!-- Filler Blank Days to complete row if needed -->
                <template x-for="filler in (7 - ((blankDays + daysInMonth) % 7)) % 7">
                    <div class="py-2 border-b border-r border-gray-200"></div>
                </template>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4 flex justify-between text-[#0d9488] text-sm">
            <button @click="prevMonth" class="hover:underline flex items-center">
                &laquo; <span x-text="prevMonthName" class="ml-1"></span>
            </button>
            <button @click="nextMonth" class="hover:underline flex items-center">
                <span x-text="nextMonthName" class="mr-1"></span> &raquo;
            </button>
        </div>
    </div>
</div>
