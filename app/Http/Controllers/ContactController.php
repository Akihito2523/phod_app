<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Phod;

// class ContactController extends Controller {

//     public function index(Request $request, Phod $phod) {
//         return view('phods.contact');
//     }

//     // public function contact(Request $request, Phod $phod) {
//     //     return view('phods.contact');
//     // }

//     public function store(Request $request) {
//         // $contact = new Contact();
//         // $contact->name = $request->name;
//         // $contact->email = $request->email;
//         // $contact->message = $request->message;
//         $contact = new Contact($request->all());
//         // dd($contact);
//         // $contact->save();

//         return redirect()
//             ->route('phods.index', compact('contact'))
//             ->with('notice', 'お問い合わせが完了しました。');
//     }
// }
