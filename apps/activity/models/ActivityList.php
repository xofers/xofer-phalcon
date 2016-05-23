<?php
namespace App\Activity\Models;

use Phalcon\Mvc\Model;

class ActivityList extends Model
{
    use Base;

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $thumb;

    /**
     *
     * @var string
     */
    public $startTime;

    /**
     *
     * @var string
     */
    public $endTime;

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
     *
     * @var integer
     */
    public $delFlag;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'activity_list';
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        //设置数据库连接
        $this->setWriteConnectionService('dbWrite');
        $this->setReadConnectionService('dbRead');

        //模型配置
        self::setup(['notNullValidations' => false]);

        //添加软删除
        $this->addBehavior(new Model\Behavior\SoftDelete(['field' => 'delFlag', 'value' => '99']));

    }

}
