@extends('layout.website.layout', ['Company' => $Company, 'title' => 'مواكب | تواصل معنا'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/contacts-1.css') }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.contact_us') }}" :breadcrumb="$BreadCrumb" current="" />
@endsection
@section('content')
    <!-- socail channels -->
    <section class="socail_channels container">
        <h5>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                contact us via our social channels.
            @else
                اتصل بنا عبر قنواتنا الاجتماعية.
            @endif
        </h5>

        <div class="row mx-0">
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="card-content socail">
                    <div class=" card  socail_card">

                        <img src=" {{ asset('/website_assets/images/contact/location.webp') }}" alt=" location pin ">
                        <div class="card-body socail_info">
                            <div class="card_info">
                                <h6>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        Our Location
                                    @else
                                        موقعنا
                                    @endif

                                </h6>
                                <span>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {{ $master->detailed_address_en }}
                                    @else
                                        {{ $master->detailed_address_ar }}
                                    @endif


                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="card-content socail">
                    <div class=" card  socail_card">

                        <img src=" {{ asset('/website_assets/images/contact/call center.webp') }}"
                            alt=" call center logo  ">
                        <div class="card-body socail_info">
                            <div class="card_info">
                                <h6>

                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        phone number
                                    @else
                                        رقم الجوال
                                    @endif
                                </h6>
                                <span class="info">
                                    <a href="tel:{{ $master->phone }}">  @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {!! $master->phone !!}
                                    @else
                                    {!! $master->phone !!}
                                    @endif</a>
                                </span>
                                {{-- <span class="info">
                              <a href="tel:011551112211">011551112211</a>
                            </span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="card-content socail">
                    <div class=" card  socail_card">

                        <img src="{{ asset('/website_assets/images/contact/message.webp') }}" alt="messages logo ">
                        <div class="card-body socail_info">
                            <div class="card_info">
                                <h6>
                                    البريد الإلكتروني
                                </h6>
                                <span class="info">
                                    <a href="mailto:{{ $master->email }}"> {{ $master->email }}</a>

                                </span>
                                {{-- <span class="info">
                          <a href="mailto:ADMIN@yahoo.com">ADMIN@yahoo.com</a>

                        </span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4 mt-2"></div>

        </div>
    </section>
    <!-- need help section -->
    <section class="help_section socail_channels">


        <img class="w-100" src=" {{ asset('/website_assets/images/hotel-details/slider-mask_top.webp') }}" alt=" slider mask top">
        <img class="w-100" src="{{ asset('/website_assets/images/hotel-details/slider-mask-bottom.webp') }}" alt=" slider mask bottom">
        <div class="container">

            <h5>
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                    We Provide Best Services <br>
                    Need Help?
                @else
                    نحن نقدم أفضل الخدمات <br>
                    تحتاج مساعدة؟
                @endif
            </h5>
            @if (Session::has('flash_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" <strong><i
                        class="fa fa-check-circle"></i> {{ session('flash_success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form action="{{ route('contact.store') }}" method="post">
                @csrf
                <div class="row mx-0">
                    <div class="col-md-12 col-xl-6 col-sm-12">
                        <div class="mb-3">
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control {{ $errors->has('name') ? 'error' : '' }}" id="name"
                                placeholder="{{ __('links.name') }}
                                " required>
                            @if ($errors->has('name'))
                                <div class="error">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}"
                                name="email" value="{{ old('email') }}" id="email"
                                placeholder=" {{ __('links.email') }}
                                " required>
                            @if ($errors->has('email'))
                                <div class="error">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="number" value="{{ old('phone') }}"
                                class="form-control {{ $errors->has('phone') ? 'error' : '' }}" name="phone"
                                id="phone" placeholder="{{ __('links.mobile') }}
                                "
                                required>
                            @if ($errors->has('phone'))
                                <div class="error">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-6 col-sm-12">
                        <div class="mb-3">
                            <textarea class="form-control{{ $errors->has('message') ? 'error' : '' }}" name="message" id="message" rows="3"
                                placeholder="{{ __('links.send_msg') }}
                                " required>{{ old('message') }}</textarea>
                            @if ($errors->has('message'))
                                <div class="error">
                                    {{ $errors->first('message') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="captcha">
                            <span>{!! captcha_img() !!}</span>
                            <button type="button" class="btn btn-danger" class="reload" id="reload">
                                &#x21bb;
                            </button>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <input id="captcha" type="text" class="form-control" required
                            placeholder="{{ __('links.enterCapcha') }}" name="captcha">
                        @if ($errors->has('captcha'))
                            <div class="error">
                                {{ $errors->first('captcha') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="mb-3 mt-3">
                            <button type="submit" class="btn btn-primary">{{ __('links.send_msg') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </section>

    <section class="details_office container" style="padding-top: 0">
        <div class="row mx-0  mb-3">
            @isset($branches)
            @foreach ($branches as $branch)

                <div class="col-sm-12 col-md-6" style="padding: 50px 0;">
                    <div class="offices_info">
                        <div class="help_info">
                            <h6 class="mb-3">
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $branch->branch_enname }}
                                @else
                                    {{ $branch->branch_arname }}
                                @endif


                            </h6>
                            <span>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $branch->detailed_address_en }}
                                @else
                                    {{ $branch->detailed_address_ar }}
                                @endif
                            </span>
                            {{-- <span> new york NY 10010</span> --}}
                            <span> رقم الجوال :<br> {!! $branch->phone !!}</span>
                            <span> رقم الهاتف :<br> {!! $branch->ar_phone !!}</span>
                            {{-- <span>fax: {{ $branches[0]->fax }}</span> --}}
                            <span>البريد الإلكتروني :<br> {{ $branch->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <iframe src=" {{ $branch->google_map }}" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                @endforeach
            @endisset



        </div>


    </section>

    <!--  ending page  -->
@endsection
@section('adds_js')
    <script type="text/javascript">
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
@endsection
