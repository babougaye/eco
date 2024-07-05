<section class="product_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">

        <div>
            <form action="{{url('produits_search')}}" method="get">
                @csrf
                <input style="width: 500px;" type="text" name="search" placeholder="rechercher...">
            <input type="submit" value="search">
            </form>
        </div>

       </div>
       @if (session()->has('message'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Success!',
                text: '{{ session()->get('message') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif


       @if (session()->has('message'))
       <div class="alert alert-success">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
           {{ session()->get('message') }}
       </div>
       @endif
       <div class="row">

        @foreach ($produit as $produits)

          <div class="col-sm-6 col-md-4 col-lg-4">
            <div class="box">
               <div class="option_container">
                  <div class="options">
                     <a href="{{url('produit_details' ,$produits->id)}}" class="option1">
                     Details produit
                     </a>
                    <form action="{{url('Ajouter_panier',$produits->id)}}" method="post">
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
               <div class="img-box">
                  <img src="produit/{{$produits->image}}" alt="">
               </div>
               <div class="detail-box">
                  <h5>
                   {{  $produits->titre}}
                  </h5>

                  @if ($produits->prix_remise!=null)
                  <h6 style="color: red;">
                    Prix remise
                    <br>
                    {{  $produits->prix_remise}}CFA
                  </h6>

                  <h6 style="text-decoration: line-through; color:blue;">
                    {{  $produits->prix}}CFA
                    Prix
                    <br>
                  </h6>

                  @else
                  <h6 style="color: blue;">
                    {{  $produits->prix}}CFA
                    Prix
                    <br>
                  </h6>
                  @endif


               </div>
            </div>
         </div>

        @endforeach
       <span style="padding-top: 20px;">
     {!!$produit->withQueryString()->links('pagination::bootstrap-5')!!}
    </span>
    </div>
 </section>
