<!DOCTYPE html>
<html>
   <head>
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
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
     integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      <!-- Basic -->


      <style type="text/css">

      .center{
        margin: auto;
        width: 70%;
        text-align: center;
        padding: 30px;
      }

      table,th,td{
        border: 1px solid grey;

      }
      .th_degg{
        font-size: 30px;
        padding: 5px;
        background: skyblue;
      }
      .img_degg{
        width: 200px;
        height: 200px;
      }
      .total_degg{
        font-size: 20px;
        padding: 40px;
      }
      .btn-orange {
  background-color: orange;
  color: white;
  border: none;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 4px;
}

.btn-orange:hover {
  background-color: darkorange;
}


    </style>
   </head>
   <body>
      <div class="hero_area">
        @include('home.header')
        @include('sweetalert::alert')
         <!-- end header section -->
         @if (session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
            @endif

      <!-- why section -->
       <div class="center">
        <table>
            <tr>
           <th class="th_degg">Titre </th>
           <th class="th_degg">Quantite </th>
           <th class="th_degg">Prix</th>
           <th class="th_degg">Image</th>
           <th class="th_degg">Actions</th>
            </tr>

            <?php $totalprix=0;  ?>
            @foreach ($panier as $panier)
            <tr>
                <td>{{$panier->titre_produit}}</td>
                <td>{{$panier->quantite}}</td>
                <td>{{$panier->prix}}CFA</td>
                <td><img class="img_degg" src="/produit/{{$panier->image}}" alt=""></td>
                <td>
                    <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('/remove_panier',$panier->id)}}">supprimer le produit</a>
                </td>
                </tr>

                <?php $totalprix=$totalprix + $panier->prix  ?>

            @endforeach



        </table>
        <div>
            <h1 class="total_degg">Prix total: {{$totalprix}}CFA</h1>

        </div>

        <div>
            <h1 style="font-size: 25px; padding-bottom: 15px;">Passer à la commande</h1>
            <a href="{{url('cash_order')}}" class="btn btn-danger">Cash On Delivery</a>
            <a href="{{url('stripe', $totalprix)}}" class="btn btn-success">Pay Using Card</a>
            <a href="{{url('wave_payment', $totalprix)}}" class="btn btn-info">Pay with Wave</a>
            <a href="{{url('orange_money_payment', $totalprix)}}" class="btn btn-orange">Pay  Orange Money</a>
          </div>

       </div>

      <!-- footer start -->

      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2024 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">KeurguiTech</a>

         </p>
      </div>

      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script>
          function confirmation(ev) {
              ev.preventDefault();
              var urlToRedirect = ev.currentTarget.getAttribute('href');
              console.log(urlToRedirect);
              swal({
                  title: "Êtes-vous sûr de vouloir annuler ce produit ?",
                  text: "Vous ne pourrez pas revenir en arrière",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then((willCancel) => {
                  if (willCancel) {
                      window.location.href = urlToRedirect;
                  }
              });
          }
      </script>


      <!-- jQery -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
