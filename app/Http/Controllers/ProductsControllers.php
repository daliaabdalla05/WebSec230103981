<?php class ProductsController extends Controller{
    public function list (Request $request){
    return view('products.list')
}
}