<?php

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('homepage renders the organization cylinder hero', function () {
    $html = view('welcome', [
        'information' => collect(),
        'welfare' => collect(),
        'credit' => collect(),
        'foundation' => collect(),
    ])->render();

    expect($html)
        ->toContain('data-section="organization-cylinder-hero"')
        ->toContain('organization-hero-logo')
        ->toContain('images/sakofah-hero-logo.png')
        ->toContain('h-24 w-24')
        ->not->toContain('id="hero-carousel"');

    expect(file_exists(public_path('images/sakofah-hero-logo.png')))->toBeTrue();
});

test('homepage news tabs keep empty categories empty like the old system', function () {
    $html = view('components.welcomes.news-staggered', [
        'information' => collect(),
        'welfare' => collect(),
        'credit' => collect(),
        'foundation' => collect(),
    ])->render();

    preg_match("/data-categories='([^']+)'/", $html, $matches);
    $categories = json_decode(html_entity_decode($matches[1], ENT_QUOTES, 'UTF-8'), true);

    expect($categories)->sequence(
        fn ($category) => $category->toMatchArray(['id' => 'information', 'items' => []]),
        fn ($category) => $category->toMatchArray(['id' => 'welfare', 'items' => []]),
        fn ($category) => $category->toMatchArray(['id' => 'foundation', 'items' => []]),
        fn ($category) => $category->toMatchArray(['id' => 'credit', 'items' => []]),
    );
});

test('homepage news category tabs use a white pill background', function () {
    $component = file_get_contents(base_path('components/ui/staggered-news-grid.tsx'));

    expect($component)
        ->toContain('rounded-full border border-slate-200 bg-white p-1.5')
        ->not->toContain('rounded-full border border-slate-200 bg-slate-50 p-1.5');
});

test('homepage news tabs show separated fallback items when local database is unavailable', function () {
    $html = view('components.welcomes.news-staggered', [
        'information' => collect(),
        'welfare' => collect(),
        'credit' => collect(),
        'foundation' => collect(),
        'showHomepageNewsFallback' => true,
    ])->render();

    preg_match("/data-categories='([^']+)'/", $html, $matches);
    $categories = json_decode(html_entity_decode($matches[1], ENT_QUOTES, 'UTF-8'), true);

    expect($categories)->sequence(
        fn ($category) => $category
            ->toMatchArray(['id' => 'information'])
            ->and($category->value['items'])->toHaveCount(8)
            ->and($category->value['items'][0]['href'])->toBe('https://skf.or.th/article/14825'),
        fn ($category) => $category
            ->toMatchArray(['id' => 'welfare'])
            ->and($category->value['items'])->toHaveCount(8)
            ->and($category->value['items'][0]['href'])->toBe('https://skf.or.th/article/61014'),
        fn ($category) => $category
            ->toMatchArray(['id' => 'foundation'])
            ->and($category->value['items'])->toHaveCount(8)
            ->and($category->value['items'][0]['href'])->toBe('https://skf.or.th/article/87303'),
        fn ($category) => $category
            ->toMatchArray(['id' => 'credit'])
            ->and($category->value['items'])->toHaveCount(8)
            ->and($category->value['items'][0]['href'])->toBe('https://skf.or.th/article/17099'),
    );
});

test('journals section uses the shared homepage heading style without a logo', function () {
    $html = view('components.welcomes.journals-public')->render();

    expect($html)
        ->toContain('data-section="journals-public"')
        ->not->toContain('journals-section-logo')
        ->not->toContain('ข่าวสารจาก Facebook')
        ->not->toContain('facebook.com/plugins/page.php')
        ->not->toContain('วิดีโอแนะนำ')
        ->not->toContain('youtube.com/embed')
        ->toContain('text-3xl md:text-4xl font-extrabold text-green-800')
        ->toContain('h-1 w-20 bg-green-500 mx-auto rounded-full');
});

test('journals section exposes complete shelf journal data', function () {
    $html = view('components.welcomes.journals-public')->render();
    $template = file_get_contents(base_path('resources/views/components/welcomes/journals-public.blade.php'));

    preg_match("/data-journals='([^']+)'/", $html, $matches);
    $journals = json_decode(html_entity_decode($matches[1], ENT_QUOTES, 'UTF-8'), true);

    expect($html)
        ->toContain('data-journal-complete-shelf')
        ->not->toContain('data-books-showcase')
        ->not->toContain('data-books=')
        ->and($journals)->toHaveCount(9)
        ->and($journals[0])->toHaveKeys([
            'id',
            'title',
            'subtitle',
            'year',
            'href',
            'downloadUrl',
            'cover',
            'themeColor',
            'foilColor',
        ])
        ->and($journals[0]['themeColor'])->toStartWith('#')
        ->and($journals[0]['foilColor'])->toStartWith('#')
        ->and($journals[0]['cover'])->toContain('/images/ebooks/')
        ->and($journals[0]['downloadUrl'])->toContain('online.anyflip.com')
        ->and($html)
        ->not->toContain('วิดีโอ')
        ->not->toContain('youtube.com')
        ->and($template)
        ->not->toContain('$themeColors')
        ->not->toContain('$foilColors');
});

test('homepage uses the wave grid background behind all landing sections', function () {
    $html = view('welcome', [
        'information' => collect(),
        'welfare' => collect(),
        'credit' => collect(),
        'foundation' => collect(),
    ])->render();
    $app = file_get_contents(base_path('resources/js/app.js'));
    $wave = file_get_contents(base_path('resources/js/homepage-wave-grid-background-mount.tsx'));
    $css = file_get_contents(base_path('resources/css/app.css'));

    expect($html)
        ->toContain('data-wave-grid-homepage-background')
        ->toContain('opacity-[0.42]')
        ->toContain('data-homepage-content')
        ->and(strpos($html, 'data-wave-grid-homepage-background'))->toBeLessThan(strpos($html, 'data-homepage-content'))
        ->and($app)->toContain('./homepage-wave-grid-background-mount')
        ->and($wave)->toContain('colorBase="#f0fff7"')
        ->and($wave)->toContain('colorHigh="#00b86b"')
        ->and($wave)->toContain('gridSize={30}')
        ->and($wave)->toContain('waveAmplitude={0.44}')
        ->and($wave)->toContain('waveMaxHeight={0.52}')
        ->and($wave)->toContain('waveWidth={4.6}')
        ->and($wave)->toContain('waveJitter={0.2}')
        ->and($css)->toContain('[data-homepage-content] > :where(section, div[data-promotion-news-showcase], div[data-staggered-news])');
});

test('homepage section shells are transparent and share the journals heading wash', function () {
    $radialWash = 'bg-[radial-gradient(ellipse_at_50%_46%,transparent_0%,transparent_28%,rgba(16,185,129,0.14)_46%,rgba(240,253,244,0.48)_62%,transparent_100%)]';
    $floatingWash = 'absolute inset-x-0 -top-8 -z-10 h-[28rem]';
    $headingWrap = 'mx-auto mb-12 max-w-3xl text-center';

    $service = file_get_contents(base_path('resources/views/components/welcomes/service-intel.blade.php'));
    $journals = file_get_contents(base_path('resources/views/components/welcomes/journals-public.blade.php'));
    $branch = file_get_contents(base_path('resources/views/components/welcomes/branch-service-network.blade.php'));
    $partners = file_get_contents(base_path('resources/views/components/welcomes/partners-agencies.blade.php'));
    $promo = file_get_contents(base_path('components/ui/promotion-news-showcase.tsx'));
    $news = file_get_contents(base_path('components/ui/staggered-news-grid.tsx'));
    $hero = file_get_contents(base_path('resources/views/components/welcomes/organization-cylinder.blade.php'));
    $css = file_get_contents(base_path('resources/css/app.css'));

    foreach ([$service, $journals, $branch, $partners] as $section) {
        expect($section)
            ->toContain($radialWash)
            ->toContain($floatingWash)
            ->toContain($headingWrap)
            ->toContain('bg-transparent')
            ->toContain('overflow-visible')
            ->toContain('isolate')
            ->toContain('relative z-10')
            ->not->toContain('bg-gray-50/50')
            ->not->toContain('bg-white py-16')
            ->not->toContain('absolute inset-x-0 top-0 h-72')
            ->not->toContain('-top-24');
    }

    expect($branch)
        ->not->toContain('h-64 bg-emerald-50')
        ->and($partners)->not->toContain('border-t border-gray-100')
        ->and($promo)->toContain($radialWash)
        ->and($promo)->toContain($floatingWash)
        ->and($promo)->toContain('bg-transparent py-14')
        ->and($promo)->toContain('mx-auto mb-12 max-w-3xl text-center')
        ->and($news)->toContain($radialWash)
        ->and($news)->toContain($floatingWash)
        ->and($news)->toContain('bg-transparent py-14')
        ->and($news)->toContain('mx-auto mb-12 max-w-3xl text-center')
        ->and($hero)->not->toContain('org-hero bg-white')
        ->and($hero)->not->toContain('overflow-hidden bg-white py-6')
        ->and($css)->toContain('background: transparent;')
        ->and($css)->not->toContain('background-color: rgb(255 255 255 / 0.82)');
});

test('morph text inherits the homepage Noto Sans Thai font stack', function () {
    $component = file_get_contents(base_path('components/ui/morph-text.tsx'));

    expect($component)
        ->toContain('fontFamily = "var(--font-sans)"')
        ->not->toContain('IBM Plex Sans Thai');
});

test('homepage shows the branch service network after journals with mapped branch data', function () {
    $html = view('welcome', [
        'information' => collect(),
        'welfare' => collect(),
        'credit' => collect(),
        'foundation' => collect(),
    ])->render();

    $hasBranchData = preg_match("/data-branches='([^']+)'/", $html, $matches);

    expect($html)
        ->toContain('data-section="branch-service-network"')
        ->and($hasBranchData)->toBe(1)
        ->and(strpos($html, 'data-section="journals-public"'))->toBeLessThan(strpos($html, 'data-section="branch-service-network"'));

    $branches = json_decode(html_entity_decode($matches[1], ENT_QUOTES, 'UTF-8'), true);

    expect($branches)
        ->toHaveCount(14)
        ->and($branches[0])->toMatchArray([
            'id' => 'khlong_yang',
            'latitude' => 7.803235,
            'longitude' => 99.085919,
            'group' => 'branch',
            'mapLink' => 'https://www.google.com/maps/search/?api=1&query=7.803235,99.085919',
        ])
        ->and($branches[7])->toMatchArray([
            'id' => 'nuea_khlong',
            'latitude' => 8.021063,
            'longitude' => 98.995649,
            'markerLogo' => asset('images/sakofah-logo.png'),
            'markerKind' => 'branch',
            'group' => 'branch',
        ])
        ->and($branches[7]['image'])->toContain('/images/branch/ton_thuai.jpg')
        ->and($branches[8])->toMatchArray([
            'id' => 'shell_krabi',
            'latitude' => 7.811404,
            'longitude' => 99.091178,
            'markerLogo' => asset('images/logos/shell-marker-logo.jpg'),
            'markerKind' => 'fuel',
            'group' => 'business',
        ])
        ->and($branches[9])->toMatchArray([
            'id' => 'sakofah_school',
            'latitude' => 8.0761628,
            'longitude' => 98.8971632,
            'group' => 'business',
            'image' => asset('images/logos/crop-1588051633262.jpg'),
            'markerLogo' => asset('images/logos/crop-1588051633262.jpg'),
            'mapLink' => 'https://www.google.com/maps/search/?api=1&query=8.0761628,98.8971632',
        ])
        ->and($branches[10])->toMatchArray([
            'id' => 'skf_stadium',
            'latitude' => 7.8105798,
            'longitude' => 99.0902488,
            'group' => 'business',
            'image' => asset('images/logos/crop-1588051777775.jpg'),
            'markerLogo' => asset('images/logos/crop-1588051777775.jpg'),
        ])
        ->and($branches[11])->toMatchArray([
            'id' => 'sakofah_foundation',
            'latitude' => 7.810533,
            'longitude' => 99.090014,
            'group' => 'business',
            'image' => asset('images/logos/crop-1588051648982.jpg'),
            'markerLogo' => asset('images/logos/crop-1588051648982.jpg'),
        ])
        ->and($branches[13])->toMatchArray([
            'id' => 'southern_coffee_khlong_yang',
            'latitude' => 7.811498,
            'longitude' => 99.091009,
            'markerLogo' => asset('images/logos/SOUTHERN-COFFEE-LOGO.png'),
            'group' => 'business',
        ])
        ->and($branches[6])->toMatchArray([
            'id' => 'kanchanadit',
            'latitude' => 9.148572,
            'longitude' => 99.393332,
        ]);
});

test('branch network map uses the shared mapcn map component', function () {
    $component = file_get_contents(base_path('components/ui/branch-network-map.tsx'));
    $section = file_get_contents(base_path('resources/views/components/welcomes/branch-service-network.blade.php'));

    expect($component)
        ->toContain('from "@/components/ui/map"')
        ->toContain('<Map')
        ->toContain('<MapMarker')
        ->toContain('<MapPopup')
        ->toContain('<MapControls showFullscreen')
        ->toContain('mapRef.current?.flyTo')
        ->toContain('mapRef.current?.fitBounds')
        ->toContain('fitBoundsForOverview')
        ->toContain('event.stopPropagation()')
        ->toContain('ภาพรวม')
        ->toContain('onClick={() => fitBoundsForOverview(false)}')
        ->toContain('branchLocations')
        ->toContain('businessLocations')
        ->toContain('สาขา')
        ->toContain('หน่วยธุรกิจ')
        ->toContain('branch.group === "business"')
        ->toContain('const sidebarPositionClass = isFullscreen ? "top-24 md:top-24" : "top-4 md:top-5"')
        ->toContain('const sidebarHeightClass = isFullscreen ? "max-h-[min(560px,calc(100dvh-8rem))]" : "max-h-[calc(100%-2rem)] md:max-h-[calc(100%-2.5rem)]"')
        ->toContain('absolute left-4 z-20')
        ->toContain('sidebarHeightClass')
        ->toContain('h-[min(720px,calc(100dvh-7rem))]')
        ->toContain('const [popupBranchId, setPopupBranchId] = useState<string | null>(null)')
        ->toContain('{popupBranch && (')
        ->toContain('font-sans')
        ->toContain('className="!max-w-none !rounded-none !border-0 !bg-transparent !p-0 !text-inherit !shadow-none"')
        ->toContain('rounded-lg bg-white text-slate-950')
        ->toContain('[font-family:var(--font-sans)]')
        ->toContain('rounded-2xl bg-white')
        ->not->toContain('ring-slate-200/80')
        ->toContain('border-l-4 border-emerald-600 bg-emerald-50')
        ->toContain('<ChevronRight')
        ->toContain('<MapPinned className=')
        ->not->toContain('activeId === ""')
        ->toContain('w-[min(280px,calc(100vw-2rem))]')
        ->toContain('h-11 w-11')
        ->toContain('branch.markerLogo')
        ->toContain('branch.markerKind === "fuel"')
        ->toContain('h-auto max-h-[260px] w-full object-contain')
        ->not->toContain('h-32 w-full object-cover')
        ->not->toContain('backdrop-blur-2xl')
        ->not->toContain('w-[min(300px,calc(100vw-2rem))]')
        ->not->toContain('md:max-h-[calc(100%-2.5rem)]",')
        ->toContain('</aside>')
        ->toContain('</Map>')
        ->not->toContain('lg:grid-cols-[minmax(0,1fr)_360px]')
        ->not->toContain('<MarkerPopup')
        ->and($section)
        ->toContain('mx-auto max-w-[1480px] px-4 sm:px-6 lg:px-8')
        ->toContain('overflow-hidden rounded-xl border border-emerald-900/10 bg-white')
        ->not->toContain('relative left-1/2 w-screen -translate-x-1/2')
        ->not->toContain('rounded-xl border border-emerald-900/10 bg-white p-3');

    expect(strpos($component, '<aside'))->toBeLessThan(strpos($component, '</Map>'));
});

test('branch network sidebar starts with the head office in the old menu order', function () {
    $homepage = view('components.welcomes.branch-service-network')->render();
    $office = view('main.about.office')->render();

    preg_match("/data-branches='([^']+)'/", $homepage, $homepageMatches);
    preg_match("/data-branches='([^']+)'/", $office, $officeMatches);

    $homepageBranches = json_decode(html_entity_decode($homepageMatches[1], ENT_QUOTES, 'UTF-8'), true);
    $officeBranches = json_decode(html_entity_decode($officeMatches[1], ENT_QUOTES, 'UTF-8'), true);

    expect($homepageBranches[0])
        ->toMatchArray([
            'id' => 'khlong_yang',
            'name' => 'สาขาคลองยาง (สำนักงานใหญ่)',
        ])
        ->and($officeBranches[0])
        ->toMatchArray([
            'id' => 'khlong_yang',
            'name' => 'สาขาคลองยาง (สำนักงานใหญ่)',
        ])
        ->and(collect($homepageBranches)->pluck('id')->take(4)->all())
        ->toBe(['khlong_yang', 'krabi', 'ao_luek', 'koh_lanta'])
        ->and(collect($homepageBranches)->where('group', 'branch'))->toHaveCount(8)
        ->and(collect($homepageBranches)->where('group', 'business'))->toHaveCount(6);
});

test('office page uses the branch network map in fullscreen mode', function () {
    $html = view('main.about.office')->render();
    $header = file_get_contents(base_path('resources/views/components/header.blade.php'));
    $mount = file_get_contents(base_path('resources/js/branch-network-map-mount.tsx'));
    $component = file_get_contents(base_path('components/ui/branch-network-map.tsx'));

    preg_match("/data-branches='([^']+)'/", $html, $matches);
    $branches = json_decode(html_entity_decode($matches[1], ENT_QUOTES, 'UTF-8'), true);

    expect($html)
        ->toContain('data-branch-network-page')
        ->toContain('data-branch-network-map')
        ->toContain('data-map-variant="fullscreen"')
        ->toContain('เครือข่ายสาขาให้บริการ')
        ->not->toContain('x-data="{ activeTab:')
        ->not->toContain('lg:grid-cols-12')
        ->and($branches)->toHaveCount(14)
        ->and($branches[0])->toHaveKeys(['latitude', 'longitude', 'image', 'markerLogo', 'markerKind'])
        ->and($mount)->toContain('mount.dataset.mapVariant === "fullscreen"')
        ->and($component)->toContain('variant?: "section" | "fullscreen"')
        ->and($component)->toContain('h-[100dvh] min-h-[704px]')
        ->and($html)->toContain('h-[100dvh] min-h-[704px]')
        ->and($header)->toContain("request()->routeIs('office') ? 'h-0 bg-transparent' : 'h-16 bg-white'");
});

test('notch navbar uses Noto Sans Thai and a tighter balanced desktop layout', function () {
    $component = file_get_contents(base_path('components/ui/notch-navbar.tsx'));
    $header = view('components.header')->render();
    $layout = file_get_contents(base_path('resources/views/layouts/layout.blade.php'));
    $css = file_get_contents(base_path('resources/css/app.css'));

    expect($component)
        ->toContain('fixed inset-x-0 top-0 z-50 flex h-16 px-0')
        ->toContain('w-[min(1380px,calc(100vw-3rem))]')
        ->toContain('grid h-10 w-10')
        ->toContain('w-[48px]')
        ->toContain('justify-end')
        ->toContain('justify-start')
        ->toContain('text-[13px]')
        ->and($header)->toContain('<div class="h-16 bg-white" aria-hidden="true"></div>')
        ->and($layout)->toContain('family=Noto+Sans+Thai:wght@300;400;500;600;700;800')
        ->and($css)->toContain("--font-sans: 'Noto Sans Thai'");
});

test('notch navbar parent dropdown items are buttons instead of links', function () {
    $component = file_get_contents(base_path('components/ui/notch-navbar.tsx'));

    expect($component)
        ->toContain('function NavTrigger')
        ->toContain('hasChildren ? (')
        ->toContain('<NavTrigger')
        ->toContain('type="button"')
        ->toContain('aria-haspopup="menu"')
        ->toContain('role="menu"')
        ->toContain('role="menuitem"')
        ->toContain('item.children?.map')
        ->not->toContain('<Anchor' . PHP_EOL . '                href={item.href}');
});

test('footer uses a compact solid system color and places social links after the map address', function () {
    $footer = file_get_contents(base_path('resources/views/components/footer.blade.php'));

    expect($footer)
        ->toContain('<footer class="relative z-20 isolate bg-[#022c22] text-white font-sans mt-auto">')
        ->toContain('py-8')
        ->toContain('lg:grid-cols-[1.1fr_0.9fr_1.1fr_0.9fr]')
        ->toContain('footer-social-links')
        ->toContain('https://www.facebook.com/Sakofah.Islam.Savings/')
        ->toContain('https://www.youtube.com/channel/UCffHrfpeGIw4dlLCs-IEGDg')
        ->toContain('h-8 w-8')
        ->toContain('fa-brands fa-youtube text-sm')
        ->toContain('bg-[#022c22] py-3')
        ->not->toContain('fa-brands fa-line')
        ->not->toContain('w-10 h-10')
        ->not->toContain('py-12')
        ->not->toContain('bg-emerald-900')
        ->not->toContain('bg-green-900')
        ->not->toContain('bg-[#5f7f72]')
        ->not->toContain('bg-green-950');

    expect(strpos($footer, 'footer-social-links'))->toBeGreaterThan(strpos($footer, 'fa-phone-alt'));
});
