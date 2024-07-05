  <!-- header section strats -->
  <header class="header_section">
    <div class="container">

       <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="{{url('/')}}"><img width="250" src="/images/ndama.png" alt="#" /></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav">
                <li class="nav-item active">
                   <a class="nav-link" href="{{url('/')}}">Accueil
                    <span class="sr-only">(current)</span></a>
                </li>
               <li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span class="caret"></span></a>
                   <ul class="dropdown-menu">
                      <li><a href="{{url('blog')}}">About</a></li>
                      <li><a href="{{url('all_produits')}}">Informatique</a></li>
                      <li><a href="{{url('blog')}}">Bureatique</a></li>
                      <li><a href="{{url('blog')}}">BTP</a></li>
                      <li><a href="{{url('blog')}}">Maintenance</a></li>
                   </ul>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="{{url('all_produits')}}">Produits</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="{{url('blog')}}">Blog</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="{{url('contact_nous')}}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('show_panier')}}">

                        Panier <span id="cart-count" class="badge badge-pill badge-danger">{{ \App\Models\Panier::where('user_id', Auth::id())->count() }}</span>
                    </a>
                </li>


                 <li class="nav-item">
                    <a class="nav-link" href="{{url('show_order')}}" style="color:skyblue;">Order</a>
                 </li>



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


                 @if (Route::has('login'))
    <ul class="navbar-nav ml-auto">
        @auth
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                        {{ __('Profil') }}
                    </a>

                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Déconnexion') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @else
            <li class="nav-item">
                <a class="btn btn-primary" id="logincss" href="{{ route('login') }}">Login</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-success" href="{{ route('register') }}">Register</a>
            </li>
        @endauth
    </ul>
@endif

             </ul>
          </div>
       </nav>
    </div>
 </header>
