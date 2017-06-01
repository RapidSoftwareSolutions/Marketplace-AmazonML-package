<?php

$app->post('/api/AmazonML/addTags', function ($request, $response, $args) {
    
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey','apiSecret','region','resourceId','resourceType','tags']);
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
    
    $body['ResourceId'] = $post_data['args']['resourceId'];
    $body['ResourceType'] = $post_data['args']['resourceType'];
    foreach ($post_data['args']['tags'] as $tag) {
        $body['Tags'][] = [
            "Key" => $tag['key'],
            "Value" => $tag['value']
        ];
    }
    
    try {
        $res = $client->addTags($body)->toArray();
                
        $result['callback'] = 'success';
        $result['contextWrites']['to'] = is_array($res) ? $res : json_decode($res);
        if(empty($result['contextWrites']['to'])) {
            $result['contextWrites']['to']['status_msg'] = "Api return no results";
        }
    } catch (\Aws\S3\Exception\S3Exception $e) {
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
