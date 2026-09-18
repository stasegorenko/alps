<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 26/04/2019
 * Time: 11:45
 */

class RoistatApi
{
    const HOST = 'https://cloud.roistat.com/api/v1/';

    private static $_instance;
    private $id_project;
    private $key;

    /**
     * RoistatApi constructor.
     * @param $id_project
     * @param $key
     */
    private function __construct($id_project, $key)
    {
        if(empty($key) or empty($id_project)) return;
        $this->key = $key;
        $this->id_project = $id_project;
    }

    /**
     * @param $id_project
     * @param $key
     * @return RoistatApi
     */
    public static function getInstance($id_project, $key)
    {
        if(self::$_instance == null ) {
            self::$_instance = new static($id_project, $key);
        }
        return self::$_instance;
    }

    /**
     * Добавление звонков в Roistat
     *
        {
            "callee": "79999999999", //Набранный номер
            "caller": "78888888888", //Номер клиента
            "date": "2016-07-26T11:03:57+0000",
            "duration": 20,
            "marker": "ym_1_2",
            "order_id": null,
            "save_to_crm": "0",
            "status": "ANSWER",
            "visit_id": "12345",
            "comment": "Перезвонить завтра",
            "answer_duration": 15
        }
     *
     * @param array $params
     * @return array|bool|mixed|object
     */
    public function addCall($params = array())
    {
        if(empty($params)) {
            die('Call params is empty');
        }
        $url = 'project/phone-call';
        return $this->curl(self::HOST . $url, $params, true);
    }

    /**
     * Обновление звонка
    {
        "id": 123,
        "comment": "Тестовый комментарий",
        "status": "CHANUNAVAIL",
        "duration": "55",
        "link": "https://site.ru/calltracking/call/23/file/123456qwerty"
    }
     * @param array $params
     * @return array|bool|mixed|object
     */
    public function updateCall($params = array())
    {
        $url = 'project/calltracking/call/update';
        return $this->curl(self::HOST . $url, $params, true);
    }

    /**
     * Получение звонков по номеру телефона
     * @param $phone
     * @return null
     */
    public function loadCalls($phone)
    {
        $url = 'project/calltracking/call/list';
        $filter = array(
            'filters' => array(
                array(
                    'caller',
                    '=',
                    str_replace('+', '', $phone)
                )
            ),
            'extend' => array('visit'),
            'sort' => array('date', 'desc'),
            'limit' => 50,
            'offset' => 0
        );
        $calls = $this->curl(self::HOST . $url, $filter, true);
        return $this->itemCall($calls);
    }

    /**
     * Форматирование ответа
     *
     * @param $data
     * @return null
     */
    private function itemCall($data)
    {
        if(!empty($data['data'])) {
            return $data['data'];
        }
        return null;
    }

    /**
     * Получение проксилидов за период
     *
     * @param $dateStart
     * @param $dateEnd
     * @return array|bool|mixed|object
     */
    public function getProxyLeads($dateStart, $dateEnd)
    {
        $url = 'project/proxy-leads';
        $newUrl = "{$url}?period={$dateStart}-$dateEnd";
        $response = $this->curl(self::HOST . $newUrl);
        return !empty($response) ? $response['ProxyLeads'] : $response;
    }

    /**
     * Этот метод используется для получения информации о всех визитах.
     *
     * Пример фильтрации
        filters: [[
            "id",
            "=",
            "266545"
        ]]
     * @param $filter
     * @param $limit
     * @param $offset
     * @return array|bool|mixed|object
     */
    public function getVisitList($filter, $limit = 50, $offset = 0)
    {
        $url    = 'project/site/visit/list';
        $filter = array(
            'filters'   => $filter,
            'limit'     => $limit,
            'offset'    => $offset
        );
        $response = $this->curl(self::HOST . $url, $filter, true);
        return !empty($response['data']) ? $response['data'] : $response;
    }

    /**
     * @param $filter
     * @param $limit
     * @param $offset
     * @return array|bool|mixed|object
     *
        {
            "date": "2019-10-09T12:00:00+0300",
            "callee": "7912345678",
            "caller": "7987654321",
            "is_outcoming": 1,
            "file_url": "http://test-domain.com/records/call.mp3",
            "operator": "Василий Петрович",
            "comment": "Это тестовый звонок в речевой аналитике",
            "fields": [
                {
                    "title": "Testovoe Pole 11",
                    "name": "test_field_1",
                    "value": "Звонки в отдел продаж"
                },
                {
                    "title": "Testovoe Pole 12",
                    "name": "test_field_2",
                    "value": "Звонки в отдел маркетиинга"
                },
                {
                    "title": "Testovoe Pole 13",
                    "name": "test_field_3",
                    "value": "Звонки в техподдержку"
                }
            ]
        }
     */
    public function speechCallAdd($filter)
    {
        $url    = 'project/speech/call/add';
        $response = $this->curl(self::HOST . $url, $filter, true);
        return !empty($response['data']) ? $response['data'] : $response;
    }

    /**
     * Отправка запроса на сервер
     * @param $url
     * @param array $data
     * @param bool $method
     * @return array|bool|mixed|object
     */
    public function curl($url, $data = array(), $method = false)
    {
        if (empty($url)) die('Empty url');
        $params =  http_build_query(array(
            'project'   => $this->id_project,
            'key'       => $this->key
        ));

        $ampParam = stripos($url, '?') !== false ? '&' : '?';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "{$url}{$ampParam}{$params}");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if ($method) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        }

        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $out = curl_exec($curl);
        curl_close($curl);

        if (empty($out)) return false;

        return json_decode($out, true);
    }
}



/**
 * Очистить номер телефона
 * @param $phone
 * @return string|string[]|null
 */
function clearPhone($phone, $replace = null)
{
    $phone = preg_replace("/.*<|[^0-9]/", '', $phone);
    if($replace) $phone[0] = 7;
    return $phone;
}