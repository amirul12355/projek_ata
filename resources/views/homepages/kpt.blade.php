

<!DOCTYPE html>
   <html lang="en">
   <head>
       @include('partials.head') <!-- header KPT -->
   </head>
   <body>

    @include('partials.navbarKPT') <!-- Nav KPT -->

       <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/slide1.jpg') }}" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slide2.jpg') }}" class="d-block w-100" alt="Slide 2">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
 

       <!-- Content Section -->
       <section class="container my-5">
           <div class="row">
               <div class="col-md-8">
                   <h2>Informasi Terkini</h2>
                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac nunc sit amet risus scelerisque hendrerit. Integer auctor elit nec mi vestibulum, at bibendum dui tempor.</p>
                   <a href="#" class="btn btn-primary">Baca Selanjutnya</a>
               </div>
               <div class="col-md-4">
                   <div class="card">
                       <div class="card-body">
                           <h5 class="card-title">Maklumat Tanah</h5>
                           <p class="card-text">Maklumat terkini mengenai aset-aset tak alih di bawah pengurusan KPT.</p>
                           <a href="#" class="btn btn-outline-primary">Lihat Butiran</a>
                       </div>
                   </div>
               </div>
           </div>
       </section>

       @include('partials.footer') <!-- footer KPT -->

       <!-- Bootstrap JS and dependencies -->
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   </body>
   </html>
