<?php

class Roistat
{
    use Fields;

    private $key            = 'ODVhYjIxN2IzZTQyNDFiZTQ0ODkyZDM5ZjkzOTZlOGY6MjI4MzI3';

    private $host           = 'https://cloud.roistat.com/api/proxy/1.0/leads/add?';
    private $title          = "Новая заявка с сайта {domain}";
    private $visit          = null;
    private $name           = null;
    private $phone          = null;
    private $email          = null;
    private $comment        = null;
    private $fields         = array();
    private $isSkipSending  = 0;
    private $isNeedCallback = 0;
    private $form           = null;
    private $log            = false;

    public function execute()
    {
        if(empty($this->getPhone()) && empty($this->getEmail())) return false;
        return $this->roistatCurl($this->getRaw(), true);
    }

    public function getRaw()
    {
        $this->setPerFields();

        $roistatParams = [
            'roistat'   => $this->getVisit(),
            'key'       => $this->getKey(),
            'title'     => $this->getTitle(),
            'name'      => $this->getName(),
            'phone'     => $this->getPhone(),
            'email'     => $this->getEmail(),
            'comment'   => $this->getComment(),
            'fields'    => $this->getFields(),
        ];

        if($this->getIsSkipSending()) {
            $roistatParams['is_skip_sending'] = $this->getIsSkipSending();
        }

        if($this->getIsNeedCallback()) {
            $roistatParams['is_need_callback'] = $this->getIsNeedCallback();
        }

        if($this->isLog()) {
            self::writeToLog($roistatParams, 'roistatParams');
        }

        return $roistatParams;
    }

    /**
     * permanent fields
     */
    private function setPerFields()
    {
        $fields = array(
            'landingPage'   => '{landingPage}',
            'source'        => '{source}',
            'city'          => '{city}',
            'utmSource'     => '{utmSource}',
            'utmMedium'     => '{utmMedium}',
            'utmCampaign'   => '{utmCampaign}',
            'utmTerm'       => '{utmTerm}',
            'utmContent'    => '{utmContent}',
        );
        $this->setFields($this->getFields() + $fields);
    }

    /** -
     * Генерация менеджеров по очереди
     * @param array $manager
     * @return mixed
     */
    public static function getManager($manager = array()) {
        $manager_file = __DIR__ . '/manager.txt';

        $fp = fopen($manager_file, "r");
        $counter = fgets($fp);
        fclose($fp);

        $key = array_search($counter, $manager);

        $new_key = $key + 1;
        if ( $new_key > (count($manager) - 1) ) {
            $new_key = 0;
        }

        $managerId = $manager[$new_key];

        $fh = fopen($manager_file, "w+");
        fwrite($fh, $managerId);
        fclose($fh);
        return $managerId;
    }

    /**
     * Функция логирования
     * @param $data
     * @param string $title
     * @return bool
     */
    public static function writeToLog($data, $title = '', $name = null) {

        $path = __DIR__ . '/logs';

        foreach(glob("{$path}/*.log") as $file) {
            if (is_file($file) && (time() - filemtime($file) > (3600 * 24 * 2))) {
                unlink($file);
            }
        }

        $log = "\n------------------------\n";
        $log .= date("d.m.Y G:i:s") . "\n";
        $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
        $log .= print_r($data, 1);
        $log .= "\n------------------------\n";
        $name = !empty($name) ? $name : date('Y-m-d');
        return file_put_contents( "{$path}/roistat_{$name}.log", $log, FILE_APPEND);
    }

    /**
     * Отправка формы по Curl
     * @param $url
     * @param $roistatData
     * @param $httpBuild
     * @return mixed
     */
    private function roistatCurl($roistatData, $httpBuild = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, null);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, null);

        if ($httpBuild == true) {
            curl_setopt($ch, CURLOPT_URL, $this->host . http_build_query($roistatData));
        } else {
            curl_setopt($ch, CURLOPT_URL, $this->host . $roistatData);
        }

        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * @return bool
     */
    public function isLog()
    {
        return $this->log;
    }

    /**
     * @param bool $log
     */
    public function setLog($log)
    {
        $this->log = $log;
        return $this;
    }


    /**
     * @return null
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param null $form
     */
    public function setForm($form)
    {
        $this->form = $form;
        $this->setTitle("Новый лид с формы: {$form}");
        return $this;
    }

    /**
     * @return null
     */
    public function getVisit()
    {
        if($this->visit) {
            return  $this->visit;
        }

        return array_key_exists('roistat_visit', $_COOKIE) ? $_COOKIE['roistat_visit'] : 'nocookie';
    }

    /**
     * @param null $visit
     */
    public function setVisit($visit)
    {
        $this->visit = $visit;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param mixed $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsSkipSending()
    {
        return $this->isSkipSending;
    }

    /**
     * @param mixed $isSkipSending
     */
    public function setIsSkipSending($isSkipSending)
    {
        $this->isSkipSending = $isSkipSending;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsNeedCallback()
    {
        return $this->isNeedCallback;
    }

    /**
     * @param mixed $isNeedCallback
     */
    public function setIsNeedCallback($isNeedCallback)
    {
        $this->isNeedCallback = $isNeedCallback;
        return $this;
    }
}

trait Fields {

    private $city = '{city}';
    private $source = '{source}';
    private $utmTerm = '{utmTerm}';
    private $utmSource = '{utmSource}';
    private $utmMedium = '{utmMedium}';
    private $utmContent = '{utmContent}';
    private $landingPage = '{landingPage}';
    private $utmCampaign = '{utmCampaign}';

    /**
     * AmoCRM fields
     */
    private $responsible_user_id;
    private $status_id;
    private $pipeline_id;
    private $tags;

    /**
     * RetailCRM
     */
    private $orderMethod;
    private $managerId;

    /**
     * BitrixCRM
     */
    private $ASSIGNED_BY_ID;
    private $STAGE_ID;

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return string
     */
    public function getUtmTerm()
    {
        return $this->utmTerm;
    }

    /**
     * @param string $utmTerm
     */
    public function setUtmTerm($utmTerm)
    {
        $this->utmTerm = $utmTerm;
        return $this;
    }

    /**
     * @return string
     */
    public function getUtmSource()
    {
        return $this->utmSource;
    }

    /**
     * @param string $utmSource
     */
    public function setUtmSource($utmSource)
    {
        $this->utmSource = $utmSource;
        return $this;
    }

    /**
     * @return string
     */
    public function getUtmMedium()
    {
        return $this->utmMedium;
    }

    /**
     * @param string $utmMedium
     */
    public function setUtmMedium($utmMedium)
    {
        $this->utmMedium = $utmMedium;
        return $this;
    }

    /**
     * @return string
     */
    public function getUtmContent()
    {
        return $this->utmContent;
    }

    /**
     * @param string $utmContent
     */
    public function setUtmContent($utmContent)
    {
        $this->utmContent = $utmContent;
        return $this;
    }

    /**
     * @return string
     */
    public function getLandingPage()
    {
        return $this->landingPage;
    }

    /**
     * @param string $landingPage
     */
    public function setLandingPage($landingPage)
    {
        $this->landingPage = $landingPage;
        return $this;
    }

    /**
     * @return string
     */
    public function getUtmCampaign()
    {
        return $this->utmCampaign;
    }

    /**
     * @param string $utmCampaign
     */
    public function setUtmCampaign($utmCampaign)
    {
        $this->utmCampaign = $utmCampaign;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponsibleUserId()
    {
        return $this->responsible_user_id;
    }

    /**
     * @param mixed $responsible_user_id
     */
    public function setResponsibleUserId($responsible_user_id)
    {
        $this->responsible_user_id = $responsible_user_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusId()
    {
        return $this->status_id;
    }

    /**
     * @param mixed $status_id
     */
    public function setStatusId($status_id)
    {
        $this->status_id = $status_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPipelineId()
    {
        return $this->pipeline_id;
    }

    /**
     * @param mixed $pipeline_id
     */
    public function setPipelineId($pipeline_id)
    {
        $this->pipeline_id = $pipeline_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderMethod()
    {
        return $this->orderMethod;
    }

    /**
     * @param mixed $orderMethod
     */
    public function setOrderMethod($orderMethod)
    {
        $this->orderMethod = $orderMethod;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getManagerId()
    {
        return $this->managerId;
    }

    /**
     * @param mixed $managerId
     */
    public function setManagerId($managerId)
    {
        $this->managerId = $managerId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getASSIGNEDBYID()
    {
        return $this->ASSIGNED_BY_ID;
    }

    /**
     * @param mixed $ASSIGNED_BY_ID
     */
    public function setASSIGNEDBYID($ASSIGNED_BY_ID)
    {
        $this->ASSIGNED_BY_ID = $ASSIGNED_BY_ID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSTAGEID()
    {
        return $this->STAGE_ID;
    }

    /**
     * @param mixed $STAGE_ID
     */
    public function setSTAGEID($STAGE_ID)
    {
        $this->STAGE_ID = $STAGE_ID;
        return $this;
    }
}

function dump($str, $name = null)
{
    if(!empty($name)) {
        echo "<h3 style='padding: 0;'>{$name}</h3>";
    }
    echo "<pre>";
    print_r($str);
    echo "</pre>";
}
