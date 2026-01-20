<div id="promo-popup" class="fixed inset-0 z-[9999] hidden flex items-center justify-center bg-black/90 backdrop-blur-sm transition-opacity duration-300 opacity-0">
    <div class="relative w-[95%] md:w-[90%] max-w-7xl transform scale-95 transition-transform duration-300" id="popup-content">
        
        <button onclick="closePopup()" class="absolute -top-3 -right-3 md:-top-6 md:-right-6 bg-white text-red-600 rounded-full p-2 shadow-xl hover:bg-red-50 hover:scale-110 transition-all z-50 border-2 border-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="bg-transparent overflow-hidden flex justify-center items-center">
            <img src="{{ asset('images/best1.jpg') }}" alt="Promotion" 
                 class="w-full h-auto max-h-[85vh] object-contain rounded-none shadow-2xl">
        </div>
        
        <div class="text-center mt-4">
            <button onclick="closePopup()" class="text-white text-lg hover:text-emerald-300 underline cursor-pointer font-medium tracking-wide">
                ปิดหน้าต่าง
            </button>
        </div>
    </div>
</div>