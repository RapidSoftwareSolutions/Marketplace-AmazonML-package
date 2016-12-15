<?php
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
    'deleteModel',
    'metadata'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

