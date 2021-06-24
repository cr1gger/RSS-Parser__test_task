<?php
namespace app\commands;

use app\commands\parsers\FeedController;
use app\models\ParserSettings;
use yii\console\Controller;


class DaemonController extends Controller
{

    public function actionRun()
    {
        echo "Daemon has been started! \n";
        while (true){
            $parserSetting = ParserSettings::find()->one();
            $startDate = date_create_from_format('H:i:s', $parserSetting->start_parsing_time);

            if ($startDate->format('H:i') === date('H:i'))
            {
                (new FeedController('feed', \Yii::$app))->actionStart();
                if ($startDate->format('H:i') === date('H:i')) sleep(60);
            }
            sleep(1);
        }
    }
}
