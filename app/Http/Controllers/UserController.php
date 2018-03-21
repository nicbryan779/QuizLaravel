<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\UserItem;
use Exception;

class UserController extends Controller
{
  protected $user;

  public function __construct(UserModel $user)
  {
    $this->user = $user;
  }

  public function register(Request $request)
  {
    $user = [
      "name"  => $request->name,
      "email"  => $request->email,
      "password"  => md5($request->password)
    ];

    try{
      $user = $this->user->create($user);
      return response('Created',201);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }

  public function all()
  {
    try{
      $user = $this->user->all();
      return $user;
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }

  public function find($id)
  {
    try{
      $user = $this->user->find($id);
      return $user;
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }

  public function delete($id)
  {

    try{
      $user = $this->user->where('id',$id)->delete();
      return response('Deleted',200);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }

  public function updateData(Request $request,$id)
  {
    $user = $this->user->find($id);

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    if($user->password == $request->input('password'))
    {

    }
    else
    {
      $user->password = md5($request->input('password'));
    }
    try{
      $user->save();
      return response('Updated',200);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }

  public function everything()
  {
    try{
      $user = $this->user->with('item')->get();
      return $user;
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }
}
