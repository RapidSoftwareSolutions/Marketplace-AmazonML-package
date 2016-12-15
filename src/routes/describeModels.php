<?php

$app->post('/api/AmazonML/describeModels', function ($request, $response, $args) {
    
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey','apiSecret','region']);
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
    
    if(!empty($post_data['args']['equal'])) {
        $body['EQ'] = $post_data['args']['equal'];
    }
    if(!empty($post_data['args']['filterVariable'])) {
        $body['FilterVariable'] = $post_data['args']['filterVariable'];
    }
    if(!empty($post_data['args']['greaterOrEqual'])) {
        $body['GE'] = $post_data['args']['greaterOrEqual'];
    }
    if(!empty($post_data['args']['greaterThan'])) {
        $body['GT'] = $post_data['args']['greaterThan'];
    }
    if(!empty($post_data['args']['lessOrEqual'])) {
        $body['LE'] = $post_data['args']['lessOrEqual'];
    }
    if(!empty($post_data['args']['limit'])) {
        $body['Limit'] = $post_data['args']['limit'];
    }
    if(!empty($post_data['args']['lessThen'])) {
        $body['LT'] = $post_data['args']['lessThen'];
    }
    if(!empty($post_data['args']['notEqual'])) {
        $body['NE'] = $post_data['args']['notEqual'];
    }
    if(!empty($post_data['args']['nextToken'])) {
        $body['NextToken'] = $post_data['args']['nextToken'];
    }
    if(!empty($post_data['args']['prefix'])) {
        $body['Prefix'] = $post_data['args']['prefix'];
    }
    if(!empty($post_data['args']['sortOrder'])) {
        $body['SortOrder'] = $post_data['args']['sortOrder'];
    }
    
    try {
        $res = $client->describeMLModels($body)->toArray();
                
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
