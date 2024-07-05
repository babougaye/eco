<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category; // Correction ici

use App\Models\Produit;
use App\Models\Panier;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use PDF;
class AdminController extends Controller
{
   public function Voir_category(){
    $data = Category::all();
    if(Auth::id()){
        return view('admin.category',compact('data'));
    }
    else{
        return redirect('login');
    }
   }

   public function ajout_category(Request $request){
      $data = new Category(); // Correction ici

      $data->nom_categorie = $request->category;

      $data->save();

      return redirect()->back()->with('message', 'categorie ajoutée avec succès');

   }
   public function delete_categorie($id){
   $data = Category::find($id);
   $data->delete();
   return redirect()->back()->with('message', 'categorie supprimée avec succès');
   }
   public function Voir_produit(){
   $category = Category::all();
   return view('admin.produit',compact('category'));
   }

   public function ajout_produit(Request $request){
    $produit = new Produit();
    $produit->titre=$request->titre;
    $produit->description=$request->description;

    $produit->quantite=$request->quantite;
    $produit->prix=$request->prix;
    $produit->prix_remise=$request->prix_remise;
    $produit->categorie=$request->categorie;

    $image = $request->file('image');
    $imagenom = time() . '.' . $image->getClientOriginalExtension();
    $image->move('produit', $imagenom);

    $produit->image = $imagenom;

    $produit->save();
    return redirect()->back()->with('message', 'produit ajouteée avec succès');

   }
   public function show_produit(){
    $produit = Produit::all();
    return view('admin.show_produit',compact('produit'));

   }
   public function supprimer_produit($id){
    $produit = Produit::find($id);
    $produit->delete(); // Utilisez la méthode delete() pour supprimer le produit
    return redirect()->back()->with('message', 'produit supprimé avec succès');
}

public function modifier_produit($id){
    $produit=Produit::find($id);
    $category = Category::all();

    return view('admin.modifier_produit',compact('produit','category'));

}
public function modifier_produit_confirm(Request $request, $id){

   if(Auth::id()){
    $produit=Produit::find($id);
    $produit->titre=$request->titre;
    $produit->description=$request->description;
    $produit->categorie=$request->categorie;
    $produit->quantite=$request->quantite;
    $produit->prix=$request->prix;
    $produit->prix_remise=$request->prix_remise;

    $image=$request->image;
    if($image){
        $image = $request->file('image');
    $imagenom = time() . '.' . $image->getClientOriginalExtension();
    $image->move('produit', $imagenom);

    $produit->image = $imagenom;


    $produit->image=$imagenom;

    }
    $produit->save();
    return redirect()->back()->with('message', 'produit modifié avec succès');
   }

   else{
    return redirect('login');
   }

}

 public function order(){
   $order =order::all();
    return view('admin.order',compact('order'));
 }

 public function delivered($id){
  $order = order::find($id);
  $order->status_delivere = "Livré";

  $order->status_paiement = "Payé";

  $order->save();

  return redirect()->back();
 }

 public function print_pdf($id){
    $order=order::find($id);
   $pdf =PDF::loadView('admin.pdf',compact('order'));
   return $pdf->download('order_details.pdf');
 }

 public function envoyer_email($id){
    $order=order::find($id);
    return view('admin.email_info',compact('order'));
 }

 public function send_user_email($id){
    $order=order::find($id);


 }
  public function searchdata(Request $request){
    $searchText=$request->search;
    $order=order::where('prenom','LIKE',"%$searchText%")->orWhere('prenom','LIKE',"%$searchText%")
    ->orWhere('titre_produit','LIKE',"%$searchText%")->get();
    return view('admin.order' ,compact('order'));

  }
}

