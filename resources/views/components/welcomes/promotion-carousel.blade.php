@php
    $promotions = config('site-content.promotions');

    $promotionSlides = collect($promotions)->map(function ($promo) {
        return [
            'id' => 'promo_' . $promo['id'],
            'title' => 'โปรโมชั่นสหกรณ์',
            'subtitle' => 'ข่าวสารและแคมเปญล่าสุดจากสหกรณ์อิสลามษะกอฟะฮ จำกัด',
            'image' => asset($promo['slide_image']),
            'modalId' => $promo['modal_content'] ? 'promo_modal_' . $promo['id'] : null,
            'type' => 'promotion',
        ];
    })->values();

    $newsSlides = collect();
@endphp

<div
    data-promotion-news-showcase
    data-promotions='@json($promotionSlides)'
    data-news='@json($newsSlides)'
></div>

@foreach ($promotions as $promo)
    @if ($promo['modal_content'])
        <dialog id="promo_modal_{{ $promo['id'] }}" class="modal">
            <div
                class="modal-box w-11/12 {{ $promo['modal_type'] == 'video' ? 'max-w-5xl p-0 bg-black' : 'max-w-4xl p-0' }} rounded-xl relative overflow-hidden">

                <form method="dialog">
                    <button
                        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 z-50 {{ $promo['modal_type'] == 'video' ? 'text-white bg-black/50 hover:bg-black' : 'text-gray-600 bg-white/70 hover:bg-white' }}">x</button>
                </form>

                @if ($promo['modal_type'] == 'image')
                    <img src="{{ asset($promo['modal_content']) }}" class="w-full h-auto block" alt="รายละเอียดโปรโมชั่น">
                @elseif ($promo['modal_type'] == 'video')
                    <div class="aspect-video w-full">
                        <iframe class="w-full h-full" src="{{ $promo['modal_content'] }}" title="Promotion video"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                @endif
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    @endif
@endforeach
