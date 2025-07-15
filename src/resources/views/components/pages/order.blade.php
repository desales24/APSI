@extends('components.layouts.app')

@php
use App\Models\BestOffers;
use App\Models\Menu;

$bestoffers = BestOffers::orderBy('id')->get();
$menus = Menu::all()->groupBy('category');

function formatCategory($category) {
    return ucfirst(strtolower($category));
}
@endphp

@push('styles')
<style>
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

.gallery_box, .gallery_card {
   background-color: rgba(0, 0, 0, 0.5);
   padding: 20px;
   border-radius: 10px;
   text-align: center;
   height: 100%;
   display: flex;
   flex-direction: column;
   justify-content: space-between;
   min-width: 250px;
   flex: 0 0 auto;
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

.scroll-container {
   display: flex;
   overflow-x: auto;
   gap: 20px;
   padding-bottom: 10px;
   scrollbar-width: none;
}

.scroll-container::-webkit-scrollbar {
   display: none;
}
</style>
@endpush

@section('order')
<div class="gallery_section layout_padding">
   <div class="container">
      {{-- Best Offers --}}
      <div class="row">
         <div class="col-md-12">
            <h1 class="gallery_taital">Our Best Offers</h1>
         </div>
      </div>
      <div class="gallery_section_2">
         <div class="row">
            @forelse ($bestoffers as $item)
               <div class="col-md-4 d-flex mb-4">
                  <div class="gallery_box w-100">
                     <div class="gallery_img">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                     </div>
                     <h3 class="types_text">{{ $item->name }}</h3>
                     <p class="looking_text">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                     <div class="read_bt mt-3">
                        <a href="http://localhost/customer/login">Order Now</a>
                     </div>
                  </div>
               </div>
            @empty
               <div class="col-12 text-center text-white">
                  <p>Tidak ada penawaran terbaik saat ini.</p>
               </div>
            @endforelse
         </div>
      </div>

      {{-- Menu Per Kategori --}}
      @foreach ($menus as $category => $menuItems)
         @if (strtolower($category) === 'makanan' || strtolower($category) === 'minuman')
            <div class="row mt-5">
               <div class="col-md-12">
                  <h1 class="gallery_taital">{{ formatCategory($category) }}</h1>
               </div>
            </div>
            @foreach ($menuItems->chunk(5)->take(3) as $chunk)
               <div class="scroll-container mb-4">
                  @foreach ($chunk as $item)
                     <div class="gallery_card">
                        <div class="gallery_img">
                           <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                        </div>
                        <h3 class="types_text">{{ $item->name }}</h3>
                        <p class="looking_text">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        <div class="read_bt">
                           <a href="http://localhost/customer/login">Order Now</a>
                        </div>
                     </div>
                  @endforeach
               </div>
            @endforeach
         @endif
      @endforeach
   </div>
</div>
@endsection