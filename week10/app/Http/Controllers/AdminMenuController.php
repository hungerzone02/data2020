<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminMenuController extends CBController {


    public function cbInit()
    {
        $this->setTable("menu");
        $this->setPermalink("menu");
        $this->setPageTitle("Menu");

        $this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addText("Menu Name","menu_name")->strLimit(150)->maxLength(255);
		$this->addNumber("Menu Price","menu_price");
		

    }
}
