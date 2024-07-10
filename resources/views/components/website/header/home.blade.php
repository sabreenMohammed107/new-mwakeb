<!-- slider -->

<div class="slider_section">
    <div class="position-relative h-100vh">
        <div class="carousel-overlay">
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
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active" style="background-image: url({{asset("website_assets/images/homePage/turkey-slider-image.webp")}})">
                {{-- <img src="" class="d-block w-100" alt="..."> --}}
              </div>
              <div class="carousel-item active" style="background-image: url({{asset("website_assets/images/homePage/turkey-slider-image.webp")}})">
                {{-- <img src="" class="d-block w-100" alt="..."> --}}
              </div>
              <div class="carousel-item active" style="background-image: url({{asset("website_assets/images/homePage/turkey-slider-image.webp")}})">
                {{-- <img src="" class="d-block w-100" alt="..."> --}}
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>


</div>

