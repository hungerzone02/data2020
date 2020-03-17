<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;
use Illuminate\Support\Facades\DB;
use crocodicstudio\crudbooster\controllers\partials\ButtonColor;

class AdminOrdersController extends CBController {



    public function cbInit()
    {
        $this->setTable("orders");
        $this->setPermalink("orders");
        $this->setPageTitle("Orders");

        $this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addText("Orders Table","orders_table")->strLimit(150)->maxLength(255);
		$this->addNumber("Orders Total","orders_total")->showDetail(false)->showAdd(false)->showEdit(false);
		
        $this->addSubModule("Order Detail", AdminOrdersDetailController::class, "orders_id", function ($row) {
            return [
            "Order ID"=> $row->primary_key,
            "Table No"=> $row->primary_key,
            ];
            });

            $this->addActionButton("Print", function($row) {
                return action("AdminOrdersController@getPrint",["id"=>$row->primary_key]);
                }, NULL, "fa fa-print", ButtonColor::LIGHT_BLUE, true);
    
                
    }
    public function getPrint($id) {
        $orders = DB::table('orders')->where('id', $id)->first();
        $orders_detail = DB::table('orders_detail')
        ->join('menu', 'orders_detail.menu_id', '=', 'menu.id')
        ->where('orders_id', $id)->get();
        return view("print",compact("orders","orders_detail"));
        }
        
}
