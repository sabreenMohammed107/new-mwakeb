<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- facebook meta tags -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Safer - Online hub for booking  trourism trips" />
    <meta property="og:description"
        content="Safer providing you online planning  your  next vacations and  booking trips around the world" />
    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large" />
    <link rel="canonical" href="{{ url()->current() }}" />

    <meta property="og:url" content="https://safercom/" />
    <meta property="og:image" content="./images/homePage/logo.webp" />
    <meta property="og:image:alt" content="Safer - Online hub for booking  trourism trips" />
    <meta property="og:site_name" content="safer.com" />
    <!-- twitter meta tags -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="safer.com">
    <meta name="twitter:creator" content="safer.com">
    <meta name="twitter:title" content="Safer - Online hub for booking  trourism trips" />
    <meta name="twitter:description"
        content="Safer providing you online planning  your  next vacations and  booking trips around the world " />
    <meta name="twitter:url" content="https://safer.travel/" />
    <meta name="twitter:image" content="/images/homePage/logo.webp" />
    <meta property="twitter:image:alt" content="Safer - Online hub for booking  trourism trips" />
    <!-- general meta tags  -->
    <meta name="canonical_tag" content="https://safer.travel/" />
    <meta name="title" content="Safer - Online hub for booking  trourism trips" />
    <meta name="description"
        content="Safer providing you online planning  your  next vacations and  booking trips around the world" />
    <meta name="image" content="/images/homePage/logo.webp" />
    <meta property="image:alt" content="Safer - Online hub for booking  trourism trips" />
    <meta name="keywords"
        content="hotels tours transfer visa contact trip destination adults child nights checkin room explore adventure experience offers travel packages agents acitivties hotel  transfer honemoon safari pharonic newsletter   " />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- style sheets  -->
    <!-- fontawesome  -->
    <link rel="stylesheet" href="{{ asset('/website_assets/css/all.min.css') }}">
    <!-- fonts google -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap"
        rel="stylesheet">
    <!-- bootstrap -->
    @if (LaravelLocalization::getCurrentLocale() === 'en')
        <link rel="stylesheet" href="{{ asset('/website_assets/css/bootstrap/bootstrap.min.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('/website_assets/css/bootstrap/bootstrap-ar.min.css') }}">
    @endif
    <!-- normalize -->
    @if (LaravelLocalization::getCurrentLocale() === 'en')
        <link rel="stylesheet" href="{{ asset('/website_assets/css/normalize.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('/website_assets/css/normalize-ar.css') }}">
    @endif
    <!-- slick cdn link -->
    <link rel="stylesheet" href="{{ asset('/website_assets/slick/slick-1.8.1/slick/slick.css') }}">
    <!-- video poppp styele -->
    <link rel="stylesheet"
        href="{{ asset('/website_assets/js/appleple-modal-video-78d211f/css/modal-video.min.css') }}">
    <!-- stylesheet  -->
    {{--
    <link rel="stylesheet" href="{{ asset('/website_assets/css/my-profile.css')}}"> --}}
    @if (LaravelLocalization::getCurrentLocale() === 'en')
        <link rel="stylesheet" href="{{ asset('/website_assets/css/style.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('/website_assets/css/style-ar.css') }}">
    @endif
    {{-- owl Carousel links --}}
    <link rel="stylesheet" href="{{ asset('/website_assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/owl.theme.default.css') }}">
    {{-- owl Carousel links --}}
    <!-- icon -->
    <link rel="icon" href="{{ asset('/website_assets/images/homePage/2.png') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/whatsappStyle.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @yield('adds_css')
    <title> {{ $title }} </title>
</head>

<body>

    <!-- start of nav bar  and mega menu -->

    <section class="landing_section ">
        <x-website.header />
        @yield('bottom-header')
    </section>

    @yield('content')

    <!--  ending page  -->
    <section class="ending">
        <div class="newsletter">
            <div class="container">
                <div class="row mx-0 align-items-center">
                    <div class="col-md-6 col-sm-12">
                        <span>


                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                Prepare yourself and let's <br>
                                explore the beauty of the world
                            @else
                                جهز نفسك <br>
                                لإستكشاف جمال العالم
                            @endif

                        </span>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <form action="{{ url('/sendNewsLetter') }}" method="POST">
                            @csrf
                            <div class="input-group input">
                                <input type="email" name="email" class="form-control"
                                    placeholder="{{ __('links.enter_email') }}" aria-label="Recipient's username"
                                    aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit">

                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        Join our newsletter
                                    @else
                                        اشترك في صحيفتنا الإخبارية
                                    @endif
                                </button>
                            </div>


                    </div>
                    </form>
                </div>
            </div>
        </div>

        <footer>
            <div class="container">
                <div class="row mx-0">
                    <div class="col-xl-4 col-md-12 col-sm-12">
                        <div class="left_info">
                            <h6>{{ __('links.about_us') }} </h6>
                            <p style="text-align: justify; padding:0 10px">
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $Company->overview_en }}
                                @else
                                    {{ $Company->overview_ar }}
                                @endif
                            </p>
                        </div>
                    </div>
                    <!-- useful links -->

                    <div class="col-xl-4 col-md-6 col-sm-12">
                        <div class="useful_links">
                            <h6>{{ __('links.useful') }} </h6>
                            <div class="row mx-0">
                                <div class="col-6">
                                    <ul>
                                        <li><i class="fa-solid fa-angle-right"></i><a
                                                href="{{ LaravelLocalization::localizeUrl('/') }}">
                                                {{ __('links.home') }} </a>
                                        </li>
                                        <li><i class="fa-solid fa-angle-right"></i><a
                                                href="{{ LaravelLocalization::localizeUrl('/about') }}">{{ __('links.about_us') }}
                                            </a></li>
                                        <li><i class="fa-solid fa-angle-right"></i><a
                                                href="{{ LaravelLocalization::localizeUrl('/offers') }}">{{ __('links.offers') }}
                                            </a></li>
                                        <li><i class="fa-solid fa-angle-right"></i><a
                                                href="{{ LaravelLocalization::localizeUrl('/blogs') }}">{{ __('links.blogs') }}
                                            </a></li>

                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul>

                                        <li><i class="fa-solid fa-angle-right"></i><a
                                                href="{{ LaravelLocalization::localizeUrl('/terms') }}">{{ __('links.term_condation') }}</a>
                                        </li>

                                        <li><i class="fa-solid fa-angle-right"></i><a
                                                href="{{ LaravelLocalization::localizeUrl('/policies/replacement') }}">سياسة
                                                الاستبدال</a></li>

                                        <li><i class="fa-solid fa-angle-right"></i><a
                                                href="{{ LaravelLocalization::localizeUrl('/policies/refund') }}">سياسةالاسترجاع</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="col-12">
                                    <a href="http://" class="pay-link  "> <img
                                            src="{{ asset('img/payment/visa.png') }}" alt="visa"
                                            srcset=""></a>


                                    <a href="http://" class="pay-link "> <img
                                            src="{{ asset('img/payment/google-pay.png') }}" alt="google-pay"
                                            srcset=""></a>


                                    <a href="http://" class="pay-link "> <img
                                            src="{{ asset('img/payment/apple-pay.png') }}" alt="apple-pay"
                                            srcset=""></a>


                                    <a href="http://" class="pay-link "> <img
                                            src="{{ asset('img/payment/mastercard.png') }}" alt="mastercard"
                                            srcset=""></a>


                                    <a href="http://" class="pay-link "> <img
                                            src="{{ asset('img/payment/samsung-pay.png') }}" alt="samsung-pay"
                                            srcset=""></a>


                                    <a href="http://" class="pay-link "> <img
                                            src="{{ asset('img/payment/stripe.png') }}" alt="stripe"
                                            srcset=""></a>
                                                    <a href="http://" class="pay-link "> <img
                                                            src="{{ asset('img/payment/mada-logo.png') }}" alt="mada-logo"
                                                            srcset=""></a>
                                                    <a href="http://" class="pay-link "> <img
                                                            src="{{ asset('img/payment/tabby.png') }}" alt="tabby"
                                                            srcset=""></a>
                                                    <a href="http://" class="pay-link "> <img
                                                            src="{{ asset('img/payment/tamara.png') }}" alt="tamara"
                                                            srcset=""></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- contact details -->
                                    <div class="col-xl-4 col-md-6">
                                        <div class="contact_details">
                                            <h6>{{ __('links.contact_us') }}</h6>

                                            <div class="contact_info" style="margin-bottom: 10px;">
                                                <div class="info">
                                                    <i class="fa-solid fa-phone"></i>
                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                    <span>For individuals: </span>
                                                    @else
                                                    <span> للافراد :</span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="contact_info" style="margin-bottom: 10px;">
                                                <div class="info" style="margin-left: 25px;">

                                                    <span>
                                                        {!! $master->phone !!} </span>
                                                </div>
                                            </div>
                                             <div class="contact_info" style="margin-bottom: 10px;">
                                                <div class="info">
                                                    <i class="fa-solid fa-phone"></i>
                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                    <span>
                                                        For companies: {!! $master->phone !!}</span>
                                                    @else
                                                    <span>
                                                        للشركات: 0543998011 </span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="contact_info" style="margin-bottom: 10px;">
                                                <div class="info">
                                                    <i class="fa-solid fa-envelope"></i>
                                                    <span>{{ $master->email }}</span>
                                                </div>
                                            </div>
                                            <div class="contact_info" style="margin-bottom: 10px;">
                                                <div class="info">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                                    <span>
                                                        {{ $master->detailed_address_ar }}                                                    </span>

                                                    @else
                                                    <span>
                                                        {{ $master->detailed_address_ar }}                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="contact_info" style="margin:0">

                                                <div class="icons-container">
                                                    <div class="social-icons spinned">
                                                        @if ($comFooter->facebook)

                                                        <a class="item facebook" href="{{ $comFooter->facebook }}" target="_blank" ><i
                                                                class="fa-brands fa-facebook-f"></i></a>
                                                        @endif
                                                        @if ($comFooter->youtube)

                                                        <a class="item youtube" href="{{ $comFooter->youtube }}" target="_blank" ><i
                                                                class="fa-brands fa-youtube"></i></a>
                                                        @endif
                                                        @if($comFooter->instagram)
                                                        <a class="item instagram" href="{{ $comFooter->instagram }}" target="_blank" ><i
                                                                class="fa-brands fa-instagram"></i></a>
                                                        @endif
                                                        @if($comFooter->x)
                                                        <a class="item x" href="{{ $comFooter->x }}" target="_blank" >
                                                            <svg style="width:40%;fill:var(--main-color);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>
                                                        </a>
                                                        @endif
                                                        @if($comFooter->snapchat)
                                                        <a class="item snapchat" href="{{ $comFooter->snapchat }}" target="_blank" ><i
                                                                class="fa-brands fa-snapchat-ghost"></i></a>
                                                        @endif
                                                        @if($comFooter->chat_whatsapp)
                                                        <a class="item whatsapp"  href="https://{{ $comFooter->chat_whatsapp }}" target="_blank" ><i
                                                                class="fa-brands fa-whatsapp"></i></a>
                                                        @endif
                                                        @if($comFooter->tiktok)
                                                        <a class="item tiktok" href="{{ $comFooter->tiktok }}" target="_blank" ><i
                                                                class="fa-brands fa-tiktok"></i></a>
                                                        @endif
                                                        @if($comFooter->email)
                                                        <a class="item email" href="mailto:{{ $comFooter->email }}" target="_blank" ><i
                                                            class="fa-regular fa-envelope"></i></a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>



                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            </div>

        </footer>
    </section>
    <!-- footer -->

    <!-- copy right section -->
    <div class="copyright text-center text-white">
        <input type="hidden" id="chat_whatsapp" value="{{ $Company->chat_whatsapp }}">
        @if (LaravelLocalization::getCurrentLocale() === 'en')
            <h6>All copyrights reserved to mwakeb 2024 </h6>
        @else
            <span>
                جميع حقوق النشر محفوظة لوكالة مواكب 2024</span>
        @endif

    </div>

    <a href="#" class="back-to-top"><i class="fa-solid fa-arrow-up"></i></a>

    <!-- javascripts links -->
    <!-- bootstrap 5.0v scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/website_assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- date picker range links -->
    {{-- <script src="  https://code.jquery.com/jquery-2.2.4.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> --}}


    <!-- date picker range links -->

    <!--   double date picker -->
    <!-- Include Required Prerequisites -->
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/1/jquery.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <script src="{{ asset('/website_assets/js/datepicker.js') }}"></script>

    <script src="{{ asset('/website_assets/js/momnet.js') }}"></script>
    {{-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> --}}
    <script src="{{ asset('/website_assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/website_assets/js/date_picker.js') }}"></script>

    <!-- Slick.s library -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="{{ asset('/website_assets/slick/slick-1.8.1/slick/slick.min.js') }}"></script>
    <!-- explore carsoul for turkey section -->
    <script src="{{ asset('/website_assets/js/explore_carsoul.js') }}"></script>
    <!-- video popup library -->
    <script src="{{ asset('/website_assets/js/appleple-modal-video-78d211f/js/jquery-modal-video.min.js') }}"></script>
    <script src="{{ asset('/website_assets/js/appleple-modal-video-78d211f/js/modal-video.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('/website_assets/js/video.js') }}"></script>
    <!-- image gallery  -->
    <script src="{{ asset('/website_assets/js/image_gllery.js') }}"></script>
    <!-- adding room -->
    <script src="{{ asset('/website_assets/js/main.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.4/dayjs.min.js" integrity="sha512-Ot7ArUEhJDU0cwoBNNnWe487kjL5wAOsIYig8llY/l0P2TUFwgsAHVmrZMHsT8NGo+HwkjTJsNErS6QqIkBxDw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer=""defer"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"
        integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer="defer"></script>
    {{-- <script src="{{ asset('/website_assets/js/datepicker-bs4.js?')}}" defer="defer"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script> {{-- owl carousel --}}
    <script>
        $(document).ready(function() {
            $(document).on("click", "#send-it", function() {
        var chatInput = document.getElementById("chat-input");
        var chatWhatsapp = document.getElementById("chat_whatsapp").value;
        if (chatInput.value !== "") {
            var message = encodeURIComponent(chatInput.value);
            console.log(message,chatWhatsapp)
            var url = "https://web.whatsapp.com/send?phone=1274077377&text=" + message;

            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                url = "whatsapp://send?phone=" + chatWhatsapp + "&text=" + message;
            }

            window.open(url, "_blank");
        }
    });


    // $(document).on("click", ".informasi", function() {
    //     var getNumber = $(this).children(".my-number").text();
    //     var getNama = $(this).children(".info-chat").children(".chat-nama").text();
    //     var getLabel = $(this).children(".info-chat").children(".chat-label").text();

    //     $("#get-number").text(getNumber);
    //     $("#get-nama").text(getNama);
    //     $("#get-label").text(getLabel);

    //     $(".start-chat,.get-new").addClass("show").removeClass("hide");
    //     $(".home-chat,.head-home").addClass("hide").removeClass("show");
    // });

    $(document).on("click", ".close-chat", function() {
        $("#whatsapp-chat").addClass("hide").removeClass("show");
    });

    $(document).on("click", ".blantershow-chat", function() {
        $("#whatsapp-chat").addClass("show").removeClass("hide");
    });
            $(".owl-carousel").owlCarousel({
                items: 4,
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,

                    },
                    600: {
                        items: 2,
                        margin: 0
                    },
                    900: {
                        items: 3,
                        margin: 0

                    },
                    1345: {
                        items: 4,
                        margin: 0
                    }
                }
            });
        });
    </script>
    <script src="{{ asset('/website_assets/js/owl.carousel.min.js') }}"></script>
    {{-- owl carousel --}}
    <script src="{{ asset('/website_assets/js/add_room.js') }}"></script>
    <script src="{{ asset('/website_assets/js/adding_years_Select.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @yield('adds_js')
    <script>
        let slickSliders = document.querySelectorAll('.slick-slider');

        if ('IntersectionObserver' in window) {
            // IntersectionObserver Supported
            let config = {
                root: null,
                rootMargin: '0px',
                threshold: 0.0
            };

            let observer = new IntersectionObserver(onChange, config);
            slickSliders.forEach(slider => observer.observe(slider));

            function onChange(elements, observer) {
                elements.forEach(element => {
                    if (element.isIntersecting) {
                        console.log("element intersecting", element.target);

                        var options = {};
                        // Stop watching and load the slickSlider
                        loadSlick(element.target, options);
                        observer.unobserve(element.target);
                    }
                });
            }

        } else {
            // IntersectionObserver NOT Supported
            slickSliders.forEach(slickSlider => loadSlick(slickSlider));
        }

        function loadSlick(slickSlider, options) {
            $slickSlider = $(slickSlider);
            $slickSlider.slick(options);
        }
    </script>
</body>

</html>
