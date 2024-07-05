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

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
      integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin
      ="anonymous" referrerpolicy="no-referrer"></script>
   </head>
   <body>
      <div class="hero_area">


        @include('sweetalert::alert')


        @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
         @include('home.slider')
         <!-- end slider section -->
      </div>
      <!-- why section -->
      @include('home.quoi')
      <!-- end why section -->
      @include('home.nouveau')
      <!-- arrival section -->

      <!-- end arrival section -->
      @include('home.produit')
      <!-- product section -->


      <!-- end product section -->
      @include('home.abonner')
      <!-- subscribe section -->

      <!-- end subscribe section -->
      <!-- client section -->

      <!-- end client section -->
      @include('home.footer')
      <!-- footer start -->

      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2024 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">KeurguiTech</a>

         </p>
      </div>
      @if (session()->has('message'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: '{{ session()->get('message') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif

      <!-- jQery -->
      <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function updateCartCount() {
    $.ajax({
        url: '{{ route('cart.count') }}',
        method: 'GET',
        success: function(data) {
            $('#cart-count').text(data.count);
        }
    });
}

// Call this function whenever an item is added to the cart
updateCartCount();

// Example: If you have a button or form that adds items to the cart, call updateCartCount() after the AJAX request is successful.
$('form.add-to-cart-form').on('submit', function(event) {
    event.preventDefault();

    var form = $(this);
    $.ajax({
        url: form.attr('action'),
        method: form.attr('method'),
        data: form.serialize(),
        success: function(response) {
            alert('Produit ajouté avec succès');
            updateCartCount();
        },
        error: function(response) {
            alert('Une erreur s\'est produite');
        }
    });
});
</script>

    </script>
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
