<div class="row mx-0 p-0">

    @foreach ($offers as $newOffer)
        <div class="col-sm-12 col-md-6 ">
            <div class="card-content">
                <div class=" card  tours_card hotels_card">
                    <a href="{{ LaravelLocalization::localizeUrl('/single-offer/' . $newOffer->id . '/' . $newOffer->slug) }}">
                        <img class="w-100" src="{{ asset('uploads/offers') }}/{{ $newOffer->image }}" alt=" blogimage">
                    </a>
                    <div class="card-body hotel_card_info" style="height: 115px; max-height: 115px; overflow: hidden;">
                        <form action="{{ LaravelLocalization::localizeUrl('/bookOffer') }}" method="POST">
                            @csrf
                            <input type="hidden" name="offer_id" value="{{ $newOffer->id }}">
                            <div class="card_info">
                                <h5 style="text-align: center;text-align-last:center">
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {{ $newOffer->subtitle_en }}
                                    @else
                                        {{ $newOffer->subtitle_ar }}
                                    @endif
                                </h5>
                            </div>
                            {{-- <span>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ strip_tags(Str::limit($newOffer->offer_enoverview ?? '', $limit = 300, $end = '...')) }}
                                @else
                                    {{ strip_tags(Str::limit($newOffer->offer_aroverview ?? '', $limit = 300, $end = '...')) }}
                                @endif
                            </span> --}}

                            <p style="display: flex;justify-content: space-between;align-items: center;">
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $newOffer->city->en_city ?? '' }}
                                @else
                                    {{ $newOffer->city->ar_city ?? '' }}
                                @endif
                                -
                                {{-- <span> --}}
                                {{ $newOffer->cost }} رس
                                {{-- </span> --}}
                                <button class="btn mx-1 btn-primary mb-3" type="submit">
                                    {{ __('links.book') }}
                                </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    @endforeach


</div>
@if ($offers->lastPage() > 1)

    <nav aria-label="Page navigation page_pagination example">
        <ul class="pagination">
            <!-- a Tag for previous page -->

            @for ($i = 1; $i <= $offers->lastPage(); $i++)
                <!-- a Tag for another page -->
                <li class="page-item"> <a href="{{ $offers->url($i) }}"
                        class="page-link {{ $offers->currentPage() == $i ? ' active' : '' }}">{{ $i }}</a>
                </li>
            @endfor
            <!-- a Tag for next page -->

        </ul>

    </nav>
@endif
