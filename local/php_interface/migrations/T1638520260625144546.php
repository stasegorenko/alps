<?php

namespace Sprint\Migration;


class T1638520260625144546 extends Version
{
    protected $description = "разделы инфоблока";

    protected $moduleVersion = "4.2.4";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();

        $iblockId = $helper->Iblock()->getIblockIdIfExists(
            'articles',
            'content'
        );

        $helper->Iblock()->addSectionsFromTree(
            $iblockId,
            array (
  0 => 
  array (
    'NAME' => 'Видеоинструкции',
    'CODE' => 'videoinstruktsii',
    'SORT' => '5',
    'ACTIVE' => 'Y',
    'XML_ID' => '11',
    'DESCRIPTION' => NULL,
    'DESCRIPTION_TYPE' => 'text',
  ),
  1 => 
  array (
    'NAME' => 'Видеообзоры',
    'CODE' => 'videoobzory',
    'SORT' => '10',
    'ACTIVE' => 'Y',
    'XML_ID' => '12',
    'DESCRIPTION' => NULL,
    'DESCRIPTION_TYPE' => 'text',
  ),
  2 => 
  array (
    'NAME' => 'Как выбрать?',
    'CODE' => 'kak-vybrat',
    'SORT' => '20',
    'ACTIVE' => 'Y',
    'XML_ID' => '13',
    'DESCRIPTION' => NULL,
    'DESCRIPTION_TYPE' => 'text',
  ),
  3 => 
  array (
    'NAME' => 'Технологии',
    'CODE' => 'tekhnologii',
    'SORT' => '30',
    'ACTIVE' => 'Y',
    'XML_ID' => '14',
    'DESCRIPTION' => NULL,
    'DESCRIPTION_TYPE' => 'text',
  ),
  4 => 
  array (
    'NAME' => 'Обзоры',
    'CODE' => 'obzory',
    'SORT' => '40',
    'ACTIVE' => 'Y',
    'XML_ID' => '15',
    'DESCRIPTION' => NULL,
    'DESCRIPTION_TYPE' => 'text',
  ),
  5 => 
  array (
    'NAME' => 'Интересные видео',
    'CODE' => 'interesnye-video',
    'SORT' => '50',
    'ACTIVE' => 'Y',
    'XML_ID' => '16',
    'DESCRIPTION' => NULL,
    'DESCRIPTION_TYPE' => 'text',
  ),
)        );
    }

    public function down()
    {
        //your code ...
    }
}
