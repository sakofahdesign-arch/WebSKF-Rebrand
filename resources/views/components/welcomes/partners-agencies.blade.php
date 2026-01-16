@php
    $partners = [
        ['name' => 'ตรากรมที่ดิน', 'url' => 'https://shorturl.asia/IKm8k', 'logo' => 'images/logos/ตรากรมที่ดิน.png'],
        [
            'name' => 'กระทรวงเกษตรและสหกรณ์',
            'url' => 'https://shorturl.asia/VpM47',
            'logo' => 'images/logos/กระทรวงเกษตรและสหกรณ์.png',
        ],
        [
            'name' => 'สำนักงานตรวจบัญชีสหกรณ์',
            'url' => 'https://shorturl.asia/PRMAt',
            'logo' => 'images/logos/img_fd06b99e276ab69db92a5bae61228dc2.png',
        ],
        [
            'name' => 'สำนักงานสหกรณ์จังหวัดกระบี่',
            'url' => 'https://shorturl.asia/SCMmA',
            'logo' => 'images/logos/ตราสำนักงานสหกรณ์จังหวัดกระบี่.jpg',
        ],
        [
            'name' => 'ชุมนุมสหกรณ์อิสลามแห่งประเทศไทย',
            'url' => 'https://shorturl.asia/g56qA',
            'logo' => 'images/logos/img_12b077835cddf4f35d3a3c285545a815.jpg',
        ],
        [
            'name' => 'กรมส่งเสริมสหกรณ์',
            'url' => 'https://shorturl.asia/uE52O',
            'logo' => 'images/logos/กรมส่งเสริมสหกรณ์.png',
        ],
        [
            'name' => 'โรงเรียนศอลาฟุดดีน',
            'url' => 'https://www.facebook.com/Sakofah.Wittayaphat.School/?ref=bookmarks',
            'logo' => 'images/logos/crop-1588051633262.jpg',
        ],
        [
            'name' => 'สันนิบาตสหกรณ์แห่งประเทศไทย',
            'url' => 'https://www.facebook.com/profile.php?id=100064546278455',
            'logo' => 'images/logos/crop-1588051648982.jpg',
        ],
        [
            'name' => 'โรงเรียนษะกอฟะฮวิทยาพัฒน์',
            'url' => 'https://www.facebook.com/profile.php?id=100083121019673',
            'logo' => 'images/logos/crop-1588051777775.jpg',
        ],
        ['name' => 'Shell Krabi', 'url' => 'https://www.facebook.com/ADODSKF', 'logo' => 'images/logos/shellKrabi.jpg'],
        [
            'name' => 'YouTube',
            'url' => 'https://www.youtube.com/channel/UCffHrfpeGIw4dlLCs-IEGDg',
            'logo' => 'images/logos/crop-1588051728377.jpg',
        ],
        [
            'name' => 'Facebook Page',
            'url' => 'https://www.facebook.com/Sakofah.Islam.Savings/',
            'logo' => 'images/logos/crop-1588051745671.jpg',
        ],
        [
            'name' => 'Ummah Channel',
            'url' => 'https://www.facebook.com/watch/UmmahChannel.Fan/',
            'logo' => 'images/logos/logo-ummah-channel.png',
        ],
        [
            'name' => 'Southern Coffee',
            'url' => 'https://www.facebook.com/profile.php?id=100057631292290',
            'logo' => 'images/logos/SOUTHERN-COFFEE-LOGO.png',
        ],
    ];
@endphp

<section class="py-16 bg-white border-t border-gray-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-green-800 tracking-tight">
                พันธมิตรและหน่วยงานที่เกี่ยวข้อง</h2>
            <div class="mt-3 h-1 w-20 bg-green-500 mx-auto rounded-full"></div>
            <p class="mt-4 text-lg text-gray-500">หน่วยงานและองค์กรที่เราทำงานร่วมด้วยและให้การสนับสนุน</p>
        </div>

        <div
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-7 gap-4 lg:gap-6 justify-center">
            @foreach ($partners as $partner)
                <a href="{{ $partner['url'] }}" target="_blank" rel="noopener noreferrer" class="group block h-full">
                    <div
                        class="h-28 w-full bg-white rounded-xl border border-gray-100 shadow-sm p-2 flex items-center justify-center transition-all duration-300 group-hover:shadow-lg group-hover:border-green-400 group-hover:-translate-y-1 relative overflow-hidden">

                        <div
                            class="absolute inset-0 bg-green-50 opacity-0 group-hover:opacity-30 transition-opacity duration-300">
                        </div>

                        <img src="{{ url($partner['logo']) }}" alt="{{ $partner['name'] }}"
                            title="{{ $partner['name'] }}"
                            class="max-h-16 w-auto max-w-[90%] object-contain filter grayscale-0 group-hover:scale-110 transition-transform duration-500 relative z-10"
                            loading="lazy" />
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
