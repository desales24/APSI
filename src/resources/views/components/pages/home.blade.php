@extends('components.layouts.app')

@php
  use App\Models\BestOffer;
  $bestoffers = BestOffer::with('shoe')->orderBy('id')->get();
@endphp

@push('styles')
<style>
/* Banner Section */
.banner_section {
   background: url("{{ asset('front/images/BG-Home.jpg') }}") no-repeat center center;
   background-size: cover;
   padding: 100px 0;
   color: white;
   position: relative;
   z-index: 1;
}

.banner_text,
.banner_taital {
   color: white;
   text-align: justify;
}

.banner_taital_main {
   background-color: rgba(0, 0, 0, 0.7);
   padding: 30px;
   border-radius: 10px;
}

/* About Section */
.about_section {
   background-size: cover;
   padding: 80px 0;
   color: white;
}

.about_taital_box {
   background-color: rgba(0, 0, 0, 0.7);
   padding: 30px 40px;
   border-radius: 10px;
}

.about_text {
   color: white;
   text-align: justify;
}

.about_taital {
   color: white;
   white-space: nowrap;
}

.about_taital span {
   color: #fe5b29;
}

/* Gallery / Best Offers Section */
.gallery_section {
   background: url("{{ asset('front/images/BG-Menu-2.jpg') }}") no-repeat center center;
   background-size: cover;
   padding: 80px 0;
   color: white;
}

.gallery_taital {
   color: white;
   text-align: center;
   margin-bottom: 40px;
}

.gallery_box {
   background-color: rgba(0, 0, 0, 0.5);
   padding: 20px;
   margin-bottom: 30px;
   text-align: center;
   border-radius: 10px;
   height: 100%;
   display: flex;
   flex-direction: column;
   justify-content: space-between;
}

.gallery_img {
   width: 100%;
   height: 200px;
   overflow: hidden;
   border-radius: 10px;
   margin-bottom: 15px;
}

.gallery_img img {
   width: 100%;
   height: 100%;
   object-fit: cover;
   border-radius: 10px;
}

.types_text {
   font-size: 18px;
   font-weight: bold;
   color: #fff;
   margin-bottom: 8px;
   min-height: 48px;
}

.looking_text {
   color: #fbbf24;
   font-size: 16px;
   margin-bottom: 10px;
   min-height: 24px;
}

.read_bt {
   margin-top: auto;
}

.read_bt a {
   display: inline-block;
   padding: 10px 20px;
   background-color: #fe5b29;
   color: white;
   border-radius: 5px;
   transition: 0.3s ease;
   text-decoration: none;
}

.read_bt a:hover {
   background-color: #d9480f;
}
</style>
@endpush

@section('home')

{{-- Banner Section --}}
<div class="banner_section layout_padding">
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <div id="banner_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  @foreach ($bestoffers as $index => $item)
                     <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="banner_taital_main">
                           <h1 class="banner_taital">Recomendation <br><span style="color: #fe5b29;">For You</span></h1>
                           <p class="banner_text">
                              Dapatkan diskon hingga <strong>{{ $item->discount_percentage }}%</strong> untuk sepatu
                              <strong>{{ $item->shoe->name ?? '-' }}</strong>.
                           </p>
                           <div class="btn_main">
                              <div class="contact_bt"><a href="http://localhost/customer/login">Pesan</a></div>
                           </div>
                        </div>
                     </div>
                  @endforeach
               </div>
               <a class="carousel-control-prev" href="#banner_slider" role="button" data-slide="prev">
                  <i class="fa fa-angle-left"></i>
               </a>
               <a class="carousel-control-next" href="#banner_slider" role="button" data-slide="next">
                  <i class="fa fa-angle-right"></i>
               </a>
            </div>
         </div>
         <div class="col-md-6">
            <div class="banner_img"><img src="{{ asset('front/images/banner-img.png') }}" alt="Banner Image"></div>
         </div>
      </div>
   </div>
</div>

{{-- About Section --}}
<div class="about_section layout_padding" style="background: url('/front/images/BG-About-1.jpg') no-repeat center center; background-size: cover;">
   <div class="container">
      <div class="about_section_2">
         <div class="row">
            <div class="col-md-12">
               <div class="about_taital_box">
                  <h1 class="about_taital">About <span style="color: #fe5b29;">Us</span></h1>
                  <p class="about_text">
                     Sistem dari website AHHH Restaurant ini menyediakan beberapa informasi, yaitu informasi terkait website ini sendiri dan juga menampilkan beberapa menu yang direkomendasikan.
                  </p>
                  <div class="readmore_btn"><a href="#">Read More</a></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

{{-- Best Offers Section --}}
<div class="gallery_section layout_padding">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h1 class="gallery_taital">Our Best Offers</h1>
         </div>
      </div>
      <div class="gallery_section_2">
         <div class="row">
            @foreach ($bestoffers as $item)
               <div class="col-md-4 d-flex">
                  <div class="gallery_box w-100">
                     <div class="gallery_img">
                        <img src="{{ $item->shoe && $item->shoe->image_url ? asset('storage/' . $item->shoe->image_url) : asset('front/images/default-shoe.jpg') }}" alt="{{ $item->shoe->name ?? 'Shoe' }}">
                     </div>
                     <h3 class="types_text">{{ $item->shoe->name ?? '-' }}</h3>
                     <p class="looking_text">Rp {{ number_format($item->shoe->price ?? 0, 0, ',', '.') }}</p>
                     <div class="read_bt">
                        <a href="http://localhost/customer/login">Order Now</a>
                     </div>
                  </div>
               </div>
            @endforeach
         </div>
      </div>
   </div>
</div>

@endsection
