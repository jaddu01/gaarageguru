@extends('front.layouts.master')
@section('title',$title)
 @section('content')
 

    <section class="inner-banner" style="background-image:url(public/images/page-title-bg.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner" data-aos="fade-up" data-aos-once="true">
                        <h1 class="page-title"> {{!empty($package->name) ? $package->name : ''}}</h1>
                        <ul class="page-list">
                            <li><a href="{{ URL::to('/') }}">Home</a></li>
                            <li>{{!empty($package->name) ? $package->name : ''}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="course-detail-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card flex-column flex-md-row p-3 my-5 border-0 shadow-sm" data-aos="fade-up" data-aos-once="true" data-aos-delay="200">
					@if($package->image!="" && file_exists(public_path().'/media/package/'.$package->image))
                        <img class="card-img-left example-card-img-responsive" src="{{asset('/public/media/package').'/'.$package->image}}" />
					@else
						<img class="card-img-left example-card-img-responsive" src="{{asset('/public/media/no-image.png')}}" />
                    @endif 						
                        <div class="card-body">
                            <h4 class="card-title mb-2 blue-color">{{!empty($package->name) ? $package->name : ''}}</h4>
                            <p class="card-text  mb-1">{{!empty($package->provide_by) ? $package->provide_by : ''}}</p>

                            <a href="#course-detail" class="link-color" title="Read More"> Read More <i class="uil uil-angle-right"></i></a>

                            <div class="priceing mt-3">
                                <div class="price blue-color">
                                    ₹  {{!empty($package->discount_price) ? number_format($package->discount_price,2) : '0.00'}}/-
                                </div>
                                <div class="discount-price">
                                    Price: <span> ₹ {{!empty($package->price) ? number_format($package->price,2) : '0.00'}}</span>
                                </div>
                               <!-- <button class="btn1 "><a class="nav-link"  href="callto:8078686728"> +91-8078686728</a>Buy Now</button> -->
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="course-modeinfo-section py-4" id="course-detail">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-heading mb-4" data-aos="fade-up" data-aos-once="true">Course Details</div>

                    <div class="content-box">
                        <?php echo !empty($package->description) ? $package->description : '';?>
                    </div>
                </div>
            </div>
           
        </div>
    </section>

  @endsection