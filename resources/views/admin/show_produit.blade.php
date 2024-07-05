<!DOCTYPE html>
<html lang="en">
  <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('admin.css')
 <!-- Required meta tags -->
 <style type="text/css">

    .center{
       margin: auto;
       width: 50%;
      border: 2px solid white;
      text-align: center;
      margin-top: 40px;

    }
   .font_size{
    text-align: center;
    font-size: 40px;
    padding-top: 20px;
   }
   .img_size{
    width: 150px;
    height:  150px;

   }
   .tr_color{
    background: skyblue;
   }
   .tr_dek{
    padding: 20px;
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

                @if (session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
            @endif
            <h2 class="font_size">Tous les produits</h2>
                <table class="center">
                    <tr class="tr_color">
                        <th class="tr_dek">Titre  </th>
                        <th class="tr_dek">Description</th>
                        <th class="tr_dek">Categorie</th>
                        <th class="tr_dek">Quantite</th>
                        <th class="tr_dek">Prix</th>
                        <th class="tr_dek">Remise</th>
                        <th class="tr_dek">Image </th>
                        <th class="tr_dek">Supprimer</th>
                        <th class="tr_dek">Modifier</th>
                    </tr>
                    @foreach ($produit as $produit)


                    <tr>
                        <td>{{$produit->titre}}</td>
                        <td>{{$produit->description}}</td>
                        <td>{{$produit->categorie}}</td>
                        <td>{{$produit->quantite}}</td>
                        <td>{{$produit->prix}}</td>
                        <td>{{$produit->prix_remise}}</td>
                        <td>
                            <img class="img_size" src="/produit/{{$produit->image}}" alt="">
                        </td>
                        <td>
                            <a class="btn btn-danger"  onclick="confirmation(event)" href="{{url('supprimer_produit',$produit->id)}}">Supprimer</a>
                        </td>
                        <td>
                            <a class="btn btn-success" href="{{url('modifier_produit',$produit->id)}}">Modifier</a>
                        </td>
                    </tr>
                    @endforeach
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
                title: "Êtes-vous sûr de vouloir supprimer le produit ?",
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
