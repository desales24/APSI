<!-- Footer Section -->
<div class="footer_section layout_padding">
   <style>
      .footeer_logo img {
         width: 120px;
         height: 120px;
         object-fit: cover;
         border-radius: 50%;
         border: 3px solid #fff;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
         margin: 0 auto;
         display: block;
      }

      .footer_taital {
         color: #fff;
         font-size: 20px;
         margin-bottom: 15px;
         font-weight: bold;
      }

      .footer_text,
      .lorem_text {
         color: #d1d1d1;
         font-size: 14px;
      }

      .location_text i {
         color: #fff;
      }

      .location_text a,
      .location_text span {
         color: #d1d1d1;
         font-size: 14px;
      }

      .footer_section {
         background-color: #333;
         padding-top: 50px;
         padding-bottom: 30px;
         color: #fff;
      }

      .footer_section_2 .col {
         margin-bottom: 25px;
      }

      @media screen and (max-width: 768px) {
         .footer_section_2 .col {
            text-align: center;
         }
      }
   </style>
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="footeer_logo">
               <img src="{{ asset('front/images/Merah Ilustrasi Logo Toko Sepatu .png') }}" alt="Logo Sepatu">
            </div>
         </div>
      </div>
      <div class="footer_section_2 mt-4">
         <div class="row">
            <div class="col">
               <h4 class="footer_taital">Subscribe Now</h4>
               <p class="footer_text">Dapatkan update koleksi sepatu terbaru, promo eksklusif, dan info fashion terkini langsung ke email Anda. Jangan lewatkan penawaran menarik dari kami!</p>
            </div>
            <div class="col">
               <h4 class="footer_taital">Information</h4>
               <p class="lorem_text">Kami menyediakan berbagai jenis sepatu berkualitas tinggi untuk segala aktivitas, mulai dari kasual hingga olahraga, dengan pelayanan yang profesional.</p>
            </div>
            <div class="col">
               <h4 class="footer_taital">Helpful Links</h4>
               <p class="lorem_text">Tentang Kami & Katalog Sepatu</p>
            </div>
            <div class="col">
               <h4 class="footer_taital">Investments</h4>
               <p class="lorem_text">Berminat menjadi mitra bisnis? Kami membuka peluang kerja sama bagi Anda yang ingin berinvestasi dalam industri fashion dan footwear masa kini.</p>
            </div>
            <div class="col">
               <h4 class="footer_taital">Contact Us</h4>
               <div class="location_text">
                  <a href="https://maps.app.goo.gl/eaUDrHBMnfxaW91M9?g_st=aw">
                     <i class="fa fa-map-marker" aria-hidden="true"></i>
                     <span class="padding_left_15">Toko Sepatu Citra Raya</span>
                  </a>
               </div>
               <div class="location_text">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <span class="padding_left_15">(+62) 812-9023-1222</span>
               </div>
               <div class="location_text">
                  <a href="mailto:info@sepatukeren.com" style="display: inline-flex; align-items: center; text-decoration: none;">
                     <i class="fa fa-envelope" aria-hidden="true"></i>
                     <span class="padding_left_15">info@sepatukeren.com</span>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
