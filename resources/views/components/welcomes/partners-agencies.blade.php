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

 <section class="py-16 bg-white">
     <div class="container mx-auto px-4">
         <div class="text-center mb-12">
             <h2 class="text-3xl font-bold text-gray-800">พันธมิตรและหน่วยงานที่เกี่ยวข้อง</h2>
             <p class="mt-3 text-gray-500">หน่วยงานและองค์กรที่เราทำงานร่วมด้วยและให้การสนับสนุน</p>
         </div>

         <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 xl:grid-cols-8 gap-x-6 gap-y-10 items-center justify-center">
             @foreach ($partners as $partner)
                 <a href="{{ $partner['url'] }}" target="_blank" rel="noopener noreferrer" class="block text-center">
                     <img src="{{ url($partner['logo']) }}" alt="{{ $partner['name'] }}" class="h-20 w-auto mx-auto object-contain grayscale hover:grayscale-0 hover:scale-110 transition-all duration-300 ease-in-out" loading="lazy"/>
                 </a>
             @endforeach
         </div>

     </div>
 </section>
