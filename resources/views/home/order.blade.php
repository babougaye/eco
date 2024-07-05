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

      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
      integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </head>
   <body>

        @include('home.header')
         <!-- end header section -->
         <style type="text/css">
            .center {
                margin: auto;
                width: 70%;
                padding: 30px;
                text-align: center;
            }

            table,th,td{
                border: 1px solid black;
            }

            .th_degg{
                padding: 10px;
                background-color: skyblue;
                font-size: 20px;
                font-weight: bold;
            }
            </style>
      <!-- footer start -->

      <!-- footer end -->
     <div class="center">
        <table>
        <tr>
            <th class="th_degg">Titre produit</th>
            <th class="th_degg">Quantite </th>
            <th class="th_degg">Prix </th>
            <th class="th_degg">Status paiement</th>
            <th class="th_degg">Status delivere</th>
            <th class="th_degg">Image</th>
            <th class="th_degg">Annuler </th>
        </tr>
           @foreach ($order as $order)


        <tr>
            <td>{{$order->titre_produit}}</td>
            <td>{{$order->quantite}}</td>
            <td>{{$order->prix}}</td>
            <td>{{$order->status_paiement}}</td>
            <td>{{$order->status_delivere}}</td>

            <td>
               <img height="100" width="180" src="produit/{{$order->image}}" >
            </td>

            <td>
                @if ($order->status_delivere=='processing')


                <a onclick="confirmation(event)" class="btn btn-danger" href="{{url('cancel_order',$order->id)}}">Annuler </a>


                @else
                <p style="color: blue;">Non autorisé</p>

                @endif
            </td>

        </tr>
        @endforeach
        </table>



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
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
