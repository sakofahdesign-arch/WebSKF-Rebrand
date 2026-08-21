@php
    $useFallbackNews = (bool) ($showHomepageNewsFallback ?? false);
    $fallbackByCategory = [
        'information' => [
            ['id' => 'fallback_information_1', 'title' => 'สหกรณ์อิสลาม ษะกอฟะฮ จำกัด ร่วมมอบน้ำและให้กำลังใจ กับทีมงานบริหารเทศบาลคลองยาง โดยท่านนายก ชูชัย ใจบุญ และทีมงานสมาชิกเทศบาล เมื่อวันเสาร์ที่ผ่านมา', 'date' => '25 กรกฎาคม 2569', 'href' => 'https://skf.or.th/article/14825', 'image' => 'https://skf.or.th/uploads/covers/14825_20260727111634.jpg'],
            ['id' => 'fallback_information_2', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ จำกัด ร่วมแสดงความยินดีกับผู้จัดการใหญ่คนใหม่ และขอบคุณผู้จัดการธนาคารอิสลามแห่งประเทศไทย สาขากระบี่', 'date' => '25 มิถุนายน 2569', 'href' => 'https://skf.or.th/article/24010', 'image' => 'https://skf.or.th/uploads/covers/24010_20260626084254.jpg'],
            ['id' => 'fallback_information_3', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ สาขาห้วยลึก ร่วมสนับสนุนพิธีตัมมัตอัลกุรอาน มอบวัวและทุนซากาต เสริมสร้างศาสนาและการศึกษาแก่เยาวชน', 'date' => '11 กุมภาพันธ์ 2569', 'href' => 'https://skf.or.th/article/88224', 'image' => 'https://skf.or.th/uploads/covers/88224_20260212125429.jpg'],
            ['id' => 'fallback_information_4', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ สาขากาญจนดิษฐ์ ลงพื้นที่มอบทุนซะกาต ประจำปี 2569 เสริมสร้างคุณภาพชีวิตและแบ่งปันสู่สังคม', 'date' => '11 กุมภาพันธ์ 2569', 'href' => 'https://skf.or.th/article/99095', 'image' => 'https://skf.or.th/uploads/covers/99095_20260212125757.png'],
            ['id' => 'fallback_information_5', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ สาขาห้วยลึก มอบเงินสมทบทุนสนับสนุนงานเมาลิดกลางตำบลทรายขาว ประจำปี 2569', 'date' => '30 มกราคม 2569', 'href' => 'https://skf.or.th/article/67881', 'image' => 'https://skf.or.th/uploads/covers/67881_20260203093520.jpg'],
            ['id' => 'fallback_information_6', 'title' => 'ผู้บริหารสหกรณ์อิสลามษะกอฟะฮ ร่วมงานการกุศลสมทบทุนต่อเติมอาคารบาลายบ้านแหลมมะขาม จังหวัดตรัง', 'date' => '24 มกราคม 2569', 'href' => 'https://skf.or.th/article/65999', 'image' => 'https://skf.or.th/uploads/covers/65999_20260126084026.jpg'],
            ['id' => 'fallback_information_7', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ สาขาเกาะลันตา จัดกิจกรรมคุตบะฮสัญจร หัวข้อ “คุณค่าเดือนชะอฺบาน” พร้อมประชาสัมพันธ์งานสหกรณ์', 'date' => '23 มกราคม 2569', 'href' => 'https://skf.or.th/article/58951', 'image' => 'https://skf.or.th/uploads/covers/58951_20260126083820.jpg'],
            ['id' => 'fallback_information_8', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ สาขาห้วยลึก ลงพื้นที่มอบผ้ากันเปื้อน สนับสนุนกลุ่มแม่ค้าในงานเมาลิดกลางคลองพน', 'date' => '22 มกราคม 2569', 'href' => 'https://skf.or.th/article/67384', 'image' => 'https://skf.or.th/uploads/covers/67384_20260122105850.jpg'],
        ],
        'welfare' => [
            ['id' => 'fallback_welfare_1', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ สาขาคลองท่อม มอบสวัสดิการยามชราแก่สมาชิกอายุครบ 70 ปี', 'date' => '3 กุมภาพันธ์ 2569', 'href' => 'https://skf.or.th/article/61014', 'image' => 'https://skf.or.th/uploads/covers/61014_20260203094015.jpg'],
            ['id' => 'fallback_welfare_2', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ จุดบริการกาญจนดิษฐ์ มอบสวัสดิการแต่งงานแก่สมาชิก ส่งเสริมสถาบันครอบครัว', 'date' => '24 มกราคม 2569', 'href' => 'https://skf.or.th/article/67905', 'image' => 'https://skf.or.th/uploads/covers/67905_20260126084143.jpg'],
            ['id' => 'fallback_welfare_3', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ สาขาเหนือคลอง จัดอบรมสมาชิก เสริมความรู้ด้านผลิตภัณฑ์ สวัสดิการ และการเงินฮาลาล', 'date' => '15 มกราคม 2569', 'href' => 'https://skf.or.th/article/48655', 'image' => 'https://skf.or.th/uploads/covers/48655_20260116110017.jpg'],
            ['id' => 'fallback_welfare_4', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ กาญจนดิษฐ์ ลงพื้นที่มอบสวัสดิการสมาชิก ส่งเสริมคุณภาพชีวิตและสวัสดิการสังคม', 'date' => '6 มกราคม 2569', 'href' => 'https://skf.or.th/article/79088', 'image' => 'https://skf.or.th/uploads/covers/79088_20260107.jpg'],
            ['id' => 'fallback_welfare_5', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ จำกัด สาขาห้วยลึก มอบสวัสดิการเสียชีวิตแก่ทายาทสมาชิก', 'date' => '18 สิงหาคม 2568', 'href' => 'https://skf.or.th/article/36655', 'image' => 'https://skf.or.th/uploads/covers/36655_20250818.jpg'],
            ['id' => 'fallback_welfare_6', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ จำกัด จุดบริการกาญจนดิษฐ์ มอบสวัสดิการเสียชีวิตและเงินช่วยเหลือผู้ประสบภัย', 'date' => '7 สิงหาคม 2568', 'href' => 'https://skf.or.th/article/41773', 'image' => 'https://skf.or.th/uploads/covers/41773_20250813.png'],
            ['id' => 'fallback_welfare_7', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ จำกัด จุดบริการกาญจนดิษฐ์ ลงพื้นที่เยี่ยมสมาชิกป่วยและมอบสวัสดิการเสียชีวิต', 'date' => '6 สิงหาคม 2568', 'href' => 'https://skf.or.th/article/84839', 'image' => 'https://skf.or.th/uploads/covers/84839_20250806.png'],
            ['id' => 'fallback_welfare_8', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ จำกัด สาขาเกาะลันตา ได้ลงพื้นที่ให้กำลังใจกับญาติพี่น้อง พร้อม มอบสวัสดิการกรณีเสียชีวิต ให้แก่ทายาทของ นายลิ่ม ก๊ดใหญ่ สมาชิกผู้ล่วงลับ', 'date' => '5 สิงหาคม 2568', 'href' => 'https://skf.or.th/article/50662', 'image' => 'https://skf.or.th/uploads/covers/50662_20250806.png'],
        ],
        'foundation' => [
            ['id' => 'fallback_foundation_1', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ สาขาคลองท่อม ร่วมกับ มูลนิธิษะกอฟะฮ ลงพื้นที่มอบซากาตเพื่อสร้างอาชีพให้กับ น.ส.น้ำฝน สุขสนิท', 'date' => '25 มีนาคม 2568', 'href' => 'https://skf.or.th/article/87303', 'image' => 'https://skf.or.th/uploads/covers/cover8730320250325051948.jpg'],
            ['id' => 'fallback_foundation_2', 'title' => 'ลงพื้นที่มอบน้ำดื่มให้แก่ผู้ประสาน เพื่อจัดนุรีอัรวะห์', 'date' => '14 กันยายน 2566', 'href' => 'https://skf.or.th/article/5560', 'image' => 'https://skf.or.th/uploads/covers/d970d74446992afa6559355a8fdfc44e.jpg'],
            ['id' => 'fallback_foundation_3', 'title' => 'ร่วมบริจาคสมทบทุนและน้ำดื่มในงานการกุศลหารายได้เพื่อหางบประมาณ การศึกษาของเยาวชนใน หมู่บ้าน ณ.มัสยิดบ้านท่ามะพร้าว', 'date' => '11 พฤศจิกายน 2565', 'href' => 'https://skf.or.th/article/2148', 'image' => 'https://skf.or.th/uploads/covers/9f02f56fa694726e381b7ae5582174b4.jpg'],
            ['id' => 'fallback_foundation_4', 'title' => 'โรงพยาบาลจริยธรรมรวมแพทย์จังหวัดกระบี่บริจาคเตียงผู้ป่วย จากโครงการ “เราจะดูแลกัน” ของโรงพยาบาลให้กับ ผู้ป่วยติดเตียงของตำบลคลองยาง', 'date' => '10 ตุลาคม 2565', 'href' => 'https://skf.or.th/article/7194', 'image' => 'https://skf.or.th/uploads/covers/f615253f0a8795c5a32f3aa5159c2171.jpg'],
            ['id' => 'fallback_foundation_5', 'title' => 'สาขาอ่าวลึก ร่วมกับมูลนิธิษะกอฟะฮ นำโดย นายอัซมีย์ หมาดเต๊ะ (ประธานมูลนิธิฯ) พร้อมกับคณะอนุกรรมการสาขาอ่าวลึก และเจ้าหน้าที่ลงพื้นที่มอบซากาต ณ บ้านแหลมสัก จำนวน 11 ทุน', 'date' => '29 กันยายน 2565', 'href' => 'https://skf.or.th/article/6680', 'image' => 'https://skf.or.th/uploads/covers/7fa8781c2035e0a840ce9203f117d3f8.jpg'],
            ['id' => 'fallback_foundation_6', 'title' => 'มูลนิธิษะกอฟะฮร่วมกับสหกรณ์อิสลามษะกอฟะฮ สาขาห้วยลึก ลงพื้นที่มอบซากาตให้กับนักเรียนโรงเรียนบ้านห้วยลึก ต.ทรายขาว อ.คลองท่อม', 'date' => '15 สิงหาคม 2565', 'href' => 'https://skf.or.th/article/7339', 'image' => 'https://skf.or.th/uploads/covers/6f06709513ea75d3ee998d2e40375646.jpg'],
            ['id' => 'fallback_foundation_7', 'title' => 'ลงพื้นที่มอบซากาตให้กับนักเรียนโรงเรียนรุ่งอรุณศึกษา ต.ทรายขาว อ.คลองท่อม', 'date' => '11 สิงหาคม 2565', 'href' => 'https://skf.or.th/article/907', 'image' => 'https://skf.or.th/uploads/covers/479539d96615af2d12b2cf8774e860e0.jpg'],
            ['id' => 'fallback_foundation_8', 'title' => 'มูลนิธิษะกอฟะฮฺร่วมกับสหกรณ์อิสลามษะกอฟะ จำกัด (สาขาห้วยลึก) ลงพื้นที่มอบซะกาตให้แก่ นักเรียน ผู้มีสิทธิ์ โรงเรียน บ้านทุ่งคา', 'date' => '27 กรกฎาคม 2565', 'href' => 'https://skf.or.th/article/3509', 'image' => 'https://skf.or.th/uploads/covers/ed97079a707aab0e5eddb1d53f8a6ed5.jpg'],
        ],
        'credit' => [
            ['id' => 'fallback_credit_1', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ อนุมัติสินเชื่อฮาลาล สนับสนุนสมาชิกซื้อที่ดินสวนปาล์ม มูลค่า 1.5 ล้านบาท', 'date' => '2 กุมภาพันธ์ 2569', 'href' => 'https://skf.or.th/article/17099', 'image' => 'https://skf.or.th/uploads/covers/17099_20260203093638.jpg'],
            ['id' => 'fallback_credit_2', 'title' => 'อนุมัติ "สินเชื่อฮาลาล" เพื่อยกระดับธุรกิจท่องเที่ยว: สาขาเกาะลันตา หนุนสมาชิกปรับปรุงรีสอร์ท', 'date' => '25 กันยายน 2568', 'href' => 'https://skf.or.th/article/64734', 'image' => 'https://skf.or.th/uploads/covers/64734_20250925.jpg'],
            ['id' => 'fallback_credit_3', 'title' => 'สนับสนุนธุรกิจท่องเที่ยว: "สินเชื่อฮาลาล" สาขาเกาะลันตา อนุมัติเงินทุนปรับปรุงรีสอร์ท', 'date' => '25 กันยายน 2568', 'href' => 'https://skf.or.th/article/76998', 'image' => 'https://skf.or.th/uploads/covers/76998_20250925.jpg'],
            ['id' => 'fallback_credit_4', 'title' => 'อนุมัติ "สินเชื่อฮาลาล" เพื่อต่อยอดธุรกิจอสังหาริมทรัพย์: สาขาเกาะลันตา สนับสนุนสมาชิกสร้างรายได้', 'date' => '24 กันยายน 2568', 'href' => 'https://skf.or.th/article/44914', 'image' => 'https://skf.or.th/uploads/covers/44914_20250925.jpg'],
            ['id' => 'fallback_credit_5', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ จำกัด (สาขาเกาะลันตา) อนุมัติสินเชื่อเพื่อการลงทุนในอสังหาริมทรัพย์', 'date' => '19 กันยายน 2568', 'href' => 'https://skf.or.th/article/11507', 'image' => 'https://skf.or.th/uploads/covers/11507_20250919.jpg'],
            ['id' => 'fallback_credit_6', 'title' => 'การตรวจสอบกิจการสหกรณ์สาคลองท่อม ประจำปี 2568', 'date' => '3 กันยายน 2568', 'href' => 'https://skf.or.th/article/70906', 'image' => 'https://skf.or.th/uploads/covers/70906_20250908.jpg'],
            ['id' => 'fallback_credit_7', 'title' => 'สินเชื่อฮาลาล เพื่อการประกอบอาชีพ', 'date' => '8 สิงหาคม 2568', 'href' => 'https://skf.or.th/article/98976', 'image' => 'https://skf.or.th/uploads/covers/98976_20250808.jpg'],
            ['id' => 'fallback_credit_8', 'title' => 'สหกรณ์อิสลามษะกอฟะฮ จำกัด สาขาอ่าวลึก อนุมัติสินเชื่อยานพาหนะตามหลักชารีอะห์', 'date' => '29 กรกฎาคม 2568', 'href' => 'https://skf.or.th/article/74887', 'image' => 'https://skf.or.th/uploads/covers/74887_20250729.jpg'],
        ],
    ];

    $makeNewsItems = function ($items, $fallbackItems = []) use ($useFallbackNews) {
        $newsItems = collect($items ?? [])->map(function ($item) {
            return [
                'id' => (string) ($item->news_number ?? uniqid('news_', true)),
                'title' => $item->title ?? 'ข่าวสารสหกรณ์',
                'image' => asset(!empty($item->picture_name) ? 'uploads/covers/' . $item->picture_name : 'images/sakofah-logo.png'),
                'date' => !empty($item->dateupload) ? thaidate('j F Y', $item->dateupload) : '',
                'href' => !empty($item->news_number) ? route('article', $item->news_number) : route('activity'),
            ];
        })->values();

        return $newsItems->isNotEmpty() || ! $useFallbackNews
            ? $newsItems
            : collect($fallbackItems);
    };

    $newsCategories = collect([
        [
            'id' => 'information',
            'label' => 'ประชาสัมพันธ์',
            'items' => $makeNewsItems($information ?? collect(), $fallbackByCategory['information']),
        ],
        [
            'id' => 'welfare',
            'label' => 'สวัสดิการ',
            'items' => $makeNewsItems($welfare ?? collect(), $fallbackByCategory['welfare']),
        ],
        [
            'id' => 'foundation',
            'label' => 'มูลนิธิษะกอฟะฮ',
            'items' => $makeNewsItems($foundation ?? collect(), $fallbackByCategory['foundation']),
        ],
        [
            'id' => 'credit',
            'label' => 'สินเชื่อ',
            'items' => $makeNewsItems($credit ?? collect(), $fallbackByCategory['credit']),
        ],
    ]);
@endphp

<div
    data-staggered-news
    data-categories='@json($newsCategories)'
></div>
