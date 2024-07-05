<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Produit;
use App\Models\Panier;
use App\Models\Commentaire;
use Session; // Ajout de cette ligne pour importer la classe Session
use Stripe;
use App\Models\Contact;
use RealRashid\SweetAlert\Facades\Alert;



use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){

        $produit=Produit::paginate(10);
        return view('home.userpage',compact('produit'));
    }

    public function redirect() {

        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {

            $total_produit=produit::all()->count();

            $total_order=order::all()->count();

            $total_user=user::all()->count();

            $order=order::all();
            $total_revenue=0;
           foreach($order as $order){
            $total_revenue=$total_revenue+ $order->prix;



           }

           $total_livre=order::where('status_delivere','=','livre')->get()->count();

           $total_processing=order::where('status_delivere','=','processing')->get()->count();

            return view('admin.home',compact('total_produit','total_order','total_user','total_revenue','total_livre','total_processing'));
        } else {
            $produit=Produit::paginate(10);
            $commentaire=commentaire::all();
            return view('home.userpage',compact('produit','commentaire'));
        }

    }
    public function produit_details($id){
        $produit = Produit::find($id);
    return view('home.produit_details',compact('produit'));
    }


public function Ajouter_panier(Request $request, $id) {
    if (Auth::id()) {
        $user = Auth::user();
        $uerid = $user->id;
        $produit = Produit::find($id);
        $produit_exist_id = Panier::where('produit_id', '=', $id)
                                  ->where('user_id', '=', $uerid)
                                  ->get('id')
                                  ->first();

        if ($produit_exist_id) {
            $panier = Panier::find($produit_exist_id->id);
            $quantite = $panier->quantite;
            $panier->quantite = $quantite + $request->quantite;

            if ($produit->prix_remise != null) {
                $panier->prix = $produit->prix_remise * $panier->quantite;
            } else {
                $panier->prix = $produit->prix * $panier->quantite;
            }

            $panier->save();
            Alert::success('Produit ajouté avec succès', 'Nous avons ajouté le produit au panier');
            return redirect()->back()->with('message', 'Produit ajouté avec succès');
        } else {
            $panier = new Panier;
            $panier->prenom = $user->prenom;
            $panier->nom = $user->nom;
            $panier->email = $user->email;
            $panier->telephone = $user->telephone;
            $panier->addresse = $user->addresse;
            $panier->user_id = $user->id;
            $panier->titre_produit = $produit->titre;
            if ($produit->prix_remise != null) {
                $panier->prix = $produit->prix_remise * $request->quantite;
            } else {
                $panier->prix = $produit->prix * $request->quantite;
            }
            $panier->image = $produit->image;
            $panier->produit_id = $produit->id;
            $panier->quantite = $request->quantite;
            $panier->save();
            Alert::success('Produit ajouté avec succès', 'Nous avons ajouté le produit au panier');
            return redirect()->back()->with('message', 'Produit ajouté avec succès');
        }
    } else {
        return redirect('login');
    }
}


    public function show_panier(){
        if(Auth::id()){
            $id=Auth::user()->id;
            $panier =panier::where('user_id','=',$id)->get();
            return view('home.showpanier',compact('panier'));
        }
        else{
            return redirect('login');
        }

    }

    public function remove_panier($id){
        $panier=panier::find($id);
        $panier->delete();
        return redirect()->back()->with('message', 'produit suuprimée avec succès');
        Alert::success('Produit produit annuleée avec succès', 'Nous avons supprimeé le produit au panier');
        return redirect()->back()->with('message', 'Produit suuprimée avec succès');

    }
    public function cash_order(){
     $user = Auth::user();
     $uerid=$user->id;
     $data=Panier::where('user_id','=',$uerid)->get();
     foreach($data as $data){
      $order = new Order;
      $order->prenom=$data->prenom;
      $order->nom=$data->nom;
      $order->email=$data->email;
      $order->addresse = $data->addresse;
      $order->telephone = $data->telephone;
      $order->user_id=$data->user_id;
      $order->titre_produit=$data->titre_produit;
      $order->quantite=$data->quantite;
      $order->prix=$data->prix;

      $order->image=$data->image;
      $order->produit_id=$data->produit_id;
      $order->status_paiement='cash on delivere';
      $order->status_delivere ='processing';
      $order->save();

      $panier_id=$data->id;
      $panier=Panier::find($panier_id);
      $panier->delete();
     }
     return redirect()->back()->with('message', 'Nous avons bien reçu votre commande. Nous vous contacterons bientôt...');
    }
    public function cartCount() {
        if (Auth::check()) {
            $count = Panier::where('user_id', Auth::id())->count();
            return response()->json(['count' => $count]);
        } else {
            return response()->json(['count' => 0]);
        }
    }

    public function stripe($totalprix){

        return view('home.stripe',compact('totalprix'));
    }
    public function stripePost(Request $request, $totalprix)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
            "amount" => $totalprix * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for Payment ."
        ]);


        $user = Auth::user();
        $uerid = $user->id;
        $data = Panier::where('user_id', '=', $uerid)->get();
        foreach ($data as $data) {
            $order = new Order;
            $order->prenom = $data->prenom;
            $order->nom = $data->nom;
            $order->email = $data->email;
            $order->addresse = $data->addresse;
            $order->telephone = $data->telephone;
            $order->user_id = $data->user_id;
            $order->titre_produit = $data->titre_produit;
            $order->quantite = $data->quantite;
            $order->prix = $data->prix;

            $order->image = $data->image;
            $order->produit_id = $data->produit_id;
            $order->status_paiement = 'Payé';
            $order->status_delivere = 'processing';
            $order->save();

            $panier_id = $data->id;
            $panier = Panier::find($panier_id);
            $panier->delete();

        }

        session()->flash('success', 'Payment successful!');

        return back();
    }
    private function processOrder($totalprix, $paymentStatus)
    {
        $user = Auth::user();
        $userid = $user->id;
        $data = Panier::where('user_id', '=', $userid)->get();

        foreach ($data as $item) {
            $order = new Order;
            $order->prenom = $item->prenom;
            $order->nom = $item->nom;
            $order->email = $item->email;
            $order->user_id = $item->user_id;
            $order->addresse = $item->addresse;
            $order->telephone = $item->telephone;
            $order->titre_produit = $item->titre_produit;
            $order->quantite = $item->quantite;
            $order->prix = $item->prix;
            $order->image = $item->image;
            $order->produit_id = $item->produit_id;
            $order->status_paiement = $paymentStatus;
            $order->status_delivere = 'processing';
            $order->save();

            $item->delete();
        }
    }
    public function wavePayment($totalprix)
    {
        // Logique de paiement pour Wave
        // Exemple : Créez une vue pour Wave Payment
        return view('home.wave', compact('totalprix'));
    }

    public function wavePaymentPost(Request $request, $totalprix)
    {
        // Intégrez la logique spécifique de Wave ici
        // Par exemple, appeler l'API Wave pour traiter le paiement

        // Après traitement du paiement
        $this->processOrder($totalprix, 'Payé via Wave');

        session()->flash('success', 'Payment with Wave successful!');

        return back();
    }

    public function orangeMoneyPayment($totalprix)
    {
        // Logique de paiement pour Orange Money
        // Exemple : Créez une vue pour Orange Money Payment
        return view('home.orange_money', compact('totalprix'));
    }

    public function orangeMoneyPaymentPost(Request $request, $totalprix)
    {
        // Intégrez la logique spécifique d'Orange Money ici
        // Par exemple, appeler l'API Orange Money pour traiter le paiement

        // Après traitement du paiement
        $this->processOrder($totalprix, 'Payé via Orange Money');

        session()->flash('success', 'Payment with Orange Money successful!');

        return back();
    }
    public function show_order(){
        if(Auth::id()){

            $user=Auth::user();
            $userid=$user->id;
            $order=order::where('user_id','=',$userid)->get();
            return view('home.order',compact('order'));
        }
        else{
            return redirect('login');
        }
    }

    public function cancel_order($id){
        $order=order::find($id);
        $order->status_delivere = 'Vous avez annulé la commande';
            $order->save();
            return redirect()->back();

    }

   public function serach_produit(Request $request){
     $search_text=$request->search;
     $produit=produit::where('titre','LIKE',"%$search_text%")->orWhere('categorie','LIKE',"%$search_text%")->paginate(10);
     return view('home.userpage',compact('produit'));


   }



   public function produit(){
    $produit=produit::paginate(10);

    return view('home.all_produit',compact('produit'));
   }

   public function produit_search(Request $request){
    $search_text=$request->search;
    $produit=produit::where('titre','LIKE',"%$search_text%")->orWhere('categorie','LIKE',"%$search_text%")->paginate(10);
    return view('home.all_produit',compact('produit'));


  }


  public function contact_nous(){
    $produit=produit::paginate(10);
    return view('home.contact_nous',compact('produit'));
  }

  public function blog(){
    $produit=produit::paginate(10);
    return view('home.blog',compact('produit'));
  }
    }

