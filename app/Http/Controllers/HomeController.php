<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $information = DB::table('news')->orderByDesc('dateupload')->where('news_typeid', 1)->limit(8)->get();
        $welfare     = DB::table('news')->orderByDesc('dateupload')->where('news_typeid', 2)->limit(8)->get();
        $credit      = DB::table('news')->orderByDesc('dateupload')->where('news_typeid', 3)->limit(8)->get();
        $foundation  = DB::table('news')->orderByDesc('dateupload')->where('news_typeid', 4)->limit(8)->get();
        return view('welcome', compact('information', 'welfare', 'credit', 'foundation'));
    }

    public function acceptCookie(Request $request)
    {
        session(['cookie_accepted' => true]);
        DB::table('visited_history')->insert([
            'login_time' => now(),
            'ip_address' => $request->ip(),
            'browser'    => (new Agent())->browser(),
            'version'    => (new Agent())->version((new Agent())->browser()),
            'platform'   => (new Agent())->platform(),
        ]);
        return response()->json(['status' => 'ok']);
    }

    public function track(Request $request)
    {
        $agent = new Agent();

        DB::table('visited_history')->insert([
            'login_time' => now(),
            'ip_address' => $request->ip(),
            'browser'    => $agent->browser(),
            'version'    => $agent->version($agent->browser()),
            'platform'   => $agent->platform(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['status' => 'ok']);
    }
    public function history()
    {
        return view('main.about.history');
    }
    public function vision()
    {
        return view('main.about.vision');
    }
    public function manager()
    {
        return view('main.about.manager');
    }
    public function office()
    {
        return view('main.about.office');
    }
    public function mobile()
    {
        return view('main.about.mobile');
    }

    public function structure()
    {
        return view('main.about.structure');
    }

    public function register()
    {
        return view('main.services.register');
    }

    public function deposit()
    {
        // We structure the data from the text file into a clean PHP array.
        $depositServices = [
            [
                'name'       => 'เงินฝากวาดีอะฮ',
                'subtitle'   => '(รักษาทรัพย์)',
                'icon_svg'   =>
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.286zm0 13.036h.008v.008h-.008v-.008z" /></svg>',
                'color'      => 'blue',
                'features'   => [
                    'เหมาะสำหรับการออมระยะสั้น หรือใช้เป็นบัญชีหมุนเวียน ฝากถอนได้ทุกวันทำการ',
                    'ใช้บริการฝากถอนได้ทุกสาขาและหน่วยบริการเคลื่อนที่ โดยไม่มีค่าธรรมเนียม',
                    'ใช้เป็นบัญชีเพื่อหักชำระค่าหุ้น หรือหนี้สินกับสหกรณ์ได้',
                    'ใช้สำหรับรองรับเงินปันผล',
                ],
                'conditions' => [
                    'เปิดบัญชีครั้งแรกไม่ต่ำกว่า 100 บาท',
                    'ฝาก-ถอน ได้ตลอดเวลาทำการ',
                    'เป็นการออมเพื่อให้สหกรณ์ฯ รักษาทรัพย์ โดยไม่มีผลตอบแทน',
                ],
            ],
            [
                'name'       => 'เงินฝากมูฏอรอบะฮ',
                'subtitle'   => '(ร่วมลงทุน)',
                'icon_svg'   =>
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-3.75-2.25M21 18l-3.75-2.25m0 0l-3.75 2.25M15 15.75l-3.75 2.25" /></svg>',
                'color'      => 'green',
                'features'   => [
                    'เป็นบัญชีเงินฝากเพื่อการร่วมลงทุนธุรกิจกับสหกรณ์ภายใต้หลักมูฎอรอบะฮ',
                    'ใช้บริการฝากถอนได้ทุกสาขารวมถึงหน่วยบริการสหกรณ์เคลื่อนที่ได้โดยไม่มีค่าธรรมเนียม',
                ],
                'conditions' => [
                    'เปิดบัญชีครั้งแรกไม่ต่ำกว่า 10,000 บาท',
                    'ฝาก - ถอน ได้ตลอดเวลาทำการ',
                    'มีปันผลให้แก่สมาชิก ทุกๆ 3 เดือน ตามไตรมาสสหกรณ์',
                ],
            ],
            [
                'name'       => 'เงินฝากพิเศษ เพื่อการศึกษา',
                'subtitle'   => null,
                'icon_svg'   =>
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>',
                'color'      => 'purple',
                'features'   => [
                    'เหมาะกับบุตรหลานที่ผู้ปกครองต้องการฝากเงินสะสมให้จนโต',
                    'เมื่อครบกำหนด 5 ปี สามารถปิดบัญชีพร้อมรับทุนการศึกษาจากสหกรณ์',
                    'สามารถฝากสะสมต่อไปได้อีก หากยังไม่ต้องการปิดบัญชี',
                ],
                'conditions' => [
                    'เปิดบัญชีครั้งแรกตั้งแต่ 200 / 500 / 1,000 / 1,500 บาท',
                    'ฝากเป็นประจำทุกเดือนตามจำนวนเงินที่เปิดบัญชี',
                    'ฝากต่อเนื่องครบ 5 ปี สหกรณ์ฯ จะสมทบทุนการศึกษาให้ 1,200 / 3,000 / 6,000 / 9,000 บาท',
                ],
            ],
            [
                'name'       => 'เงินฝากพิเศษ ฮัจย์-อุมเราะห์',
                'subtitle'   => null,
                'icon_svg'   =>
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" /></svg>',
                'color'      => 'yellow',
                'features'   => [
                    'บัญชีเพื่อการออมเงินแบบมีเป้าหมายเพื่อการประกอบพิธีฮัจย์หรืออุมเราะห์',
                    'การถอนเงินจะทำได้ก็ต่อเมื่อถึงกำหนดเวลาเดินทางไปประกอบพิธี',
                ],
                'conditions' => [
                    'เปิดบัญชีครั้งแรกไม่ต่ำกว่า 500 บาท',
                    'เมื่อเงินฝากในบัญชีมีตั้งแต่ 10,000 บาทขึ้นไป จะได้รับเงินปันผลทุก 3 เดือน',
                ],
            ],
            [
                'name'       => 'เงินฝากพิเศษ เพื่อกุรบาน',
                'subtitle'   => null,
                'icon_svg'   =>
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>',
                'color'      => 'red',
                'features'   => [
                    'บัญชีเพื่อการออมเงินแบบมีเป้าหมายเพื่อการทำกุรบาน',
                    'การถอนเงินจะกระทำได้กรณีทำกุรบานหรือถอนเพื่อปิดบัญชีเท่านั้น',
                ],
                'conditions' => ['เปิดบัญชีครั้งแรกไม่ต่ำกว่า 500 บาท', 'ฝากครั้งต่อไปไม่ต่ำกว่า 200 บาท'],
            ],
        ];
        return view('main.services.deposit', compact('depositServices'));
    }

    public function credit_service()
    {
        // จัดโครงสร้างข้อมูลสินเชื่อทั้งหมด
        $loanProducts = [
            [
                'id'            => 'ordinary',
                'name'          => 'เงินกู้ยืมสามัญ',
                'image'         => 'images/loans/347-เงินกู้ยืมสามัญ.jpg',
                'qualification' => 'เป็นสมาชิกตั้งแต่ 6 เดือนขึ้นไป',
                'max_amount'    => 'ไม่เกิน 100,000 บาท',
                'max_period'    => 'ไม่เกิน 60 งวด',
                'collateral'    => ['วงเงินไม่เกิน 40,000 บาท ไม่ต้องมีหลักประกัน', 'วงเงินตั้งแต่ 40,001 บาทขึ้นไป ใช้บุคคลหรือหลักทรัพย์ค้ำประกัน (โฉนดที่ดิน, นส.3ก)'],
                'fees'          => ['ค่าธรรมเนียมสัญญา 300 บาท', 'ค่าบริการและค่าประเมินหลักทรัพย์ตามที่สหกรณ์กำหนด'],
                'purpose'       => ['เพื่อการซื้อที่ดินสวนยาง สวนปาล์มน้ำมัน, ที่ดินเปล่า', 'เพื่อการก่อสร้าง / ต่อเติม', 'เพื่อการซื้อยานพาหนะ', 'เพื่อการศึกษา', 'เพื่อการลงทุนประกอบอาชีพ'],
                'theme_color'   => 'sky',
            ],
            [
                'id'            => 'emergency',
                'name'          => 'เงินกู้ยืมฉุกเฉิน',
                'image'         => 'images/loans/352-เงินกู้ยืมฉุกเฉิน.jpg',
                'qualification' => 'เป็นสมาชิกตั้งแต่ 6 เดือนขึ้นไป',
                'max_amount'    => 'ไม่เกิน 20,000 บาท (แต่ไม่เกิน 80% ของมูลค่าหุ้น)',
                'max_period'    => 'ไม่เกิน 6 งวด',
                'collateral'    => ['เงินทุนเรือนหุ้น'],
                'fees'          => ['ค่าธรรมเนียมสัญญา 100 บาท'],
                'purpose'       => ['เพื่อให้สมาชิกกู้ยืมเงินโดยสหกรณ์ไม่คิดค่าบริการ'],
                'theme_color'   => 'red',
            ],
            [
                'id'            => 'emergency_ordinary',
                'name'          => 'เงินกู้ยืมสามัญฉุกเฉิน',
                'image'         => 'images/loans/351-เงินกู้ยืมสามัญฉุกเฉิน.jpg',
                'qualification' => 'เป็นสมาชิกตั้งแต่ 6 เดือนขึ้นไป',
                'max_amount'    => 'ไม่เกิน 1,000,000 บาท (แต่ไม่เกิน 90% ของมูลค่าหุ้น)',
                'max_period'    => 'ไม่เกิน 60 งวด',
                'collateral'    => ['เงินทุนเรือนหุ้น'],
                'fees'          => ['ค่าธรรมเนียมสัญญา 200 บาท', 'อัตราค่าบริการตามที่สหกรณ์กำหนด'],
                'purpose'       => ['เพื่อการซื้อที่ดินสวนยาง สวนปาล์มน้ำมัน', 'เพื่อการก่อสร้าง / ต่อเติม', 'เพื่อการซื้อยานพาหนะ', 'เพื่อการศึกษา', 'เพื่อการลงทุนประกอบอาชีพ'],
                'theme_color'   => 'amber',
            ],
            [
                'id'            => 'special',
                'name'          => 'เงินกู้ยืมพิเศษ',
                'image'         => 'images/loans/348-เงินกู้ยืมพิเศษ.jpg',
                'qualification' => 'เป็นสมาชิกตั้งแต่ 6 - 60 เดือน',
                'max_amount'    => 'ไม่เกิน 1,000,000 บาท',
                'max_period'    => 'ไม่เกิน 120 งวด',
                'collateral'    => ['โฉนดที่ดิน', 'นส.3ก.'],
                'fees'          => ['ค่าธรรมเนียมสัญญา 1,000 บาท', 'ค่าประเมินหลักทรัพย์', 'อัตราค่าบริการตามที่สหกรณ์กำหนด'],
                'purpose'       => ['เพื่อการซื้อที่ดินสวนยาง สวนปาล์มน้ำมัน', 'เพื่อการก่อสร้าง / ต่อเติม', 'เพื่อการซื้อยานพาหนะ', 'เพื่อการศึกษา', 'เพื่อการลงทุนประกอบอาชีพ'],
                'theme_color'   => 'teal',
            ],
            [
                'id'            => 'project_asset',
                'name'          => 'เงินกู้ยืมโครงการสินทรัพย์',
                'image'         => 'images/loans/350-เงินกู้ยืมโครงการสินทรัพย์.jpg',
                'qualification' => 'เป็นสมาชิกตั้งแต่ 6 เดือนขึ้นไป',
                'max_amount'    => 'ไม่เกิน 10,000,000 บาท',
                'max_period'    => 'ไม่เกิน 240 งวด',
                'collateral'    => ['เงินฝาก', 'โฉนดที่ดิน, นส.3ก.'],
                'fees'          => ['ค่าธรรมเนียมสัญญา 1,000 บาท', 'ค่าประเมินหลักทรัพย์', 'อัตราค่าบริการตามที่สหกรณ์กำหนด'],
                'purpose'       => ['เพื่อการซื้อสินทรัพย์ของสหกรณ์', 'เพื่อการซื้อหุ้นธุรกิจของสหกรณ์'],
                'theme_color'   => 'indigo',
            ],
            [
                'id'            => 'project',
                'name'          => 'เงินกู้ยืมโครงการ',
                'image'         => 'images/loans/349-เงินกู้ยืมโครงการ.jpg',
                'qualification' => 'เป็นสมาชิกตั้งแต่ 6 เดือนขึ้นไป',
                'max_amount'    => 'ไม่เกิน 20,000,000 บาท',
                'max_period'    => 'ไม่เกิน 240 งวด',
                'collateral'    => ['เงินฝาก', 'ที่ดินโฉนด', 'นส.3ก.', 'นส.3'],
                'fees'          => ['ค่าธรรมเนียมสัญญา 1,000 บาท', 'ค่าประเมินหลักทรัพย์', 'อัตราค่าบริการตามที่สหกรณ์กำหนด'],
                'purpose'       => ['เพื่อการลงทุนโครงการต่างๆ ของสหกรณ์', 'เพื่อการก่อสร้าง', 'เพื่อการซื้อหุ้นธุรกิจของสหกรณ์'],
                'theme_color'   => 'slate',
            ],
        ];

        $definitions = [
            ['term' => 'มูรอบาฮะ', 'definition' => 'คือ การทำสัญญากู้ยืมที่สหกรณ์แจ้งต้นทุนและค่าบริการ พร้อมทั้งเงื่อนไขการผ่อนชำระเป็นงวดๆ ภายในระยะเวลาที่กำหนด ให้แก่สมาชิกได้รับทราบขณะทำสัญญาซื้อขาย'],
            ['term' => 'หลักประกัน', 'definition' => 'คือ หลักทรัพย์ค้ำประกัน ประกอบด้วย หุ้น, เงินฝาก, ทรัพย์สิน (ที่ดิน โฉนด, น.ส.3ก., น.ส.3)'],
            ['term' => 'ค่าบริการ', 'definition' => 'คือ ค่าดำเนินการบริการ หรือการคิดกำไรจากการอำนวยสินเชื่อเงินยืม'],
            ['term' => 'ค่าธรรมเนียม', 'definition' => 'คือ ค่าใช้จ่ายในการเรียกเก็บสมาชิกในการทำสัญญาตามอัตราที่กำหนด'],
        ];

        return view('main.services.credit', compact('loanProducts', 'definitions'));
    }

    public function marry()
    {
        return view('main.welfare.marry');
    }

    public function maternity()
    {
        return view('main.welfare.maternity');
    }

    public function oldage()
    {
        return view('main.welfare.oldage');
    }

    public function medical()
    {
        return view('main.welfare.medical');
    }

    public function dead()
    {
        return view('main.welfare.dead');
    }

    public function activity()
    {
        $news = DB::table('news')->orderByDesc('dateupload')->paginate(21);
        return view('main.news.activity', compact('news'));
    }

    public function article($id)
    {
        $image_news = DB::table('picture')->where('news_number', $id)->get();
        $news       = DB::table('news')->where('news_number', $id)->first();
        $side_news  = DB::table('news')->orderByDesc('dateupload')->where('news_number', '!=', $id)->limit(10)->get();
        return view('main.news.article', compact('image_news', 'news', 'side_news'));
    }

    public function calender()
    {
        $months       = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
        $currentMonth = date('n') - 1;
        return view('main.news.calendar', compact('months', 'currentMonth'));
    }

    public function homeList()
    {
        $asset = DB::table('asset')->where('asset.asset_type', '1')->paginate(21);
        return view('main.asset.homeList', compact('asset'));
    }
    public function vacantList()
    {
        $asset = DB::table('asset')->where('asset.asset_type', '2')->paginate(10);
        return view('main.asset.vacantList', compact('asset'));
    }
    public function condoList()
    {
        $asset = DB::table('asset')->where('asset.asset_type', '3')->paginate(10);
        return view('main.asset.condoList', compact('asset'));
    }

    public function home($id)
    {
        $image  = DB::table('asset_picture')->where('id', $id)->get();
        $detail = DB::table('asset')->where('id', $id)->first();
        return view('main.asset.homeshow', compact('image', 'detail'));
    }

    public function vacant($id)
    {
        $image  = DB::table('asset_picture')->where('id', $id)->get();
        $detail = DB::table('asset')->where('id', $id)->first();
        return view('main.asset.vacantshow', compact('image', 'detail'));
    }

    public function condo($id)
    {
        $image  = DB::table('asset_picture')->where('id', $id)->get();
        $detail = DB::table('asset')->where('id', $id)->first();
        return view('main.asset.condoshow', compact('image', 'detail'));
    }

    public function document()
    {
        return view('main.download.document');
    }
    public function businessreport()
    {
        return view('main.download.businessreport');
    }

    public function withus()
    {
        return view('main.contact.withus');
    }
}
