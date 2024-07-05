<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->

      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/ndama.png" type="">
      <title>Ndama Service</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">
        @include('home.header')
         <!-- end header section -->
         <!-- slider section -->


      <div class="col-sm-6 col-md-4 col-lg-4" style="margin: auto; width: 50%; padding:30px;">


           <div class="img-box" style="padding: 20px;">
              <img src="/produit/{{$produit->image}}" alt="">
           </div>
           <div class="detail-box">
              <h5>
               {{  $produit->titre}}
              </h5>

              @if ($produit->prix_remise!=null)
              <h6 style="color: red;">
                Prix remise
                <br>
                {{  $produit->prix_remise}}CFA
              </h6>

              <h6 style="text-decoration: line-through; color:blue;">
                {{  $produit->prix}}CFA
                Prix
                <br>
              </h6>

              @else
              <h6 style="color: blue;">
                {{  $produit->prix}}CFA
                Prix
                <br>
              </h6>
              @endif

           <h6>Produit categorie: {{ $produit->categorie}}</h6>
           <h6>Produit details :{{ $produit->description}}</h6>
           <h6>Quantité disponible: {{ $produit->quantite}}</h6>

           <form action="{{url('Ajouter_panier',$produit->id)}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <input type="number" name="quantite" value="1" min="1" style="width: 100px;">

                </div class="col-md-4">
                <div>
                    <input type="submit" value="Ajouter au panier">
                </div>


            </div>
        </form>


           </div>
        </div>
     </div>

      @include('home.footer')
      <!-- footer start -->

      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2024 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">KeurguiTech</a>

         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
