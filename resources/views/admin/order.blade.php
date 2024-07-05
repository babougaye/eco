<!DOCTYPE html>
<html lang="en">
  <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('admin.css')
 <!-- Required meta tags -->
 <style type="text/css">
    .titre_degg {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        padding-bottom: 40px;
    }
     .table-degg{
        border: 2px solid white;
        width: 100%;
        margin: auto;

        text-align: center;
     }
     .th_degg{
       background-color: skyblue;
     }

     .img_size{
        width: 90px;
        height: 90px;
     }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

               <h1 class="titre_degg">Tous les commandes</h1>

               <div style="padding-left:400px; padding-bottom:30px;">
                <form action="{{url('search')}}" method="GET">
                    @csrf
                    <input type="text" style="color: black;" name="search" placeholder="Rechercher...">
                    <input type="submit" value="Search" class="btn btn-outline-primary">
                </form >
               </div>

               <table class="table-degg">
                <tr class="th_degg">
                    <th style="padding:8px;">Prenom</th>
                    <th style="padding:8px;">Nom</th>
                    <th style="padding:8px;">Email</th>

                    <th style="padding:8px;">Produit</th>
                    <th style="padding:8px;">Quantite</th>
                    <th style="padding:8px;">Prix</th>
                    <th style="padding:8px;">Paiement</th>
                    <th style="padding:8px;">Delivere</th>
                    <th style="padding:8px;">Image</th>
                    <th style="padding:8px;">Livré</th>
                    <th style="padding:8px;">Imprimer </th>


                </tr>
                  @forelse ($order as $order)


                <tr >
                    <td>{{$order->prenom}}</td>
                    <td>{{$order->nom}}</td>
                    <td>{{$order->email}}</td>

                    <td>{{$order->titre_produit}}</td>
                    <td>{{$order->quantite}}</td>
                    <td>{{$order->prix}}</td>
                    <td>{{$order->status_paiement}}</td>
                    <td>{{$order->status_delivere}}</td>
                    <td>
                        <img class="img_size" src="/produit/{{$order->image}}" >
                    </td>

                    <td>
                        @if ($order->status_delivere == 'processing')
                        <a href="{{url('delivered',$order->id)}}" onclick="confirmation(event)" class="btn btn-primary">Livré</a>

                    @else

                    <p style="color:green;">Livré</p>
                    @endif

                      <td>
                        <a href="{{url('print_pdf',$order->id)}}" class="btn btn-inverse-secondary">Imprimer PDF</a>
                      </td>



                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="16">No Data Found </td>
                </tr>
                @endforelse
               </table>
            </div>
        </div>
    <!-- container-scroller -->
    @include('admin.script')
    <!-- plugins:js -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                title: "Êtes-vous sûr de vouloir livrer ?",
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
  </body>
</html>
