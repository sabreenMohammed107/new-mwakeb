<!-- slider -->

<div class="slider_section">
    <div class="slider_details">
        <h1 >
            @if (LaravelLocalization::getCurrentLocale() === 'en')
            {{ $company->master_page_entitle }}  <br> {{ $company->master_page_ensubtitle }}


            @else
            {{ $company->master_page_artitle }}  <br> {{ $company->master_page_arsubtitle }}

            @endif
            </h1>

        <p class="px-5">
            @if (LaravelLocalization::getCurrentLocale() === 'en')

            {{ $company->master_page_entext }}
            @else
            {{ $company->master_page_artext }}
            @endif
          </p>
     
    </div>

</div>

