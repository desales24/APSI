@extends('components.layouts.app')

@php
use App\Models\BestOffer;
use App\Models\Shoe;

$bestoffers = BestOffer::with('shoe')
    ->whereDate('start_date', '<=', now())
    ->whereDate('end_date', '>=', now())
    ->orderBy('id')
    ->get();

$shoes = Shoe::with(['category', 'bestOffer' => function ($q) {
    $q->whereDate('start_date', '<=', now())
      ->whereDate('end_date', '>=', now());
}])->get()->groupBy(function($shoe) {
    return $shoe->category ? $shoe->category->name : 'Tanpa Kategori';
});

function formatCategory($category) {
    return ucfirst(strtolower($category));
}
@endphp

@push('styles')
<style>
:root {
    --primary: #fe5b29;
    --primary-dark: #d9480f;
    --secondary: #fbbf24;
    --success: #22c55e;
    --dark: #1e293b;
    --light: #f8fafc;
}

.gallery_section {
    background: linear-gradient(rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.85)), 
                url("{{ asset('front/images/BG-Menu-2.jpg') }}") no-repeat center center;
    background-size: cover;
    padding: 80px 0;
    color: white;
    min-height: 100vh;
}

/* Always Glowing Hot Deals title */
.hot-deals-title {
    color: var(--primary);
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 40px;
    text-shadow: 0 0 10px #fe5b29, 
                 0 0 20px #fe5b29, 
                 0 0 30px #fe5b29;
    animation: glow 1.5s ease-in-out infinite alternate;
}

/* Glowing Best Offer Products */
.best-offer-card {
    background: rgba(254, 91, 41, 0.1);
    border: 1px solid rgba(254, 91, 41, 0.3);
    animation: pulse 2s ease-in-out infinite;
}

@keyframes glow {
    from {
        text-shadow: 0 0 5px #fe5b29,
                     0 0 10px #fe5b29;
    }
    to {
        text-shadow: 0 0 10px #fe5b29,
                     0 0 20px #fe5b29,
                     0 0 30px #fe5b29;
    }
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(254, 91, 41, 0.4);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(254, 91, 41, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(254, 91, 41, 0);
    }
}

/* Centered Category Titles */
.category-title {
    color: white;
    font-size: 1.8rem;
    font-weight: 600;
    margin: 50px 0 30px;
    text-align: center;
    position: relative;
    padding-bottom: 15px;
}

.category-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: var(--primary);
}

/* Product Cards */
.product-card {
    background: rgba(255, 255, 255, 0.05);
    padding: 25px;
    border-radius: 12px;
    text-align: center;
    transition: all 0.3s ease;
    margin-bottom: 25px;
    height: 100%;
    border: 1px solid rgba(255,255,255,0.15);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(254, 91, 41, 0.3);
    border-color: rgba(254, 91, 41, 0.3);
}

.product-image {
    width: 100%;
    height: 220px;
    overflow: hidden;
    border-radius: 10px;
    margin-bottom: 20px;
    position: relative;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.08);
}

.product-name {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--light);
    margin-bottom: 15px;
}

.price-section {
    margin-bottom: 20px;
}

.original-price {
    color: #aaa;
    text-decoration: line-through;
    font-size: 0.95rem;
}

.discounted-price {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--light);
    margin: 5px 0;
}

.discount-badge {
    background: var(--success);
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
}

.order-btn {
    display: inline-block;
    padding: 10px 25px;
    background: linear-gradient(to right, var(--primary), var(--primary-dark));
    color: white;
    border-radius: 6px;
    transition: all 0.3s ease;
    text-decoration: none;
    font-weight: 600;
    width: 100%;
    border: none;
    box-shadow: 0 4px 8px rgba(254, 91, 41, 0.3);
}

.order-btn:hover {
    background: linear-gradient(to right, var(--primary-dark), var(--primary));
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(254, 91, 41, 0.4);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .hot-deals-title {
        font-size: 2rem;
    }
    
    .category-title {
        font-size: 1.5rem;
    }
    
    .product-image {
        height: 180px;
    }
}

@media (max-width: 576px) {
    .gallery_section {
        padding: 60px 0;
    }
    
    .hot-deals-title {
        font-size: 1.8rem;
    }
    
    .category-title {
        font-size: 1.3rem;
    }
}
</style>
@endpush

@section('order')
<div class="gallery_section layout_padding">
    <div class="container">
        {{-- Best Offers --}}
        <h2 class="hot-deals-title">HOT DEALS</h2>
        
        @if($bestoffers->count() > 0)
        <div class="row">
            @foreach ($bestoffers as $item)
                @if ($item->shoe)
                    @php
                        $original = $item->shoe->price;
                        $discount = $item->discount_percentage;
                        $final = $original - ($original * $discount / 100);
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="product-card best-offer-card">
                            <div class="product-image">
                                <img src="{{ asset('storage/' . $item->shoe->image_url) }}" alt="{{ $item->shoe->name }}">
                                <div class="discount-badge" style="position: absolute; top: 15px; right: 15px;">-{{ $discount }}%</div>
                            </div>
                            <h3 class="product-name">{{ $item->shoe->name }}</h3>
                            <div class="price-section">
                                <span class="original-price">Rp {{ number_format($original, 0, ',', '.') }}</span>
                                <span class="discounted-price">Rp {{ number_format($final, 0, ',', '.') }}</span>
                            </div>
                            <a href="#" class="order-btn">Order Now</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        @else
        <div class="col-12 text-center text-white py-5">
            <p>No special offers available at the moment</p>
        </div>
        @endif

        {{-- Menu Per Kategori --}}
        @foreach ($shoes as $category => $shoeItems)
            <h3 class="category-title">{{ formatCategory($category) }}</h3>
            
            @if($shoeItems->count() > 0)
                <div class="row">
                    @foreach ($shoeItems as $item)
                        @php
                            $discount = optional($item->bestOffer)->discount_percentage ?? 0;
                            $original = $item->price;
                            $final = $discount > 0 ? $original - ($original * $discount / 100) : $original;
                        @endphp
                        <div class="col-lg-3 col-md-4 col-6 mb-4">
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}">
                                    @if($discount > 0)
                                        <div class="discount-badge" style="position: absolute; top: 15px; right: 15px;">-{{ $discount }}%</div>
                                    @endif
                                </div>
                                <h3 class="product-name">{{ $item->name }}</h3>
                                <div class="price-section">
                                    @if($discount > 0)
                                        <span class="original-price">Rp {{ number_format($original, 0, ',', '.') }}</span>
                                    @endif
                                    <span class="discounted-price">Rp {{ number_format($final, 0, ',', '.') }}</span>
                                </div>
                                <a href="#" class="order-btn">Order Now</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="col-12 text-center text-white py-5">
                    <p>No products in this category</p>
                </div>
            @endif
        @endforeach
    </div>
</div>
@endsection