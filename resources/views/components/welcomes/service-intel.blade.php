<section class="py-16 bg-gray-50/50">
    <div class="container mx-auto px-4">

        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-green-800">บริการและข่าวสาร</h2>
            <div class="h-1 w-20 bg-green-500 mx-auto rounded-full mt-2 mb-4"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                เข้าถึงบริการต่างๆ ได้อย่างรวดเร็ว และติดตามความเคลื่อนไหวล่าสุดจากเรา
            </p>
        </div>

        <div class="grid lg:grid-cols-12 gap-6 lg:gap-8 items-start">

            <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-6">

                <a href="{{ route('register') }}" class="card bg-white shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-transparent hover:border-green-500 group">
                    <div class="card-body p-6 items-center text-center">
                        <div class="w-16 h-16 flex items-center justify-center bg-green-100 text-green-600 rounded-full mb-2 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3.075c0 .939-.39 1.825-.986 2.45l-4.04 4.04a2.13 2.13 0 01-3 0l-4.04-4.04a3.003 3.003 0 01-.986-2.45V7.5a3 3 0 013-3h10.5a3 3 0 013 3z" /><path stroke-linecap="round" stroke-linejoin="round" d="M9 7.5h6" /></svg>
                        </div>
                        <h3 class="card-title text-gray-800 text-lg md:text-xl">สมัครสมาชิก</h3>
                        <p class="text-gray-500 text-sm">เริ่มต้นความมั่นคงทางการเงินกับเรา</p>
                    </div>
                </a>

                <a href="{{ route('deposit') }}" class="card bg-white shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-transparent hover:border-blue-500 group">
                    <div class="card-body p-6 items-center text-center">
                        <div class="w-16 h-16 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full mb-2 group-hover:scale-110 transition-transform duration-300">
                             <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="card-title text-gray-800 text-lg md:text-xl">บริการเงินฝาก</h3>
                        <p class="text-gray-500 text-sm">หลากหลายรูปแบบการออมที่ตอบโจทย์</p>
                    </div>
                </a>

                <a href="{{ route('credit_service') }}" class="card bg-white shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-transparent hover:border-yellow-500 group">
                    <div class="card-body p-6 items-center text-center">
                        <div class="w-16 h-16 flex items-center justify-center bg-yellow-100 text-yellow-600 rounded-full mb-2 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-3.75-2.25M21 18l-3.75-2.25m0 0l-3.75 2.25M15 15.75l-3.75 2.25" /></svg>
                        </div>
                        <h3 class="card-title text-gray-800 text-lg md:text-xl">บริการสินเชื่อ</h3>
                        <p class="text-gray-500 text-sm">เสริมสภาพคล่องด้วยเงื่อนไขที่เป็นธรรม</p>
                    </div>
                </a>

                <a href="{{ route('document') }}" class="card bg-white shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-transparent hover:border-gray-500 group">
                    <div class="card-body p-6 items-center text-center">
                        <div class="w-16 h-16 flex items-center justify-center bg-gray-100 text-gray-600 rounded-full mb-2 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9Z" /></svg>
                        </div>
                        <h3 class="card-title text-gray-800 text-lg md:text-xl">เอกสารสมาชิก</h3>
                        <p class="text-gray-500 text-sm">ดาวน์โหลดแบบฟอร์มและเอกสารต่างๆ</p>
                    </div>
                </a>
            </div>

            <div class="lg:col-span-4 h-full">
                <div class="card bg-white shadow-xl border border-gray-100 h-full overflow-hidden">
                    <div class="card-body p-0">
                        <div class="flex items-center p-4 bg-gray-50 border-b">
                             <svg class="w-7 h-7 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path></svg>
                             <h3 class="text-lg font-bold text-gray-800 ml-3">ข่าวสารจาก Facebook</h3>
                        </div>

                        <div class="w-full bg-white flex justify-center overflow-hidden h-[500px]">
                           <iframe
                                src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FSakofah.Islam.Savings&tabs=timeline&width=500&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"
                                class="w-full h-full border-none overflow-hidden"
                                scrolling="no"
                                frameborder="0"
                                allowfullscreen="true"
                                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
