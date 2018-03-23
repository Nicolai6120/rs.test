<?php
namespace frontend\controllers;

use Yii;
use yii\base\ErrorException;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Json;
use yii\httpclient\Client;
use yii\web\ServerErrorHttpException;

class SiteController extends Controller
{
    const API_URL = 'http://phisix-api3.appspot.com/stocks.json';

    public function actionIndex()
    {
        try {
            $apiData = Json::decode($this->getApiData());
        } catch(\Exception $e) {
            return $this->render('index', [
                'errorMessage' => $e->getMessage()
            ]);
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $apiData['stock'],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    protected function getApiData()
    {
        $client = new Client(['transport' => 'yii\httpclient\CurlTransport']);
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl(self::API_URL)
            ->send();

        if (!$response->isOk) {
            throw new ErrorException('Unable to load API data, please try again later.');
        }

        return $response->content;
    }
}
