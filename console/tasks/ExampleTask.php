<?php
/**
 *
 * @description :PhpStorm
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/4/11 0011 1:06
 *
 */

use Danzabar\CLI\Tasks\Task;

class ExampleTask extends Task
{
    protected $name = 'example';

    protected $description = '这是测试BasicTask的描述';

    /**
     *
     * @Action 该行必须写入命令的注释中
     */
    public function main()
    {
        $this->output->hr(90,"*");
        $this->output->writeln("这是默认命令-换行");
        $this->output->write("这是默认命令-不换行");
    }

    /**
     * 选择命令
     *
     * @Action 该行必须写入命令的注释中
     */
    public function question()
    {
        $question = $this->helpers->load('question');
        $this->output->hr(90,"*");
        $choose = ["苹果","梨子","香蕉","火车"];
        $this->output->hr(90,"*");
        $answer = $question->ask("你想来玩猜水果游戏吗?");
        $this->output->hr(90,"*");
        $this->output->writeln($answer);
        $this->output->hr(90,"*");
        $answer = $question->multipleChoice("下面的几项哪一个不是水果？", $choose);
        $this->output->hr(90,"*");
        $this->output->writeln($answer);
        $this->output->hr(90,"*");
        $answer = $question->multipleChoice('下面的哪几项是水果？', $choose);
        $this->output->hr(90,"*");
        array_map(function($val){
            $this->output->writeln($val);
        },$answer);
        $this->output->hr(90,"*");
    }

    /**
     * 询问确认
     *
     * @Action 该行必须写入命令的注释中
     */
    public function confirm()
    {
        $confirmation = $this->helpers->load('confirm');
        $this->output->hr(90,"*");
        if($s = $confirmation->confirm("你想继续吗?(y/n)"))
        {
            return $this->output->writeln("你选择了继续！");
        }
        return $this->output->writeln("你选择了放弃！");
    }

    /**
     * 画一个表格
     *
     * @Action 该行必须写入命令的注释中
     */
    public function table()
    {
        $table = $this->helpers->load('table');
        $this->output->hr(90,"*");
        $data = Array(
            0 => Array('Header' => 'value', 'Header2' => 'value2'),
            1 => Array('Header' => 'test', 'Header2' => 'value3')
        );

        $table->draw($data);
    }

    /**
     * 画一个表格
     *
     * @Action 该行必须写入命令的注释中
     */
    public function formate()
    {
        $background = ['black', 'red', 'green', 'yellow', 'blue', 'magenta', 'cyan', 'light_gray'];
        $foreground = ['black', 'red', 'green', 'yellow', 'blue', 'magenta', 'cyan', 'light_gray','dark_gray','light_blue','light_green','light_cyan','light_red','purple','light_purple','brown','white'];
        Danzabar\CLI\Format\Format::addFormat('name', Array('background'=>$background[array_rand($background)],'foreground' => $foreground[array_rand($foreground)]));
        $this->output->writeln('<Name>This text will take the format</Name>');
    }
}