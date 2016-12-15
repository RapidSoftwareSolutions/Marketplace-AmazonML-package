<?php

namespace Test\Functional;

require_once(__DIR__ . '/../../src/Models/checkRequest.php');

class AmazonMLTest extends BaseTestCase {
    
    public function testPackage() {
        
        $routes = [
            'addTags',
            'createBatchPrediction',
            'createDataSourceFromRDS',
            'createDataSourceFromRedshift',
            'createDataSourceFromS3',
            'createEvaluation',
            'createMLModel',
            'createRealtimeEndpoint',
            'describePredictions',
            'describeDataSources',
            'describeEvaluations',
            'describeModels',
            'describeTags',
            'getPrediction',
            'getDataSource',
            'getEvaluation',
            'getModel',
            'predict',
            'updatePrediction',
            'updateDataSource',
            'updateEvaluation',
            'updateModel',
            'deleteTags',
            'deleteRealtimeEndpoint',
            'deleteEvaluation',
            'deletePrediction',
            'deleteDataSource',
            'deleteModel'
        ];
        
        foreach($routes as $file) {
            $var = '{  
                        "args":{  
                            "apiKey": "AKIAJIVNVSZ7PUVJFLQQ",
                            "apiSecret": "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",
                            "region": "eu-west-1"
                        }
                    }';
            $post_data = json_decode($var, true);

            $response = $this->runApp('POST', '/api/AmazonML/'.$file, $post_data);

            $this->assertEquals(200, $response->getStatusCode(), 'Error in '.$file.' method');
        }
    }
    
}
