<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminMaterialController extends CBController {


    public function cbInit()
    {
        $this->setTable("material");
        $this->setPermalink("material");
        $this->setPageTitle("Material");

        $this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addText("Material Name","material_name")->strLimit(150)->maxLength(255);
		$this->addText("Material Category","material_category")->strLimit(150)->maxLength(255);
		

    }
}
