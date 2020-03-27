<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminPricingController extends CBController {


    public function cbInit()
    {
        $this->setTable("pricing");
        $this->setPermalink("pricing");
        $this->setPageTitle("Pricing");

        $this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addText("Pricing Name","pricing_name")->strLimit(150)->maxLength(255);
		$this->addSelectTable("Material","material_id",["table"=>"material","value_option"=>"id","display_option"=>"material_name","sql_condition"=>""]);
		$this->addNumber("Pricing Amount","pricing_amount");
		$this->addDate("Pricing Val From","pricing_valid_from")->format();
		$this->addDate("Pricing Val To","pricing_valid_to")->format();
		

    }
}
