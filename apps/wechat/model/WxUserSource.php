<?php

class WxUserSource extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $openId;

    /**
     *
     * @var string
     */
    public $source;

    /**
     *
     * @var string
     */
    public $status;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $phone;

    /**
     *
     * @var string
     */
    public $address;

    /**
     *
     * @var string
     */
    public $remark;

    /**
     *
     * @var integer
     */
    public $delFlag;

    /**
     *
     * @var string
     */
    public $createTime;

    /**
     *
     * @var string
     */
    public $modifyTime;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setWriteConnectionService('dbWrite');
        $this->setReadConnectionService('dbRead');

        self::setup(array('notNullValidations' => false));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'wechat_user_source';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return WxUserSource[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return WxUserSource
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
}
