<?php

$app->post('/api/AmazonML/createMLModel', function ($request, $response, $args) {
    
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey','apiSecret','region','modelId','modelType','trainingDataSourceId']);
    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $credentials = new Aws\Credentials\Credentials($post_data['args']['apiKey'], $post_data['args']['apiSecret']);

    $client = new Aws\MachineLearning\MachineLearningClient([
        'version'     => 'latest',
        'region'      => $post_data['args']['region'],
        'credentials' => $credentials
    ]);
    
    $body['MLModelId'] = $post_data['args']['modelId'];
    $body['MLModelType'] = $post_data['args']['modelType'];
    $body['TrainingDataSourceId'] = $post_data['args']['trainingDataSourceId'];

    if(!empty($post_data['args']['modelName'])) {
        $body['MLModelName'] = $post_data['args']['modelName'];
    }
    if(!empty($post_data['args']['parameters'])) {
        $body['Parameters'] = $post_data['args']['parameters'];
    }
    if(!empty($post_data['args']['recipe'])) {
        $body['Recipe'] = $post_data['args']['recipe'];
    }
    if(!empty($post_data['args']['recipeUri'])) {
        $body['RecipeUri'] = $post_data['args']['recipeUri'];
    }
    
    try {
        $res = $client->createMLModel($body)->toArray();
                
        $result['callback'] = 'success';
        $result['contextWrites']['to'] = is_array($res) ? $res : json_decode($res);
        if(empty($result['contextWrites']['to'])) {
            $result['contextWrites']['to']['status_msg'] = "Api return no results";
        }
    } catch (S3Exception $e) {
        // Catch an S3 specific exception.
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $e->getMessage();
    } catch (\Exception $e) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $e->getMessage();
    }
    
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    
});
