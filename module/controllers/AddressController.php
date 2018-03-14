<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;
use app\models\Person;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

/**
 * Adress controller for the `api` 
 */
class AddressController extends ActiveController
{
	public $modelClass = 'app\models\Person';

	public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function actionGetApi(){
    	$query = Person::find();
		$query->innerJoinWith(['adressTbl']);

		$dataProvider = new ActiveDataProvider([
		    'query' => $query,
		]);

		return $dataProvider;
	}

	public function behaviors()
	{
		return ArrayHelper::merge(parent::behaviors(),[
			'authenticator' =>[
	            'class' => CompositeAuth::className(),
	            'authMethods' =>[
	               ['class' => HttpBearerAuth::className()],
	               ['class' => QueryParamAuth::className()],
	            ]
	        ],
			'bootstrap'=>[
				'class' => ContentNegotiator::className(),
				'formats' => 
		        [
					'application/json' => Response::FORMAT_JSON,
				],
			],
			'corsFilter' => [
	            'class' => \yii\filters\Cors::className(),
	            'cors' => [
                    // restrict access to
                    'Origin' =>['*'],// ['http://ptrnov-erp.dev', 'https://ptrnov-erp.dev'],
                    'Access-Control-Request-Method' => ['POST', 'GET', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                    // Allow only POST and PUT methods
                    'Access-Control-Request-Headers' => ['X-Wsse'],
                    // Allow only headers 'X-Wsse'
                    'Access-Control-Allow-Credentials' => true,
                    // Allow OPTIONS caching
                    'Access-Control-Max-Age' => 3600,
                    // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                    'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
                ],
            ],
		]);
	}

}
