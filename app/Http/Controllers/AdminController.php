<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Hash;
use Auth;
use App\Models\User;
use App\Models\Product;

class AdminController extends Controller
{
        public function login(Request $request){
      if($request->isMethod('post')){
         $data = $request->input();
         if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
           //echo "Success"; die;
           //Sesion::put('adminSession',$data['email']);
           return redirect('admin/dashboard');
         }else{
           //echo "Failed"; die;
           return redirect('/admin')->with('flash_message_error','Invalid Username or Password');
         }
      }
      return view('admin.admin_login');
    }
    public function dashboard($id=null){
      $userCount = User::paginate();
      $orderCount = Order::paginate();
      $productsAll = Product::paginate();
      $couponCount = Coupon::paginate();
      $categoryCount = Category::paginate();
      /*if(Session::has('adminSession')){
        //perform all dashboard taks
      }else{
        return redirect('/admin')->with('flash_message_error','Please login to Success');
      }*/
      return view('admin.dashboard')->with(compact('userCount','orderCount','productsAll','couponCount','categoryCount'));
    }
    public function settings(){
      return view('admin.settings');
    }
    public function chkpassword(){
      $data = $request->all();
      $current_password = $data['current_pwd'];
      $check_password = User::where(['admin'=>'1'])->first();
      if(Hash::check($current_password,$check_password->password)){
        echo "true";die;
      }else{
        echo "false";die;
      }
    }
    
    public function logout(){
      Session::flush();
      return redirect('/admin')->with('flash_message_success','Logged Out Successfully!!!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
