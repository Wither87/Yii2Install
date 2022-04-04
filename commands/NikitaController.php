<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use DOMDocument;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;
use app\models\Metric;
use DateTime;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class NikitaController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionHotdog($message = 'hello Nikita, I love hotdogs')
    {

        $this->stdout($message . "\n", Console::BOLD);

        return ExitCode::OK;
    }

    public function actionParseWiki($url='https://www.wikipedia.org/'){
        $wikiHtml = file_get_contents($url);

        $this->stdout($wikiHtml . "\n");

        return ExitCode::OK;
    }

    public function actionDom($url='https://en.wikipedia.org/wiki/Main_Page'){
        $wikiHtml = file_get_contents($url);
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($wikiHtml);

        $parse = $doc->getElementById('mp-tfa');
        $text = $parse->textContent;
        $article = $doc->saveHTML($parse);
        
        $line = "\n--------------------------------------------------------------------------------------------";
        
        $this->stdout($line . "\n");
        $this->stdout($text . "\n", Console::BOLD);
        $this->stdout($line . "\n");
        $this->stdout($article . "\n", Console::FG_GREEN);
        $this->stdout($line . "\n");

        return ExitCode::OK;
    }

    public function actionRegex($url='https://en.wikipedia.org/wiki/Main_Page'){
        $wikiHtml = file_get_contents($url);

        $pattern = "(<div id=\"mp-tfa\">.*?(</div>){3})";
        $pattern2 = "#<div id=\"mp-tfa\">[A-Za-z\-\w\d\s=\.\/:\"\'].*?<h2 id=\"mp-dyk-h2\"#imu";

        $pattent3 = "#<div id=\"mp-tfa\">#imu";
        echo $pattent3;
        $content = preg_match($pattent3, $wikiHtml);
        $this->stdout("\n" . $content . "\n");

        $pattent4 = "#<h2 id=\"mp-dyk-h2\"#imu";
        echo $pattent4;
        $content = preg_match($pattent4, $wikiHtml);
        $this->stdout("\n" . $content . "\n");


        $pattern5 = "#<div id=\"mp-tfa\">.*?<h2 id=\"mp-dyk-h2\"#imu";
        echo $pattern5;
        $content = preg_match($pattern5, $wikiHtml);
        $this->stdout("\n" . $content . "\n");
        return ExitCode::OK;
    }

    public function actionDatabase(){
        $i = 0;
        $total = 10000;
        Console::startProgress($i, $total);
        for (; $i < $total; $i++){
            $model = new Metric();
            $model->value = $i;
            $model->counter_id = $i;
            $model->dateCreate = date_create()->format('Y-m-d');
            $model->save();
            Console::updateProgress($i+1, $total);
        }
    }
}
