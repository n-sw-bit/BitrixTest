<?php

namespace Sprint\Migration;

use Bitrix\Main\Application;
use Bitrix\Main\Entity\FavouriteTable;


class Versionx120170313190804 extends Version {

    protected $description = "таблица пользователей";

    public function up(){
        $helper = new HelperManager();
		
        $connection = Application::getConnection();
        $connection->createTable(FavouriteTable::getTableName(), FavouriteTable::getMap(), ['ID'], ['ID']);

    }

    public function down(){
        $helper = new HelperManager();
		
		$connection = Application::getConnection();
        if ($connection->isTableExists( FavouriteTable::getTableName() ))
            $connection->dropTable( FavouriteTable::getTableName() );

    }

}
