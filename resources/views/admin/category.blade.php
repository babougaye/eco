<!DOCTYPE html>
<html lang="en">
  <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @include('admin.css')
    <style type="text/css">
    .div_center{
        text-align: center;
        padding-top: 40px;

    }
    .h2_font{
        font-size: 40px;
        padding-bottom: 40px;
    }
    .input_color{
        color: black;
    }
    .center{
        margin: auto;
        width: 50%;
        text-align: center;
         margin-top: 30px;
         border: 3px solid white;
    }
    </style>
 <!-- Required meta tags -->
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

           <div class="div_center">
            <h2 class="h2_font">Ajouter un categorie</h2>

            <form action="{{url('/ajout_category')}}" method="POST">

            @csrf
            <input class="input_color" type="text" name="category" placeholder="Ecrire le nom de la categorie">

                <input type="submit" class="btn btn-primary" name="submit" value="Ajouter une categorie">
            </form>


           </div>
           <table class="center">
            <tr>
                <td> Nom de Categorie</td>
                <td>Actions</td>
            </tr>

            @foreach ($data as $data)
            <tr>

                <td>{{$data->nom_categorie}}</td>
                <td>
                    <a onclick="confirmation(event)"  class="btn btn-danger" href="{{url('delete_categorie',$data->id)}}">Supprimer</a>
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
  </body>
</html>
