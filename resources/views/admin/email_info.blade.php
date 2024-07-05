<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    @include('admin.css')
 <!-- Required meta tags -->
 <style type="text/css">

    label{
        display: inline-block;
        width: 200px;
        font-size: 15px;
        font-weight: bold;
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
             <h1 style="text-align: center; font-size:25px;">Envoyer email au {{$order->email}}</h1>

             <form action="{{url('send_user_email',$order->id)}}" method="POST">
                @csrf
                <div style="padding-left: 35%; padding-top: 30px;">
                    <label>Salutation de l'e-mail</label>
                    <input type="text" name="greeting">
                </div>

                <div style="padding-left: 35%; padding-top: 30px;">
                    <label>Introduction de l'e-mail</label>
                    <input type="text" name="firstline">
                </div>

                <div style="padding-left: 35%; padding-top: 30px;">
                    <label>Corps de l'e-mail</label>
                    <input type="text" name="body">
                </div>

                <div style="padding-left: 35%; padding-top: 30px;">
                    <label>Nom du bouton de l'e-mail</label>
                    <input type="text" name="button">
                </div>

                <div style="padding-left: 35%; padding-top: 30px;">
                    <label>URL de l'e-mail</label>
                    <input type="text" name="url">
                </div>

                <div style="padding-left: 35%; padding-top: 30px;">
                    <label>Dernière ligne de l'e-mail</label>
                    <input type="text" name="lastline">
                </div>

                <div style="padding-left: 35%; padding-top: 30px;">
                    <input type="submit" value="Envoyer e-mail" class="btn btn-primary">
                </div>
            </form>

            </div>

        </div>

    <!-- container-scroller -->
    @include('admin.script')
    <!-- plugins:js -->

  </body>
</html>
