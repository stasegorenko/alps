<?php

namespace Sprint\Migration;


class T1638520260803104813 extends Version
{
    protected $author = "oneit";

    protected $description = "разделы инфоблока";

    protected $moduleVersion = "5.13.0";

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

        $helper->Iblock()->saveSectionsFromTree(
            $iblockId,
            array (
  0 => 
  array (
    'NAME' => 'Видеоинструкции',
    'CODE' => 'videoinstruktsii',
    'SORT' => '5',
    'ACTIVE' => 'Y',
    'XML_ID' => '11',
    'PICTURE' => NULL,
    'DESCRIPTION' => NULL,
    'DESCRIPTION_TYPE' => 'text',
    'DETAIL_PICTURE' => NULL,
  ),
  1 => 
  array (
    'NAME' => 'Видеообзоры',
    'CODE' => 'videoobzory',
    'SORT' => '10',
    'ACTIVE' => 'Y',
    'XML_ID' => '12',
    'PICTURE' => NULL,
    'DESCRIPTION' => NULL,
    'DESCRIPTION_TYPE' => 'text',
    'DETAIL_PICTURE' => NULL,
  ),
  2 => 
  array (
    'NAME' => 'Как выбрать?',
    'CODE' => 'kak-vybrat',
    'SORT' => '20',
    'ACTIVE' => 'Y',
    'XML_ID' => '13',
    'PICTURE' => NULL,
    'DESCRIPTION' => NULL,
    'DESCRIPTION_TYPE' => 'text',
    'DETAIL_PICTURE' => NULL,
  ),
  3 => 
  array (
    'NAME' => 'Технологии',
    'CODE' => 'tekhnologii',
    'SORT' => '30',
    'ACTIVE' => 'Y',
    'XML_ID' => '14',
    'PICTURE' => NULL,
    'DESCRIPTION' => NULL,
    'DESCRIPTION_TYPE' => 'text',
    'DETAIL_PICTURE' => NULL,
  ),
  4 => 
  array (
    'NAME' => 'Обзоры',
    'CODE' => 'obzory',
    'SORT' => '40',
    'ACTIVE' => 'Y',
    'XML_ID' => '15',
    'PICTURE' => NULL,
    'DESCRIPTION' => NULL,
    'DESCRIPTION_TYPE' => 'text',
    'DETAIL_PICTURE' => NULL,
  ),
  5 => 
  array (
    'NAME' => 'Интересные видео',
    'CODE' => 'interesnye-video',
    'SORT' => '50',
    'ACTIVE' => 'Y',
    'XML_ID' => '16',
    'PICTURE' => NULL,
    'DESCRIPTION' => NULL,
    'DESCRIPTION_TYPE' => 'text',
    'DETAIL_PICTURE' => NULL,
  ),
)        );
    }
}
