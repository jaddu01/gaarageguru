@php
	$curntroute = Request::path();
	if($curntroute == 'service'){
	    $class = "header-banner-section-service";
	}elseif($curntroute == 'contact-us'){
	    $class = "header-banner-section-contactus";
	}elseif($curntroute == 'about-us'){
	    $class = "header-banner-section-aboutus";
	}else{
	    $class = "header-banner-section-home";
	}
@endphp

<section class="header-banner-section {{$class}}">
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    @if(empty(Auth::user()))
                        <a class="navbar-brand" href="{{ URL::to('/') }}">
                    @else
                        <a class="navbar-brand" href="{{ URL::to('/dashboard') }}">
                    @endif
                        <img class="white-logo" src="{{asset("public/img/new-clear-wt-bg-logo.svg")}}" alt="">
                        <img class="logo-blue" src="{{asset("public/img/logo-blue.png")}}" alt=""> Gaarage Guru</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="location-option">
                        <form action="" class="location-form">
                            <select id="location">
                                <option value="jaipur">Jaipur</option>
                                <option value="kota">Kota</option>
                                <option value="chomu">Chomu</option>
                            </select>
                        </form>
                    </div>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item"> <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('/') }}">Home</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link {{ Request::is('about-us*') ? 'active' : '' }}" href="{{ URL::to('/about-us') }}">About Us</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link {{ Request::is('service*') ? 'active' : '' }}" href="{{ URL::to('/service') }}">Services</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link {{ Request::is('contact-us*') ? 'active' : '' }}" href="{{ URL::to('/contact-us') }}">Contact</a>
                            </li>
                            @if(!empty(Auth::user()))
                            <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="{{ URL::to('/dashboard') }}">Dashboard</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div class="help-btn">
                        <a href="tel:+91 9549988333">
                            <img src="{{asset("public/img/help-img.svg")}}" alt="">
                        </a>
                    </div>

                </div>
            </nav>
        </div>
    </header>
    @if($curntroute == 'about-us')
        <div class="container">
            <div class="banner-content-new">
                <h1>Witness The Preciseness of Quality you Never Experienced Before.</h1>
            </div>
        </div>
    @elseif($curntroute == 'contact-us')
        <div class="container">
            <div class="banner-content-new">
                <h1>We Go Beyond To Make all
                    The Process Hassle Free</h1>
                <p>We pride ourselves on our courtesy and our professionalism. <br> With each Insurance Claim, our goal is to  truly make the process easier for our customers...Right from the very beginning.</p>
            </div>
        </div>
    @elseif($curntroute == 'service')
        <div class="container">
            <div class="banner-content-new">
                <h1>Your Car has Never <br>
                    Looked So Nice Before</h1>
                <p>We exist to help you transform your lovable <br>
                    car into a comfortable riding experience of a lifetime.</p>
            </div>
        </div>
    @else
        <div class="container">
            <div class="banner-content-new">
                <h1>End to End Solution Provider
                    For All Vehicles</h1>
                <p>Gaarage Guru is technology based platform providing vehicle Repair,
                    Service, Insurance Claim Assistance & Breakdown.</p>
            </div>
        </div>
    @endif

</section>
