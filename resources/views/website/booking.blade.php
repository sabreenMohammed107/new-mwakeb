@extends('layout.website.layout', ['Company' => $Company, 'title' => 'مواكب |عربة التسوق'])

@section('adds_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/tours.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/hotel.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/booking-hotel.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.cart') }} " :breadcrumb="$BreadCrumb" current="{{ __('links.preBook') }}" />
@endsection
@section('content')
    @if ($RoomCost || count($ToursCost) || $TransferCost || count($VisasCost) || count($OffersCost))
        @php
            $TotalCost = 0;
            $TotalToursFees = 0;
            $TotalTransferCost = 0;
            $TotalVisasCost = 0;
            $TotalOffersCost = 0;
        @endphp
        @if ($RoomCost)
            @php
                if ($RoomCost->room_cap == 1) {
                    $Type = __('links.single');
                    $Cost = $RoomCost->single_cost;
                } elseif ($RoomCost->room_cap == 2) {
                    $Type = __('links.double');
                    $Cost = $RoomCost->double_cost;
                } elseif ($RoomCost->room_cap == 3) {
                    $Type = __('links.triple');
                    $Cost = $RoomCost->triple_cost;
                }

                $ChildrenCost = 0;
                $FreeChildren = 0;
                $PaidChildren = 0;
                $ages = null;
                if ($RoomCost->children_count) {
                    $ages = explode(',', $RoomCost->ages);
                    $ChildrenCost = 0;
                    $FreeChildren = 0;
                    $PaidChildren = 0;
                    for ($i = 0; $i < $RoomCost->children_count; $i++) {
                        if ($ages[$i] >= $RoomCost->child_free_age_from && $ages[$i] <= $RoomCost->child_free_age_to) {
                            $FreeChildren++;
                        } else {
                            $PaidChildren++;
                        }
                    }
                }

                $TotalCost =
                    $RoomCost->nights * ($RoomCost->rooms_count * $Cost + $PaidChildren * $RoomCost->child_age_cost);
            @endphp
        @endif
        @if (count($ToursCost) > 0)
            @php
                $TotalToursFees = 0;
            @endphp
        @endif
        @if ($TransferCost)
            @php
                $TotalTransferCost = $TransferCost->person_price;
            @endphp
        @endif
        @if (count($VisasCost) > 0)
            @php
                $TotalVisasCost = 0;
            @endphp
        @endif

        {{-- <a href="www.google.com" class="delete_confirm">aaa</a> --}}
        <!-- passenger details -->
        <section class="passenger_section container">
            <h5> {{ __('links.cartDetails') }} </h5>
            <form action="{{ url('/Book') }}" method="POST">
                <div class="row mx-0">
                    <div class="col-12">
                        {{-- <h4 class="bg-info px-3 py-1 text-white">
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                Hotel Room Reservation Details
                            @else
                                تفاصيل حجز غرفة الفندق
                            @endif
                        </h4> --}}
                    </div>
                    <div class="col-12">
                        @if (count($ToursCost) > 0)
                            <h4 class="bg-info px-3 py-1 text-white">
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    Tours Reservation Details
                                @else
                                    تفاصيل حجز العروض
                                @endif
                            </h4>
                            <div class="row">
                                @foreach ($OffersCost as $index => $Offer)
                                    @php
                                        $TotalPaidPersons[$index] = $Offer->adults_count;
                                    @endphp
                                    <div class="col-sm-12 col-md-6">
                                        <h6 class="bg-light-info px-3 py-1">
                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                {{ $Offer->subtitle_en }}
                                            @else
                                                {{ $Offer->subtitle_ar ?? '' }}
                                            @endif
                                        </h6>
                                        <div class="passenger_info">
                                            @csrf
                                            <div class="row">
                                                <h6>
                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                        Reservation Holder Details:
                                                    @else
                                                        تفاصيل مسئول الحجز:
                                                    @endif
                                                </h6>
                                                {{-- <div class="col-sm-12 col-md-6 col-xl-4">
                                                    <label class="form-label">{{ __('links.salutation') }}
                                                    </label>
                                                    <input type="text" name="tour_adults_sal[{{ $index }}][]"
                                                        required class="form-control"
                                                        placeholder="{{ __('links.mr') }} " aria-label="First name">
                                                </div> --}}
                                                {{-- @if ($index > 0)
                                                    <div class="col-12">
                                                        <button type="button" onclick="copyData({{ $index - 1 }})"
                                                            class="btn btn-outline-primary float-end mb-3">Copy Data from
                                                            Above</button>
                                                    </div>
                                                @endif --}}
                                                <input type="hidden" name="tax_percentage" value="{{ $tax_percentage }}">
                                                <input type="hidden" name="offer_adults_count[{{ $index }}]"
                                                    value="1" />
                                                <div class="col-sm-12 col-md-6 col-xl-8">
                                                    <label class="form-label">{{ __('links.cName') }} </label>

                                                    <input type="text" name="offer_adults_name[{{ $index }}][]"
                                                        value="{{ session()->get('SiteUser')['Name'] }}" required
                                                        class="form-control" id="holder-name-{{ $index }}"
                                                        placeholder="{{ __('links.cName') }} ">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-xl-4">
                                                    <label class="form-label">{{ __('links.mobile') }} </label>

                                                    <input type="text"
                                                        name="offer_adults_mobile[{{ $index }}][]" required
                                                        class="form-control" id="holder-phone-{{ $index }}"
                                                        placeholder="{{ __('links.mobile') }} ">
                                                </div>
                                                <div class="col-sm-12 col-md-8">
                                                    <label class="form-label">{{ __('links.email') }} </label>

                                                    <input type="text"
                                                        name="offer_adults_email[{{ $index }}][]" required
                                                        class="form-control" id="holder-email-{{ $index }}"
                                                        value="{{ session()->get('SiteUser')['Email'] }}"
                                                        placeholder="{{ __('links.email') }} ">
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-12">
                                                    <label class="form-label">{{ __('links.notes') }} </label>
                                                    <textarea class="form-control" name="offer_notes[{{ $index }}]" id="holder-notes-{{ $index }}"
                                                        rows="3"></textarea>
                                                </div>
                                                <input type="hidden" name="offer_id[{{ $index }}]"
                                                    value="{{ $Offer->offer_id }}" />
                                                @php
                                                    $OfferTotalCost[$index] =$Offer->cost ;
                                                    $TotalOffersCost += $OfferTotalCost[$index];
                                                @endphp
                                                <input type="hidden" name="offer_total_cost[{{ $index }}]"
                                                    value="{{ $OfferTotalCost[$index] }}" />
                                                <input type="hidden" name="offer_cost[{{ $index }}]"
                                                    value="{{ $Offer->cost }}" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="passenger_info">
                                            <p class="receipt-title">
                                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                    Tours Reservation Receipt
                                                @else
                                                    إيصال حجز العروض
                                                @endif
                                            </p>
                                            <div class="booking_info_card">
                                                <div class="text-end mb-3"><a class="del-hotel delete_trash"
                                                        href="{{ url("/cart/$Offer->id") }}"><i
                                                            class="fa-solid fa-trash"></i></a></div>
                                                <div class="booking_info_card_info">
                                                    <div class="info_image">
                                                        <img src="{{ asset('uploads/offers') }}/{{ $Offer->image }}"
                                                            alt=" blogimage" />
                                                    </div>
                                                    <div class="info_title px-2">
                                                        <div class="card_info">
                                                                <h6> <a href="{{ url('/offers/') }}"
                                                                        class="">{{ $Offer->subtitle_ar ?? '' }}</a>
                                                                </h6>
                                                                <span> <i
                                                                        class="fa-solid fa-location-dot"></i>{{ $Offer->ar_country ?? '' }}
                                                                    <span>|</span> {{ $Offer->ar_city ?? '' }}</span>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="remain_info mb-3">
                                                    <div class="date">

                                                    </div>
                                                    <h5>{{ __('links.offers') }} </h5>

                                                    <p class="mb-0 pb-0">التكلفة <span
                                                            class=" text-end">
                                                            ${{ $Offer->cost }}<br><span
                                                                class="fw-bold">${{  $Offer->cost }}</span></span>
                                                    </p>
                                                    <br>
                                                    <br>

                                                    <br>
                                                    <p class="mb-0 pb-0" style="border-top: 1px solid rgb(184, 184, 184)">
                                                        <span
                                                            class=" text-end fw-bold">${{ $TotalPaidPersons[$index] * $Offer->cost }}</span><br>
                                                    </p>
                                                    <br>
                                                    <div class="grand_total">
                                                        <h6>
                                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                                Sub-total
                                                            @else
                                                                المجموع الفرعي
                                                            @endif
                                                        </h6>
                                                        <span class="h6">
                                                            ${{ $TotalPaidPersons[$index] *  $Offer->cost }}</span></span>
                                                    </div>

                                                    <br>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4" style="border-bottom: 1px solid #d5d5d5">
                                        <hr />

                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="passenger_info">


                            <p class="receipt-title">
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    Total Fees
                                @else
                                    الرسوم الكلية
                                @endif
                            </p>
                            <div class="remain_info">
                                <p class="mb-0 pb-0">
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        Before Tax
                                    @else
                                        قبل ضريبة القيمة المضافة
                                    @endif <span
                                        class="float-end text-end BeforeT_txt">${{ number_format( $TotalOffersCost, 2, '.', '') }}
                                    </span><br>
                                </p>
                                <br>
                                <p class="mb-0 pb-0">
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        After VAT
                                    @else
                                        بعد ضريبة القيمة المضافة
                                    @endif
                                    <span class="float-end text-end">
                                        <span
                                            class="BeforeT_txt">${{ number_format($TotalOffersCost, 2, '.', '') }}</span>
                                        X {{ (float) $tax_percentage / 100 }} <br> <span
                                            class="fw-bold AfterT_txt">${{ number_format((float) ($TotalOffersCost) * (1 + (float) $tax_percentage / 100), 2, '.', '') }}</span></span><br>
                                    <input type="hidden" name="BeforeT"
                                        value="{{ number_format((float) ($TotalOffersCost), 2, '.', '') }}" />
                                </p>
                                <br />
                            </div>
                            <div class="grand_total final">
                                <h5>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        grand total
                                    @else
                                        المجموع الإجمالي
                                    @endif
                                </h5>
                                <span id="gt" class="AfterT_txt">
                                    <span>$</span>{{ number_format(($TotalOffersCost) * (1 + (float) $tax_percentage / 100), 2, '.', '') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="my-3 px-3">
                            <div class="row">

                                <div class="form-check mb-3">
                                    <input class="form-check-input terms" style="float:none" required type="checkbox"
                                        value="" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            I agree to all <a href="{{ url('/terms') }}" target="_blank">Terms and
                                                Conditions</a> of Mwakeb
                                        @else
                                            أوافق على جميع <a href="{{ url('/terms') }}" target="_blank"> بنود وشروط
                                            </a> Mwakeb
                                        @endif
                                    </label>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-info">
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            Place Order
                                        @else
                                            استكمال الطلب
                                        @endif
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </section>
    @else
        <div class="container bg-light-info text-center p-5">
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Nothing is Added to cart
            @else
                لا شىء مضاف الى عربة التسوق
            @endif
        </div>
    @endif
@endsection

@section('adds_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script>
        function copyData(id) {
            var data = {
                holder_name: $("#holder-name-" + id).val(),
                holder_mobile: $("#holder-phone-" + id).val(),
                holder_email: $("#holder-email-" + id).val(),
                holder_pickup: $("#holder-pickup-" + id).val(),
                holder_notes: $("#holder-notes-" + id).val(),
            }
            console.table(data);
            $("#holder-name-" + (id + 1)).val(data.holder_name);
            $("#holder-phone-" + (id + 1)).val(data.holder_mobile);
            $("#holder-email-" + (id + 1)).val(data.holder_email);
            $("#holder-pickup-" + (id + 1)).val(data.holder_pickup);
            $("#holder-notes-" + (id + 1)).val(data.holder_notes);

        }
        $(".delete_confirm").click(function() {
            $.confirm({
                title: 'Confirm!',
                content: 'Simple confirm!',
                buttons: {
                    confirm: function() {
                        $.alert('Confirmed!');
                    },
                    cancel: function() {
                        $.alert('Canceled!');
                    },
                    somethingElse: {
                        text: 'Something else',
                        btnClass: 'btn-blue',
                        keys: ['enter', 'shift'],
                        action: function() {
                            $.alert('Something else?');
                        }
                    }
                }
            });
        })
        $("#transHolderFlag").change(function() {
            debugger;
            var price = $("#t_price").val();
            var before_price = $("[name='BeforeT']").val();
            var tax = "{{ $tax_percentage }}";
            $(".trans-holder").fadeToggle();
            if ($(".is_holder").attr('required')) {
                $(".is_holder").removeAttr('required');
                $(".t_rec").text('$' + price);
                $(".BeforeT_txt").text('$' + (parseFloat(before_price)).toFixed(2));
                $(".AfterT_txt").text('$' + ((parseFloat(before_price).toFixed(2)) * (1 + parseFloat(tax) / 100.0))
                    .toFixed(2));
            } else {
                $(".is_holder").attr('required', 6);
                $(".t_rec").text('$' + 2.0 * price);
                $(".BeforeT_txt").text('$' + (parseFloat(before_price) + parseFloat(price)).toFixed(2));
                $(".AfterT_txt").text('$' + ((parseFloat(before_price) + parseFloat(price)) * (1 + parseFloat(tax) /
                    100.0)).toFixed(2));

            }
        });
    </script>
    <script>
        let localization = "{{ LaravelLocalization::getCurrentLocale() }}"
        $(document).ready(function() {
            // $('.transfer_date').datepicker();
            var _minDate = "{{ $TransferCost ? $TransferCost->transfer_date : '' }}"
            flatpickr(".transfer_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i:S",
                minDate: _minDate,
                defaultDate: new Date(_minDate ? _minDate : Date.now()),
            });
        });
        $(".delete_trash").click(function(e) {
            e.preventDefault();
            var elem = $(this);
            console.log($(this).attr("href"));
            var obj = $.confirm({
                title: localization === "en" ? 'Are you sure?' : 'هل أنت متأكد؟',
                content: localization === "en" ?
                    'This is a confirmation regarding your action to delete a cart item.' :
                    'هذا تأكيد بخصوص إجراءك لحذف عنصر من عربة التسوق.',
                buttons: {
                    confirm: {
                        text: localization === "en" ? 'Confirm' : 'تأكيد',
                        action: function() {
                            window.location.href = elem.attr("href");
                        },
                        btnClass: 'btn-blue',
                    },
                    cancel: {
                        text: localization === "en" ? 'Cancel' : 'إلغاء',
                        action: function() {
                            obj.close();
                        },
                    }
                }
            });

            obj.close();
        });
    </script>
@endsection
