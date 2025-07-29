@php
    $partners = [
        [
            'name' => 'ตรากรมที่ดิน',
            'url' => 'https://shorturl.asia/IKm8k',
            'logo' => 'images/logos/ตรากรมที่ดิน.png',
        ],
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
        [
            'name' => 'Shell Krabi',
            'url' => 'https://www.facebook.com/ADODSKF',
            'logo' => 'images/logos/shellKrabi.jpg',
        ],
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

<section class="py-20 bg-gradient-to-b from-white to-gray-50 mb-4">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-800 tracking-tight">พันธมิตรและหน่วยงานที่เกี่ยวข้อง</h2>
            <p class="mt-4 text-lg text-gray-600">หน่วยงานและองค์กรที่เราทำงานร่วมด้วยและให้การสนับสนุน</p>
            <div class="mt-3 h-1 w-20 bg-blue-600 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-7 gap-8 items-center justify-center">
            @foreach ($partners as $partner)
                <a href="{{ $partner['url'] }}" target="_blank" rel="noopener noreferrer" class="block text-center">
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4 hover:shadow-md transition-all duration-300 hover:scale-105">
                        <img src="{{ url($partner['logo']) }}" alt="{{ $partner['name'] }}"
                            class="h-20 w-auto mx-auto object-contain" loading="lazy" />
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>