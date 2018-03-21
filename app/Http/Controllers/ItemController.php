<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemModel;
use Exception;

class ItemController extends Controller
{
  protected $item;

  public function __construct(ItemModel $item)
  {
    $this->item = $item;
  }

  public function register(Request $request)
  {
    $item = [
      "user_id"  => $request->user_id,
      "name"  => $request->name,
      "price"  => $request->price,
      "stock" => $request->stock
    ];

    try{
      $item=$this->item->create($item);
      return response('Created',201);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }

  public function all()
  {
    try{
      $item = $this->item->all();
      return $item;
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }

  public function find($id)
  {
    try{
      $item = $this->item->find($id);
      return $item;
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }

  public function delete($id)
  {

    try{
      $item = $this->item->where('id',$id)->delete();
      return response('Deleted',200);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }

  public function updateData(Request $request,$id)
  {
    $item = $this->item->find($id);

    $item->user_id = $request->input('user_id');
    $item->name = $request->input('name');
    $item->price = $request->input('price');
    $item->stock = $request->input('stock');

    try{
      $item->save();
      return response('Updated',200);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }
}
