<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;
use Illuminate\Support\Facades\DB;

class AdminOrdersDetailController extends CBController {


    public function cbInit()
    {
        $this->setTable("orders_detail");
        $this->setPermalink("orders_detail");
        $this->setPageTitle("Orders Detail");

        $this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addSelectTable("Menu","menu_id",["table"=>"menu","value_option"=>"id","display_option"=>"menu_name","sql_condition"=>""]);
        $this->addNumber("Qty","qty");
        $this->addNumber("Order_ID","orders_id");
		$this->addNumber("Price","price")->showDetail(false)->showAdd(false)->showEdit(false);
		$this->addText("Net","net")->showDetail(false)->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		
        $this->hookBeforeInsert(function($data) {

            # Auto Insert Price & Net Data
            
            $menu_price = DB::table('menu')->where('id',$data['menu_id'])->value('menu_price');
            
            $data['price'] = $menu_price;
            
            $data['net'] = $data['qty'] * $menu_price;
            
            # Auto Insert Total Price Data in Orders
            
            $orders_total = DB::table('orders')->where('id',$data['orders_id'])->value('orders_total');
            
            DB::table('orders')->where('id', $data['orders_id'])->update(['orders_total'=>
            $orders_total+$data['net']]);
            
            return $data;
            
            });

            $this->hookBeforeUpdate(function($data, $id) {

                # Auto Update Price & Net Data
                
                $menu_price = DB::table('menu')->where('id',$data['menu_id'])->value('menu_price');
                
                $data['price'] = $menu_price;
                
                $data['net'] = $data['qty'] * $menu_price;
                
                # Retrieve old net price from Orders_Detail
                
                $oldnet = DB::table('orders_detail')->where('id', $id)->value('net');
                
                # Auto Update Total Price Data in Orders
                
                $orders_total = DB::table('orders')->where('id',$data['orders_id'])->value('orders_total');
                
                DB::table('orders')->where('id', $data['orders_id'])->update(['orders_total'=>
                $orders_total-$oldnet+$data['net']]);
                
                return $data;
                
                });

                $this->hookBeforeDelete(function($id) {

                    # Auto Delete Total Price Data in Orders
                    
                    $data = DB::table('orders_detail')->where('id', $id)->first();
                    
                    $orders_id = $data->orders_id;
                    
                    $net = $data->net;
                    
                    $orders_total = DB::table('orders')->where('id',$orders_id)->value('orders_total');
                    
                    DB::table('orders')->where('id', $orders_id)->update(['orders_total'=> $orders_total - $net]);
                    
                    return true;
                    
                    });
    }
}
