<?php
namespace Altaykz;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;
use Bitrix\Main\Type\DateTime;

/**
 * Class OrdersTable
 * 
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> TITLE string(255) mandatory
 * <li> ROOM_ID int mandatory
 * <li> DATE_START datetime mandatory
 * <li> DATE_END datetime mandatory
 * <li> TIME_START string(255) mandatory
 * <li> TIME_END string(255) mandatory
 * <li> FIO string(255) mandatory
 * <li> EMAIL string(255) mandatory
 * <li> PHONE string(255) mandatory
 * <li> CREATED datetime optional default current datetime
 * <li> PEOPLE string(255) mandatory
 * <li> CHILDS int optional
 * <li> IF_VV int optional
 * <li> IF_BESEDKA int optional
 * <li> PAY int optional
 * <li> SUMM int optional
 * <li> SITE_ID string(255) optional
 * </ul>
 *
 * @package Bitrix\Orders
 **/

class OrdersTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'altaykz_orders';
	}

	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 */
	public static function getMap()
	{
		return [
			new IntegerField(
				'ID',
				[
					'primary' => true,
					'autocomplete' => true,
					'title' => Loc::getMessage('ORDERS_ENTITY_ID_FIELD'),
				]
			),
			new StringField(
				'TITLE',
				[
					'required' => true,
					'validation' => function()
					{
						return[
							new LengthValidator(null, 255),
						];
					},
					'title' => Loc::getMessage('ORDERS_ENTITY_TITLE_FIELD'),
				]
			),
			new IntegerField(
				'ROOM_ID',
				[
					'required' => true,
					'title' => Loc::getMessage('ORDERS_ENTITY_ROOM_ID_FIELD'),
				]
			),
			new DatetimeField(
				'DATE_START',
				[
					'required' => true,
					'title' => Loc::getMessage('ORDERS_ENTITY_DATE_START_FIELD'),
				]
			),
			new DatetimeField(
				'DATE_END',
				[
					'required' => true,
					'title' => Loc::getMessage('ORDERS_ENTITY_DATE_END_FIELD'),
				]
			),
			new StringField(
				'TIME_START',
				[
					'required' => true,
					'validation' => function()
					{
						return[
							new LengthValidator(null, 255),
						];
					},
					'title' => Loc::getMessage('ORDERS_ENTITY_TIME_START_FIELD'),
				]
			),
			new StringField(
				'TIME_END',
				[
					'required' => true,
					'validation' => function()
					{
						return[
							new LengthValidator(null, 255),
						];
					},
					'title' => Loc::getMessage('ORDERS_ENTITY_TIME_END_FIELD'),
				]
			),
			new StringField(
				'FIO',
				[
					'required' => true,
					'validation' => function()
					{
						return[
							new LengthValidator(null, 255),
						];
					},
					'title' => Loc::getMessage('ORDERS_ENTITY_FIO_FIELD'),
				]
			),
			new StringField(
				'EMAIL',
				[
					'required' => true,
					'validation' => function()
					{
						return[
							new LengthValidator(null, 255),
						];
					},
					'title' => Loc::getMessage('ORDERS_ENTITY_EMAIL_FIELD'),
				]
			),
			new StringField(
				'PHONE',
				[
					'required' => true,
					'validation' => function()
					{
						return[
							new LengthValidator(null, 255),
						];
					},
					'title' => Loc::getMessage('ORDERS_ENTITY_PHONE_FIELD'),
				]
			),
			new DatetimeField(
				'CREATED',
				[
					'default' => function()
					{
						return new DateTime();
					},
					'title' => Loc::getMessage('ORDERS_ENTITY_CREATED_FIELD'),
				]
			),
			new StringField(
				'PEOPLE',
				[
					'required' => true,
					'validation' => function()
					{
						return[
							new LengthValidator(null, 255),
						];
					},
					'title' => Loc::getMessage('ORDERS_ENTITY_PEOPLE_FIELD'),
				]
			),
			new IntegerField(
				'CHILDS',
				[
					'title' => Loc::getMessage('ORDERS_ENTITY_CHILDS_FIELD'),
				]
			),
			new IntegerField(
				'IF_VV',
				[
					'title' => Loc::getMessage('ORDERS_ENTITY_IF_VV_FIELD'),
				]
			),
			new IntegerField(
				'IF_BESEDKA',
				[
					'title' => Loc::getMessage('ORDERS_ENTITY_IF_BESEDKA_FIELD'),
				]
			),
			new IntegerField(
				'PAY',
				[
					'title' => Loc::getMessage('ORDERS_ENTITY_PAY_FIELD'),
				]
			),
			new IntegerField(
				'SUMM',
				[
					'title' => Loc::getMessage('ORDERS_ENTITY_SUMM_FIELD'),
				]
			),
			new StringField(
				'SITE_ID',
				[
					'validation' => function()
					{
						return[
							new LengthValidator(null, 255),
						];
					},
					'title' => Loc::getMessage('ORDERS_ENTITY_SITE_ID_FIELD'),
				]
			),
		];
	}
} 