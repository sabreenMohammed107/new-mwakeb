@extends('layout.website.layout', ['Company' => $Company, 'title' => 'مواكب | الرئيسيه'])

@section('bottom-header')
    <x-website.header.home :company="$Company" :countries="$Countries" :cities="$cities" />
@endsection
@section('content')
    <style>

    </style>



    <!-- explore turkey -->
    <section class="investigtion">
        <div class="explore explore_position container">
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                <div class="row mx-0 explore_details ">
                    <div class=" col-xl-2 col-md-12 col-sm-12">
                        <div class="title">
                            <div class="info">
                                <h4>{{ __('links.explore') }} <br>{{ __('links.turkey') }} </h4>
                            </div>
                        </div>
                    </div>
                    <div class=" col-xl-10 col-md-12 col-sm-12">
                        <section class="explore_carsoul owl-carousel">
                            @foreach ($ExploreCities as $City)
                                <div class="card-content">
                                    <div class=" card explore_main">
                                        {{-- <div class="card-body explore_card" style="background-image: linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{asset("/website_assets/images/homePage/places/$City->image")}});"> --}}

                                        <div class="card-body explore_card"
                                            style="background-image:linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{ asset('uploads/explore') }}/{{ $City->image }});">

                                            <div class="header_info">
                                                <h5>
                                                    <a href="#">
                                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                            {{ $City->city->en_city }}
                                                        @else
                                                            {{ $City->city->ar_city }}
                                                        @endif

                                                    </a>
                                                </h5>
                                                <span>
                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                        {{ $City->subtitle_en }}
                                                    @else
                                                        {{ $City->subtitle_ar }}
                                                    @endif
                                                </span>
                                                <div class="explore_links">
                                                    <button class="btn ">
                                                        <a
                                                            href="{{ LaravelLocalization::getLocalizedURL($localVar, route('hotelByCity', $City->city->id)) }}">
                                                            <i class="fa-solid fa-hotel"></i>
                                                        </a>
                                                    </button>
                                                    <button class="btn ">
                                                        <a
                                                            href="{{ LaravelLocalization::getLocalizedURL($localVar, route('tourByCity', $City->city->id)) }}">
                                                            <i class="fa-solid fa-plane"></i>
                                                        </a>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </section>
                    </div>
                @else
                    <div class="row mx-0 explore_details ">

                        <div class=" col-xl-10 col-md-12 col-sm-12">
                            <section class="explore_carsoul owl-carousel">
                                @foreach ($ExploreCities as $City)
                                    <div class="card-content">
                                        <div class=" card explore_main">
                                            {{-- <div class="card-body explore_card" style="background-image: linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{asset("/website_assets/images/homePage/places/$City->image")}});"> --}}

                                            <div class="card-body explore_card"
                                                style="background-image:linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{ asset('uploads/explore') }}/{{ $City->image }});">

                                                <div class="header_info">
                                                    <h5>
                                                        <a href="#">
                                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                                {{ $City->city->en_city }}
                                                            @else
                                                                {{ $City->city->ar_city }}
                                                            @endif

                                                        </a>
                                                    </h5>
                                                    <span>
                                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                            {{ $City->subtitle_en }}
                                                        @else
                                                            {{ $City->subtitle_ar }}
                                                        @endif
                                                    </span>
                                                    <div class="explore_links">
                                                        <button class="btn ">
                                                            <a
                                                                href="{{ LaravelLocalization::getLocalizedURL($localVar, route('hotelByCity', $City->city->id)) }}">
                                                                <i class="fa-solid fa-hotel"></i>
                                                            </a>
                                                        </button>
                                                        <button class="btn ">
                                                            <a
                                                                href="{{ LaravelLocalization::getLocalizedURL($localVar, route('tourByCity', $City->city->id)) }}">
                                                                <i class="fa-solid fa-plane"></i>
                                                            </a>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </section>
                        </div>

                        <div class=" col-xl-2 col-md-12 col-sm-12">
                            <div class="title">
                                <div class="info">
                                    <h4 class="text-end">{{ __('links.explore') }} <br>{{ __('links.turkey') }} </h4>
                                </div>
                            </div>
                        </div>
            @endif
        </div>

        <!-- <img src="./images/homePage/birds.webp" alt="birds group"> -->
    </section>
    {{-- <x-website.home.offers :offers="$Offers" :title="$Company->limit_offer_endesc" /> --}}
    <!-- offers section -->
    <section class="offers">
        <div class="titles">
            <h3>
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                    LIMITED TIME OFFERS
                @else
                    عروض لفترة محدودة
                @endif
            </h3>
            <p>
                {{-- {!! $title!!} --}}
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                    Limit Offer When it comes to exploring exotic places, the choices are numerous. Whether you like
                    peaceful destinations or vibrant landscapes, we have offers for you.
                @else
                    عرض محدود عندما يتعلق الأمر باستكشاف أماكن غريبة ، فإن الخيارات عديدة. سواء كنت تحب الوجهات الهادئة أو
                    المناظر الطبيعية النابضة بالحياة ، لدينا عروض لك.
                @endif
            </p>
        </div>
        <div class="offers_details container">
            <div class="row mx-0">
                <div class="col-sm-12 col-md-12 col-xl-5 p-0">
                    <div class="card-content ">
                        <div class=" card">
                            <div class="card-body explore_card adventure_mind">
                                <div class="header_info">
                                    <h5>
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            {{ $mainOffer->subtitle_en }}
                                        @else
                                            {{ $mainOffer->subtitle_ar }}
                                        @endif
                                    </h5>
                                    <p>
                                        {{-- @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            {{ $mainOffer->offer_enoverview }}
                                        @else
                                            {{ $mainOffer->offer_aroverview }}
                                        @endif --}}
                                    </p>
                                    <div class="start">
                                        <span></span>
                                        {{-- <h6>@if (LaravelLocalization::getCurrentLocale() === 'en')
                    start from

                      @else
                   يبدأ من
                      @endif</h6> --}}
                                        <span></span>
                                    </div>
                                    <span>أسعار تبدأ من {{$mainOffer->cost}} رس</span>
                                    <button class="btn">
                                        <a href="{{ LaravelLocalization::localizeUrl('/offers') }}">
                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                Go to offers
                                            @else
                                                مشاهدة العروض
                                            @endif
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-xl-7 p-0">
                    <div class="row mx-0">
                        @foreach ($Offers as $offer)
                            <div class="col-md-6 col-sm-12  p-0">
                                <div class="card-content">
                                    <div class=" card">
                                        <div class="card-body offers_card offer_place_1" onmouseenter="darkBG(this)"
                                            onmouseleave="rmvDarkBG(this)"
                                            style="background-image: linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{ asset('uploads/offers/' . str_replace(' ', '%20', $offer->image)) }});">
                                            <div class="header_info">
                                                <h5><a href="{{ LaravelLocalization::localizeUrl('/single-offer/' . $offer->id . '/' . $offer->slug) }}"
                                                        class="stretched-link">
                                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                            {{ $offer->city->en_city ?? '' }}
                                                        @else
                                                            {{ $offer->city->ar_city ?? '' }}
                                                        @endif
                                                    </a>
                                                </h5>
                                                <span>
                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                        {{ $offer->subtitle_en }}
                                                    @else
                                                        {{ $offer->subtitle_ar }}
                                                    @endif
                                                </span>
                                                <span> {{$offer->cost}} رس</span>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- booking section -->
    <section class="booking">

        <img class="w-100" src="{{ asset('/website_assets/images/homePage/slider-mask.webp') }}" alt="slider mask">
        <div class="booking_details">
            <div class="row mx-0">
                <div class=" col-xl-6 col- md-6 col-sm-12 p-0">
                    <div class="images"
                        style="background-image:url('@if ($Company->book_img) {{ asset("uploads/company/$Company->book_img") }} @else {{ asset('/website_assets/images/homePage/slider-mask.webp') }} @endif') ">
                        <button type="button" class="btn js-modal-btn " data-video-url="{{ $Company->book_tour_vedio }}"
                            data-bs-toggle="modal" data-bs-target="#video">
                            <img src="{{ asset('/website_assets/images/homePage/play_button.webp') }}"
                                alt=" video play button">
                        </button>
                    </div>
                </div>
                <div class=" col-xl-6 col- md-6 col-sm-12 p-0">
                    <div class="right_side">
                        <div class="heading">
                            <h2>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $Company->book_tour_en_title }}
                                @else
                                    {{ $Company->book_tour_ar_title }}
                                @endif

                            </h2>
                            <p>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $Company->book_tour_en_desc }}
                                @else
                                    {{ $Company->book_tour_ar_desc }}
                                @endif

                            </p>
                            <a href="{{ LaravelLocalization::localizeUrl('/offers') }}">
                                {{-- {{ __('links.readMore') }} --}}
                                عروضنا
                                <i class="fa-solid fa-angle-double-left"></i>
                                {{-- <i class="fa-solid fa-angle-left"></i> --}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('adds_js')
    <script>
        $(document).ready(function() {
            $('.dynamic').change(function() {

                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = $(this).val();


                    $.ajax({
                        url: "{{ route('dynamicSearchCity.fetch') }}",
                        method: "get",
                        data: {
                            select: select,
                            value: value,

                        },
                        success: function(result) {

                            $('#city_id').html(result);
                        }

                    })
                }
            });
        });


        function getNumberOfDays(start, end) {
            const date1 = new Date(start);
            const date2 = new Date(end);

            // One day in milliseconds
            const oneDay = 1000 * 60 * 60 * 24;

            // Calculating the time difference between two dates
            const diffInTime = date2.getTime() - date1.getTime();

            // Calculating the no. of days between two dates
            const diffInDays = Math.round(diffInTime / oneDay);
            $('#nights').val(diffInDays);
            return diffInDays;
        }
    </script>
@endsection
