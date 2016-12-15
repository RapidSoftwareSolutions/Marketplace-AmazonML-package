<?php

$app->post('/api/AmazonML/createDataSourceFromRDS', function ($request, $response, $args) {
    
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey','apiSecret','region','dataSourceId','passwordRDS','usernameRDS','dbName','instanceId','resourceRole','S3StagingLocation','securityGroupIds','sqlQuery','serviceRole','subnetId','roleARN']);
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
    
    $body['DataSourceId'] = $post_data['args']['dataSourceId'];
    $body['RoleARN'] = $post_data['args']['roleARN'];
    $body['RDSData']['DatabaseCredentials']['Password'] = $post_data['args']['passwordRDS'];
    $body['RDSData']['DatabaseCredentials']['Username'] = $post_data['args']['usernameRDS'];
    $body['RDSData']['DatabaseInformation']['DatabaseName'] = $post_data['args']['dbName'];
    $body['RDSData']['DatabaseInformation']['InstanceIdentifier'] = $post_data['args']['instanceId'];
    $body['RDSData']['ResourceRole'] = $post_data['args']['resourceRole'];
    $body['RDSData']['S3StagingLocation'] = $post_data['args']['S3StagingLocation'];
    $body['RDSData']['SecurityGroupIds'] = $post_data['args']['securityGroupIds'];
    $body['RDSData']['SelectSqlQuery'] = $post_data['args']['sqlQuery'];
    $body['RDSData']['ServiceRole'] = $post_data['args']['serviceRole'];
    $body['RDSData']['SubnetId'] = $post_data['args']['subnetId'];
    if(!empty($post_data['args']['computeStatistics'])) {
        $body['ComputeStatistics'] = $post_data['args']['computeStatistics'];
    }
    if(!empty($post_data['args']['dataSourceName'])) {
        $body['DataSourceName'] = $post_data['args']['dataSourceName'];
    }
    if(!empty($post_data['args']['dataRearrangement'])) {
        $body['RDSData']['DataRearrangement'] = $post_data['args']['dataRearrangement'];
    }
    if(!empty($post_data['args']['dataSchema'])) {
        $body['RDSData']['DataSchema'] = $post_data['args']['dataSchema'];
    }
    if(!empty($post_data['args']['dataSchemaUri'])) {
        $body['RDSData']['DataSchemaUri'] = $post_data['args']['dataSchemaUri'];
    }
    
    try {
        $res = $client->createDataSourceFromRDS($body)->toArray();
                
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
