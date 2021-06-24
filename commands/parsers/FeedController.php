<?php
namespace app\commands\parsers;

use app\models\Feed;
use app\models\ParserLogs;
use yii\console\Controller;
use yii\httpclient\Client;


class FeedController extends Controller
{
    const
        REQUEST_URL = 'http://static.feed.rbc.ru/rbc/logical/footer/news.rss',
        REQUEST_METHOD = 'GET';

    public function actionStart()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setUrl(self::REQUEST_URL)
            ->setMethod(self::REQUEST_METHOD)
            ->setFormat(Client::FORMAT_XML)
            ->setHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36'
            ])
            ->send();

        # Save request log
        $requestLog = new ParserLogs();
        $requestLog->request_method = self::REQUEST_METHOD;
        $requestLog->request_url = self::REQUEST_URL;
        $requestLog->response_code = $response->statusCode;
        $requestLog->response_body = $response->content;
        $requestLog->save();

        if ($response->isOk && isset($response->data['channel']['item']))
        {
            foreach($response->data['channel']['item'] as $post) $this->saveFeed($post);
        }
    }

    private function saveFeed(Array $post)
    {
        $dbPost = Feed::findOne(['feed_guid' => $post['guid']]);
        if (!$dbPost)
        {
            $dbPost = new Feed();
            $dbPost->feed_guid = $post['guid'];
            $dbPost->title = $post['title'];
            $dbPost->link = $post['link'];
            $dbPost->short_description = $post['description'];
            $dbPost->date_published = $post['pubDate'];
            $dbPost->author = $post['author'] ?? NULL;
            $dbPost->image_url = $this->getImageUrl($post['enclosure'] ?? []);
            $dbPost->save();
        }
    }

    private function getImageUrl(Array $attach)
    {
        if (empty($attach)) return NULL;
        if (isset($attach[0]))
        {
            $result = array_filter($attach, function($item){
                return ($item['@attributes']['type'] == 'image/jpeg');
            });

            return $result['@attributes']['url'] ?? NULL;
        } else {
            if($attach['@attributes']['type'] == 'image/jpeg')
            {
                return $attach['@attributes']['url'] ?? NULL;
            }
            return null;
        }
    }
}
