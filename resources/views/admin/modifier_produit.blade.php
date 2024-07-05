<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
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
            <h1 class="font_size">Modifier produit</h1>
           <form action="{{url('/modifier_produit_confirm',$produit->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="div_lot">
                <label >Titre du produit:</label>
                <input  class="foot_color" type="text" name="titre" placeholder="Ecrire le titre" required="" value="{{$produit->titre}}">
            </div>

            <div class="div_lot">
                <label >Description du produit:</label>
                <input  class="foot_color" type="text" name="description" placeholder="Ecrire la description"required="" value="{{$produit->description}}">
            </div>
            <div class="div_lot">
                <label >Quantite du produit:</label>
                <input  class="foot_color" type="number" min="0"  name="quantite" placeholder="Ecrire la quantite"required="" value="{{$produit->quantite}}">
            </div>
            <div class="div_lot">
                <label >Prix du produit:</label>
                <input  class="foot_color" type="number"  name="prix" placeholder="Ecrire le prix"required="" value="{{$produit->prix}}">
            </div>
            <div class="div_lot">
                <label >Remise du prix:</label>
                <input  class="foot_color" type="number" name="prix_remise" placeholder="Ecrire le remise"required="" value="{{$produit->prix_remise}}">
            </div>

            <div class="div_lot">
                <label >Categorie du produit:</label>
               <select class="foot_color" name="categorie" required="" >

                <option value="{{$produit->categorie}}"  selected="">{{$produit->categorie}}</option>

                @foreach ($category as $category )

                <option value="{{$category->nom_categorie}}">
                    {{$category->nom_categorie}}</option>
                @endforeach

               </select>
            </div>

            <div class="div_lot">
                <label>Actuelle image du produit:</label>
                 <img style="margin: auto;" height="100" width="100" src="/produit/{{$produit->image}}" >
            </div>


            <div class="div_lot">
                <label>Changer image du produit:</label>
                <input type="file" name="image">
            </div>


            <div class="div_lot">

                <input type="submit" value="Modifier produit" class="btn btn-primary">
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
