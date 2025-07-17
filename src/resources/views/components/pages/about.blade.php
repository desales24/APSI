@extends('components.layouts.app')

@push('styles')
<style>
.about_section {
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                url("{{ asset('front/images/bg1.jpeg') }}") no-repeat center center;
    background-size: cover;
    padding: 120px 0;
    color: white;
    position: relative;
    display: flex;
    align-items: center;
    min-height: 80vh;
}

.about-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.about_box {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 50px;
    max-width: 800px;
    margin: 0 auto;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
    text-align: center;
    position: relative;
    overflow: hidden;
    transition: all 0.5s ease;
}

.about_box:before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(
        to bottom right,
        rgba(254, 91, 41, 0.1),
        rgba(254, 91, 41, 0)
    );
    transform: rotate(45deg);
    z-index: -1;
}

.about_box:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.6);
}

.about_taital {
    color: white;
    font-size: 2.8rem;
    font-weight: 700;
    margin-bottom: 30px;
    position: relative;
    display: inline-block;
}

.about_taital:after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 4px;
    background: #fe5b29;
    border-radius: 2px;
}

.about_taital span {
    color: #fe5b29;
}

.about_text {
    color: white;
    text-align: center;
    font-size: 1.2rem;
    line-height: 1.8;
    margin-bottom: 0;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .about_box {
        padding: 40px;
    }
    
    .about_taital {
        font-size: 2.4rem;
    }
}

@media (max-width: 768px) {
    .about_section {
        padding: 80px 0;
        min-height: auto;
    }
    
    .about_box {
        padding: 30px;
    }
    
    .about_taital {
        font-size: 2rem;
    }
    
    .about_text {
        font-size: 1.1rem;
    }
}

@media (max-width: 576px) {
    .about_box {
        padding: 25px;
    }
    
    .about_taital {
        font-size: 1.8rem;
    }
    
    .about_text {
        font-size: 1rem;
        text-align: left;
    }
}
</style>
@endpush

@section('about')
{{-- About Section --}}
<div class="about_section layout_padding">
    <div class="about-container">
        <div class="about_box">
            <h1 class="about_taital">About <span>Us</span></h1>
            <p class="about_text">
                Sepatu Keren adalah brand sepatu lokal yang mengutamakan kualitas, kenyamanan, dan gaya dalam setiap langkahmu. Kami menghadirkan berbagai koleksi sepatu mulai dari kasual, formal, hingga sportwear yang dirancang untuk memenuhi kebutuhan dan gaya hidup modern. Dengan material terbaik dan proses produksi yang teliti, AHHH Shoes hadir untuk memberikan kepercayaan diri pada setiap penggunanya.
            </p>
        </div>
    </div>
</div>
@endsection
