<!DOCTYPE html>
<html lang="en">
  <head>

    @include('admin.css')
 <!-- Required meta tags -->
 <style type="text/css">

    .div_center{
        text-align: center;
        padding-top: 40px;

    }
    .font_size{
        font-size: 20px;
        padding-bottom: 20px;
    }
    .foot_color{
        color: black;
        padding-bottom: 20px;

    }
    label{
        display: inline-block;
        width: 200px;
    }
    .div_lot{
        padding-bottom: 15px;
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
            <div class="div_center">
            <h1 class="font_size">Aouter un produit</h1>
           <form action="{{url('/ajout_produit')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="div_lot">
                <label >Titre du produit:</label>
                <input  class="foot_color" type="text" name="titre" placeholder="Ecrire le titre" required="">
            </div>

            <div class="div_lot">
                <label >Description du produit:</label>
                <input  class="foot_color" type="text" name="description" placeholder="Ecrire la description"required="">
            </div>
            <div class="div_lot">
                <label >Quantite du produit:</label>
                <input  class="foot_color" type="number" min="0"  name="quantite" placeholder="Ecrire la quantite"required="">
            </div>
            <div class="div_lot">
                <label >Prix du produit:</label>
                <input  class="foot_color" type="number"  name="prix" placeholder="Ecrire le prix"required="">
            </div>
            <div class="div_lot">
                <label >Remise du prix:</label>
                <input  class="foot_color" type="number" name="prix_remise" placeholder="Ecrire le remise"required="">
            </div>

            <div class="div_lot">
                <label >Categorie du produit:</label>
               <select class="foot_color" name="categorie" >

                <option value=""selected="">Ajout une categorie ici</option>
                @foreach ($category as $category )

                <option value="{{$category->nom_categorie}}">
                    {{$category->nom_categorie}}</option>
                @endforeach

               </select>
            </div>
            <div class="div_lot">
                <label >Image du produit:</label>
                <input type="file" name="image"required="">
            </div>


            <div class="div_lot">

                <input type="submit" value="Ajout produit" class="btn btn-primary">
            </div>
           </form>
            </div>
            </div>
        </div>
    <!-- container-scroller -->
    @include('admin.script')
    <!-- plugins:js -->

  </body>
</html>
