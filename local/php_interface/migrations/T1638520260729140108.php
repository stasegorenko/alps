<?php

namespace Sprint\Migration;


class T1638520260729140108 extends Version
{
    protected $description = "настройки ЧПУ";

    protected $moduleVersion = "4.2.4";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
		\CModule::IncludeModule('iblock');
		$iblockId = 21;  
		
		$ib = new \CIBlock;
		$res = $ib->Update($iblockId, [
			'LIST_PAGE_URL' => '#SITE_DIR#/blog/',
			'SECTION_PAGE_URL' => '#SITE_DIR#/blog/#SECTION_CODE#/',
			'DETAIL_PAGE_URL' => '#SITE_DIR#/blog/#SECTION_CODE#/#ELEMENT_CODE#/',
		]);
		
		if ($res) {
			echo 'URL списка успешно изменен!';
		} else {
			echo 'Ошибка: ' . $ib->LAST_ERROR;
		}

    }

    public function down()
    {
        //your code ...
    }
}
