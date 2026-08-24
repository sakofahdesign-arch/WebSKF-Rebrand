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

    $partnerGroups = collect($partners)->chunk(ceil(count($partners) / 2));
@endphp

<section data-section="partners-agencies" class="relative isolate overflow-visible bg-transparent py-16">
    <div class="homepage-heading-spotlight pointer-events-none absolute inset-x-0 top-0 -z-10 h-64"></div>

    <div class="relative z-10 mx-auto max-w-[1560px] px-4 sm:px-6 lg:px-8">
        <div class="mx-auto mb-12 max-w-3xl text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold text-black dark:text-white tracking-tight">
                พันธมิตรและหน่วยงานที่เกี่ยวข้อง</h2>
            <div class="mt-3 h-1 w-20 bg-green-500 mx-auto rounded-full"></div>
            <p class="mx-auto mt-4 max-w-2xl text-lg leading-relaxed text-gray-600">หน่วยงานและองค์กรที่เราทำงานร่วมด้วยและให้การสนับสนุน</p>
        </div>

        <div class="relative grid gap-8 lg:grid-cols-2 lg:gap-10">
            <div
                class="pointer-events-none absolute bottom-0 left-1/2 top-0 hidden w-px -translate-x-1/2 border-l border-dashed border-emerald-900/18 dark:border-white/14 lg:block">
            </div>
            @foreach ($partnerGroups as $groupIndex => $group)
                <div>
                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:gap-5">
                        @foreach ($group as $partner)
                            <a href="{{ $partner['url'] }}" target="_blank" rel="noopener noreferrer" class="group block h-full">
                                <div
                                    class="relative flex h-24 w-full items-center justify-center overflow-hidden rounded-lg border border-emerald-900/10 bg-white p-3 shadow-[0_14px_38px_rgba(4,60,50,0.08)] transition-all duration-300 group-hover:-translate-y-1 group-hover:border-emerald-400 group-hover:shadow-[0_18px_46px_rgba(4,120,87,0.14)] dark:border-white/10">

                                    <div
                                        class="absolute inset-0 bg-emerald-50 opacity-0 transition-opacity duration-300 group-hover:opacity-40">
                                    </div>

                                    <img src="{{ url($partner['logo']) }}" alt="{{ $partner['name'] }}"
                                        title="{{ $partner['name'] }}"
                                        class="relative z-10 max-h-14 w-auto max-w-[82%] object-contain transition-transform duration-500 group-hover:scale-105"
                                        loading="lazy" />
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
