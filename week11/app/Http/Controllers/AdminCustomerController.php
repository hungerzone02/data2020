<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminCustomerController extends CBController {


    public function cbInit()
    {
        $this->setTable("customer");
        $this->setPermalink("customer");
        $this->setPageTitle("Customer");

        $this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addText("Customer Name","customer_name")->strLimit(150)->maxLength(255);
		$this->addText("Customer Description","customer_description")->strLimit(150)->maxLength(255);
		

    }
}
