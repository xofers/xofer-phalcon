<?php
/**
 *
 * @description :PhpStorm
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/4/11 0011 1:06
 *
 */
use Phalcon\Cli\Task;

/**
 * Class LsTask
 * @description('List directory content', 'The content will be displayed in the standard output')
 */
class LsTask extends Task
{
    /**
     * @description('Non recursive list')
     */
    public function mainAction()
    {
        echo 'Content list:'.PHP_EOL;
        // Code to iterate a directory and show the content
    }

    /**
     * @description("Human readable action")
     * @param({'type'='string', 'name'='directory', 'description'='directory to be listed' })
     * @param({'type'='string', 'name'='Size unit', 'description'='Unit size to be shown' })
     */
    public function hrAction(array $params) {
        $directoryToList = $params[0];
        $unitSize = $params[1];
        // Code to iterate a directory and show the content
    }

    /**
     * @DoNotCover
     */
    public function secretAction()
    {
        echo 'Secret list:'.PHP_EOL;
        // ...
    }
}