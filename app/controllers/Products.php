<?php

namespace app\controllers;

use mako\view\ViewFactory;
// use mako\http\Request;
use app\models\Product;

class Products extends BaseController
{
    public function show(ViewFactory $view)
    {
        $products = $this->filter(new Product())->ordersCount()->ascending('name')->paginate();

        return $view->assign('products', $products)->render('products');
    }

    public function filter(Product $query)
    {
        // search filter
        if ($this->request->getQuery()->get('s')) {
            $query = $query->search($this->request->getQuery()->get('s'));
        }
        // id filter
        if ($this->request->getQuery()->get('id')) {
            $query = $query->where('id', '=', $this->request->getQuery()->get('id'));
        }

        return $query;
    }

    public function get(ViewFactory $view, $id)
    {
        $product = Product::get($id);

        return $view->assign('product', $product)->render('product');
    }

    public function new(ViewFactory $view)
    {
        return $view->render('product');
    }

    public function create(ViewFactory $view)
    {
        $product = new Product();
        $product->assign($this->request->getPost()->all());
        $product->unitprice = 0 != $this->request->getPost()->get('unitprice') ? $this->request->getPost()->get('unitprice') : null;
        $product->save();

        $this->session->putFlash('msg', 'Utworzono produkt "'.$product->name.'"|success');

        return $this->back();
    }

    public function update(ViewFactory $view, $id)
    {
        $product = Product::get($id);
        $product->assign($this->request->getPost()->all());
        $product->unitprice = 0 != $this->request->getPost()->get('unitprice') ? $this->request->getPost()->get('unitprice') : null;
        $product->save();

        $this->session->putFlash('msg', 'Zaktualizowano produkt #'.$product->id.'|success');

        return $this->back();
    }

    public function productDeleteModal(ViewFactory $view, $id)
    {
        $product = Product::get($id);

        return $view->assign('question', 'Czy chcesz usunąć produkt "'.$product->name.'"?')->
            assign('action', '/product/delete')->
            assign('data', ['product_id' => $product->id])->
            render('chunks.confirmModal');
    }

    public function delete(ViewFactory $view)
    {
        $product = Product::get($this->request->getPost()->get('product_id'));

        $product->delete();

        $this->session->putFlash('msg', 'Usunięto produkt "'.$product->name.'".|danger');

        return $this->current();
    }

    public function select()
    {
        $items = [];
        $product = Product::search($this->request->getQuery()->get('s'))->ascending('name');
        $count = $product->all()->count();
        foreach ($product->paginate(10) as $obj) {
            $items[] = ['id' => $obj->id, 'text' => $obj->name.' ('.($obj->unit->name ?? '###').')', 'uprice' => $obj->unitprice];
        }
        $result = ['items' => $items, 'total_count' => $count];

        return json_encode($result);
    }
}
