# AmazonML Package
Amazon Machine Learning is a managed service for building ML models and generating predictions, enabling the development of robust, scalable smart applications.
* Domain: amazon.com
* Credentials: apiKey, apiSecret

## How to get credentials: 
0. Go to [Amazon Console](https://console.aws.amazon.com/console/home?region=us-east-1)
1. Log in or create new account
2. Create new group in Groups section at the left side with necessary polices
3. Create new user and assign to existing group
4. After creating user you will see credentials
 
## AmazonML.addTags
Adds one or more tags to an object, up to a limit of 10. Each tag consists of a key and an optional value. If you add a tag using a key that is already associated with the ML object, AddTags updates the tag's value.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| API key obtained from Amazon.
| apiSecret   | credentials| API secret obtained from Amazon.
| region      | String     | Region.
| resourceId  | String     | The ID of the ML object to tag. For example, exampleModelId.
| resourceType| String     | The type of the ML object to tag. Valid Values: BatchPrediction; DataSource; Evaluation; MLModel
| tags        | JSON       | Array of objects. The key-value pairs to use to create tags. If you specify a key without specifying a value, Amazon ML creates a tag with the specified key and a value of null. See README for more details.

#### tags format
```json
[
    {
        "Key": "Tag1", 
        "Value": "new"
    }
]
```

## AmazonML.createBatchPrediction
Generates predictions for a group of observations.

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| API key obtained from Amazon.
| apiSecret     | credentials| API secret obtained from Amazon.
| region        | String     | Region.
| dataSourceId  | String     | The ID of the DataSource that points to the group of observations to predict.
| predictionId  | String     | A user-supplied ID that uniquely identifies the BatchPrediction.
| modelId       | String     | The ID of the MLModel that will generate predictions for the group of observations.
| outputUri     | String     | The location of an Amazon Simple Storage Service (Amazon S3) bucket or directory to store the batch prediction results.
| predictionName| String     | A user-supplied name or description of the BatchPrediction. BatchPredictionName can only use the UTF-8 character set.

## AmazonML.createDataSourceFromRDS
(BETA) Creates a DataSource object from an Amazon Relational Database Service (Amazon RDS).

| Field            | Type       | Description
|------------------|------------|----------
| apiKey           | credentials| API key obtained from Amazon.
| apiSecret        | credentials| API secret obtained from Amazon.
| region           | String     | Region.
| dataSourceId     | String     | A user-supplied ID that uniquely identifies the DataSource. Typically, an Amazon Resource Number (ARN) becomes the ID for a DataSource.
| computeStatistics| String     | The compute statistics for a DataSource. The statistics are generated from the observation data referenced by a DataSource. Treu or false.
| roleARN          | String     | The role that Amazon ML assumes on behalf of the user to create and activate a data pipeline in the user's account and copy data using the SelectSqlQuery query from Amazon RDS to Amazon S3.
| passwordRDS      | String     | The password of RDS.
| usernameRDS      | String     | The username of RDS.
| dbName           | String     | The name of the Amazon RDS database.
| instanceId       | String     | A unique identifier for the Amazon RDS database instance.
| resourceRole     | String     | A role (DataPipelineDefaultResourceRole) assumed by an EC2 instance to carry out the copy task from Amazon RDS to Amazon Simple Storage Service (Amazon S3).
| S3StagingLocation| String     | The Amazon S3 location for staging Amazon RDS data. The data retrieved from Amazon RDS using SelectSqlQuery is stored in this location.
| securityGroupIds | JSON       | Array of strings.  The security information to use to access an RDS DB instance. You need to set up appropriate ingress rules for the security entity IDs provided to allow access to the Amazon RDS instance.
| sqlQuery         | String     | A query that is used to retrieve the observation data for the Datasource.
| serviceRole      | String     | A role (DataPipelineDefaultRole) assumed by the AWS Data Pipeline service to monitor the progress of the copy task from Amazon RDS to Amazon S3.
| subnetId         | String     | The subnet ID to be used to access a VPC-based RDS DB instance. This attribute is used by Data Pipeline to carry out the copy task from Amazon RDS to Amazon S3.
| dataSourceName   | String     | A user-supplied name or description of the DataSource.
| dataRearrangement| String     | A JSON string that represents the splitting and rearrangement requirements for the Datasource. Sample - "{"splitting":{"percentBegin":10,"percentEnd":60}}"
| dataSchema       | String     | A JSON string representing the schema. This is not required if DataSchemaUri is specified.
| dataSchemaUri    | String     | The Amazon S3 location of the DataSchema.

#### securityGroupIds format
```json
["sg-XXXXXX", "sg-XXXXXX"]
```

## AmazonML.createDataSourceFromRedshift
(BETA) Creates a DataSource from a database hosted on an Amazon Redshift cluster.

| Field            | Type       | Description
|------------------|------------|----------
| apiKey           | credentials| API key obtained from Amazon.
| apiSecret        | credentials| API secret obtained from Amazon.
| region           | String     | Region.
| dataSourceId     | String     | A user-supplied ID that uniquely identifies the DataSource. Typically, an Amazon Resource Number (ARN) becomes the ID for a DataSource.
| computeStatistics| String     | The compute statistics for a DataSource. The statistics are generated from the observation data referenced by a DataSource. Treu or false.
| roleARN          | String     | The role that Amazon ML assumes on behalf of the user to create and activate a data pipeline in the user's account and copy data using the SelectSqlQuery query from Amazon RDS to Amazon S3.
| password         | String     | The password of Redshift cluster.
| username         | String     | The username of Redshift cluster.
| dbName           | String     | The name of the Amazon Redshift database.
| clusterId        | String     | The unique ID for the Amazon Redshift cluster.
| S3StagingLocation| String     | The Amazon S3 location for staging Amazon RDS data. The data retrieved from Amazon RDS using SelectSqlQuery is stored in this location.
| sqlQuery         | String     | A query that is used to retrieve the observation data for the Datasource.
| dataSourceName   | String     | A user-supplied name or description of the DataSource.
| dataRearrangement| String     | A JSON string that represents the splitting and rearrangement requirements for the Datasource. Sample - "{"splitting":{"percentBegin":10,"percentEnd":60}}"
| dataSchema       | String     | A JSON string representing the schema. This is not required if DataSchemaUri is specified.
| dataSchemaUri    | String     | The Amazon S3 location of the DataSchema.


## AmazonML.createDataSourceFromS3
Creates a DataSource from a database hosted on an Amazon Redshift cluster.

| Field             | Type       | Description
|-------------------|------------|----------
| apiKey            | credentials| API key obtained from Amazon.
| apiSecret         | credentials| API secret obtained from Amazon.
| region            | String     | Region.
| dataSourceId      | String     | A user-supplied ID that uniquely identifies the DataSource. Typically, an Amazon Resource Number (ARN) becomes the ID for a DataSource.
| dataLocation      | String     | The Amazon S3 location of the observation data.
| computeStatistics | String     | The compute statistics for a DataSource. The statistics are generated from the observation data referenced by a DataSource. Treu or false.
| dataSourceName    | String     | A user-supplied name or description of the DataSource.
| dataRearrangement | String     | A JSON string that represents the splitting and rearrangement requirements for the Datasource. Sample - "{"splitting":{"percentBegin":10,"percentEnd":60}}"
| dataSchema        | String     | A JSON string representing the schema. This is not required if DataSchemaUri is specified.
| dataSchemaLocation| String     | The Amazon S3 location of the DataSchema.

## AmazonML.createEvaluation
Creates a new Evaluation of an MLModel. An MLModel is evaluated on a set of observations associated to a DataSource.

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| API key obtained from Amazon.
| apiSecret     | credentials| API secret obtained from Amazon.
| region        | String     | Region.
| dataSourceId  | String     | The ID of the DataSource for the evaluation. The schema of the DataSource must match the schema used to create the MLModel.
| evaluationId  | String     | A user-supplied ID that uniquely identifies the Evaluation.
| modelId       | String     | The ID of the MLModel to evaluate.
| evaluationName| String     | A user-supplied name or description of the Evaluation.

## AmazonML.createMLModel
Creates a new Evaluation of an MLModel. An MLModel is evaluated on a set of observations associated to a DataSource.

| Field               | Type       | Description
|---------------------|------------|----------
| apiKey              | credentials| API key obtained from Amazon.
| apiSecret           | credentials| API secret obtained from Amazon.
| region              | String     | Region.
| modelId             | String     | A user-supplied ID that uniquely identifies the MLModel.
| modelType           | String     | The category of supervised learning that this MLModel will address. Choose from the following types: Choose REGRESSION if the MLModel will be used to predict a numeric value. Choose BINARY if the MLModel result has two possible values. Choose MULTICLASS if the MLModel result has a limited number of values.
| trainingDataSourceId| String     | The ID of DataSource that points to the training data.
| modelName           | String     | A user-supplied name or description of the MLModel.
| parameters          | JSON       | A list of the training parameters in the MLModel. The list is implemented as a map of key-value pairs. See README for more details.
| recipe              | String     | The data recipe for creating the MLModel. You must specify either the recipe or its URI. If you don't specify a recipe or its URI, Amazon ML creates a default.
| recipeUri           | String     | The Amazon Simple Storage Service (Amazon S3) location and file name that contains the MLModel recipe. You must specify either the recipe or its URI. If you don't specify a recipe or its URI, Amazon ML creates a default.

#### parameters format
```json
[
    {
	"Key": "sgd.maxMLModelSizeInBytes",
        "Value": "33554432"
    },
    {
	"Key": "sgd.shuffleType",
        "Value": "none"
    }
]
```

## AmazonML.createRealtimeEndpoint
Creates a real-time endpoint for the MLModel.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| API key obtained from Amazon.
| apiSecret| credentials| API secret obtained from Amazon.
| region   | String     | Region.
| modelId  | String     | The ID assigned to the MLModel during creation.

## AmazonML.describePredictions
Returns a list of BatchPrediction operations that match the search criteria in the request.

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| API key obtained from Amazon.
| apiSecret     | credentials| API secret obtained from Amazon.
| region        | String     | Region.
| equal         | String     | The equal to operator.
| filterVariable| String     | Use one of the following variables to filter a list: CreatedAt - Sets the search criteria to the BatchPrediction creation date. Status - Sets the search criteria to the BatchPrediction status. Name - Sets the search criteria to the contents of the BatchPrediction Name. IAMUser - Sets the search criteria to the user account that invoked the BatchPrediction creation. MLModelId - Sets the search criteria to the MLModel used in the BatchPrediction. DataSourceId - Sets the search criteria to the DataSource used in the BatchPrediction. DataURI - Sets the search criteria to the data file(s) used in the BatchPrediction. The URL can identify either a file or an Amazon Simple Storage Solution (Amazon S3) bucket or directory.
| greaterOrEqual| String     | The greater than or equal to operator.
| greaterThan   | String     | The greater than operator.
| lessOrEqual   | String     | The less than or equal to operator.
| limit         | String     | The number of pages of information to include in the result. The range of acceptable values is 1 through 100. The default value is 100.
| lessThen      | String     | The less than operator.
| notEqual      | String     | The not equal to operator.
| nextToken     | String     | An ID of the page in the paginated results.
| prefix        | String     | A string that is found at the beginning of a variable, such as Name or Id.
| sortOrder     | String     | A two-value parameter that determines the sequence of the resulting list of MLModels. Valid Values: asc; dsc

## AmazonML.describeDataSources
Returns a list of DataSource that match the search criteria in the request.

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| API key obtained from Amazon.
| apiSecret     | credentials| API secret obtained from Amazon.
| region        | String     | Region.
| equal         | String     | The equal to operator.
| filterVariable| String     | Use one of the following variables to filter a list. Valid Values: CreatedAt; LastUpdatedAt; Status; Name; DataLocationS3; IAMUser
| greaterOrEqual| String     | The greater than or equal to operator.
| greaterThan   | String     | The greater than operator.
| lessOrEqual   | String     | The less than or equal to operator.
| limit         | String     | The number of pages of information to include in the result. The range of acceptable values is 1 through 100. The default value is 100.
| lessThen      | String     | The less than operator.
| notEqual      | String     | The not equal to operator.
| nextToken     | String     | An ID of the page in the paginated results.
| prefix        | String     | A string that is found at the beginning of a variable, such as Name or Id.
| sortOrder     | String     | A two-value parameter that determines the sequence of the resulting list of MLModels. Valid Values: asc; dsc

## AmazonML.describeEvaluations
Returns a list of DescribeEvaluations that match the search criteria in the request.

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| API key obtained from Amazon.
| apiSecret     | credentials| API secret obtained from Amazon.
| region        | String     | Region.
| equal         | String     | The equal to operator.
| filterVariable| String     | Use one of the following variables to filter a list. Valid Values: CreatedAt; LastUpdatedAt; Status; Name; IAMUser; MLModelId; DataSourceId; DataURI
| greaterOrEqual| String     | The greater than or equal to operator.
| greaterThan   | String     | The greater than operator.
| lessOrEqual   | String     | The less than or equal to operator.
| limit         | String     | The number of pages of information to include in the result. The range of acceptable values is 1 through 100. The default value is 100.
| lessThen      | String     | The less than operator.
| notEqual      | String     | The not equal to operator.
| nextToken     | String     | An ID of the page in the paginated results.
| prefix        | String     | A string that is found at the beginning of a variable, such as Name or Id.
| sortOrder     | String     | A two-value parameter that determines the sequence of the resulting list of MLModels. Valid Values: asc; dsc

## AmazonML.describeModels
Returns a list of MLModel that match the search criteria in the request.

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| API key obtained from Amazon.
| apiSecret     | credentials| API secret obtained from Amazon.
| region        | String     | Region.
| equal         | String     | The equal to operator.
| filterVariable| String     | Use one of the following variables to filter a list. Valid Values: CreatedAt; LastUpdatedAt; Status; Name; IAMUser; TrainingDataSourceId; RealtimeEndpointStatus; MLModelType; Algorithm; TrainingDataURI
| greaterOrEqual| String     | The greater than or equal to operator.
| greaterThan   | String     | The greater than operator.
| lessOrEqual   | String     | The less than or equal to operator.
| limit         | String     | The number of pages of information to include in the result. The range of acceptable values is 1 through 100. The default value is 100.
| lessThen      | String     | The less than operator.
| notEqual      | String     | The not equal to operator.
| nextToken     | String     | An ID of the page in the paginated results.
| prefix        | String     | A string that is found at the beginning of a variable, such as Name or Id.
| sortOrder     | String     | A two-value parameter that determines the sequence of the resulting list of MLModels. Valid Values: asc; dsc

## AmazonML.describeTags
Describes one or more of the tags for your Amazon ML object.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| API key obtained from Amazon.
| apiSecret   | credentials| API secret obtained from Amazon.
| region      | String     | Region.
| resourceId  | String     | The ID of the ML object. For example, exampleModelId.
| resourceType| String     | The type of the ML object. Valid Values: BatchPrediction; DataSource; Evaluation; MLModel

## AmazonML.getPrediction
Returns a BatchPrediction that includes detailed metadata, status, and data file information for a Batch Prediction request.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| API key obtained from Amazon.
| apiSecret   | credentials| API secret obtained from Amazon.
| region      | String     | Region.
| predictionId| String     | An ID assigned to the BatchPrediction at creation.

## AmazonML.getDataSource
Returns a DataSource that includes metadata and data file information, as well as the current status of the DataSource.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| API key obtained from Amazon.
| apiSecret   | credentials| API secret obtained from Amazon.
| region      | String     | Region.
| dataSourceId| String     | The ID assigned to the DataSource at creation.
| verbose     | String     | Specifies whether the GetDataSource operation should return DataSourceSchema. True or false.

## AmazonML.getEvaluation
Returns an Evaluation that includes metadata as well as the current status of the Evaluation.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| API key obtained from Amazon.
| apiSecret   | credentials| API secret obtained from Amazon.
| region      | String     | Region.
| evaluationId| String     | The ID of the Evaluation to retrieve.

## AmazonML.getModel
Returns an MLModel that includes detailed metadata, data source information, and the current status of the MLModel.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| API key obtained from Amazon.
| apiSecret| credentials| API secret obtained from Amazon.
| region   | String     | Region.
| modelId  | String     | The ID assigned to the MLModel at creation.
| verbose  | String     | Specifies whether the GetMLModel operation should return Recipe. True or false.

## AmazonML.predict
Generates a prediction for the observation using the specified ML Model.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| API key obtained from Amazon.
| apiSecret| credentials| API secret obtained from Amazon.
| region   | String     | Region.
| modelId  | String     | The ID assigned to the MLModel at creation.
| endpoint | String     | Endpoint for predict. Pattern: https://[a-zA-Z0-9-.]*\.amazon(aws)?\.com[/]?
| record   | JSON       | A map of variable name-value pairs that represent an observation. See README for more details.

#### record format
```json
{
    "ExampleData" : "exampleValue"
}
```
## AmazonML.updatePrediction
Updates the BatchPredictionName of a BatchPrediction.

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| API key obtained from Amazon.
| apiSecret     | credentials| API secret obtained from Amazon.
| region        | String     | Region.
| predictionId  | String     | The ID assigned to the BatchPrediction during creation.
| predictionName| String     | A new user-supplied name or description of the BatchPrediction.

## AmazonML.updateDataSource
Updates the DataSourceName of a DataSource.

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| API key obtained from Amazon.
| apiSecret     | credentials| API secret obtained from Amazon.
| region        | String     | Region.
| dataSourceId  | String     | The ID assigned to the DataSource during creation.
| dataSourceName| String     | A new user-supplied name or description of the DataSource that will replace the current description.

## AmazonML.updateEvaluation
Updates the EvaluationName of an Evaluation.

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| API key obtained from Amazon.
| apiSecret     | credentials| API secret obtained from Amazon.
| region        | String     | Region.
| evaluationId  | String     | The ID assigned to the Evaluation during creation.
| evaluationName| String     | A new user-supplied name or description of the Evaluation that will replace the current content.

## AmazonML.updateModel
Updates the MLModelName and the ScoreThreshold of an MLModel.

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| API key obtained from Amazon.
| apiSecret     | credentials| API secret obtained from Amazon.
| region        | String     | Region.
| modelId       | String     | The ID assigned to the MLModel during creation.
| modelName     | String     | A user-supplied name or description of the MLModel.
| scoreThreshold| String     | The ScoreThreshold used in binary classification MLModel that marks the boundary between a positive prediction and a negative prediction.

## AmazonML.deleteTags
Deletes the specified tags associated with an ML object. After this operation is complete, you can't recover deleted tags. If you specify a tag that doesn't exist, Amazon ML ignores it.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| API key obtained from Amazon.
| apiSecret   | credentials| API secret obtained from Amazon.
| region      | String     | Region.
| resourceId  | String     | The ID of the tagged ML object. For example, exampleModelId.
| resourceType| String     | The type of the tagged ML object. Valid Values: BatchPrediction; DataSource; Evaluation; MLModel
| tagKeys     | JSON       | Array of strings. One or more tags to delete. Example: ["tag1","tag2",...]

#### tagKeys format
```json
["Tag1"]
```
## AmazonML.deleteRealtimeEndpoint
Deletes a real time endpoint of an MLModel.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| API key obtained from Amazon.
| apiSecret| credentials| API secret obtained from Amazon.
| region   | String     | Region.
| modelId  | String     | The ID assigned to the MLModel during creation.

## AmazonML.deleteEvaluation
Assigns the DELETED status to an Evaluation, rendering it unusable.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| API key obtained from Amazon.
| apiSecret   | credentials| API secret obtained from Amazon.
| region      | String     | Region.
| evaluationId| String     | A user-supplied ID that uniquely identifies the Evaluation to delete.

## AmazonML.deletePrediction
Assigns the DELETED status to a BatchPrediction, rendering it unusable.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| API key obtained from Amazon.
| apiSecret   | credentials| API secret obtained from Amazon.
| region      | String     | Region.
| predictionId| String     | A user-supplied ID that uniquely identifies the BatchPrediction.

## AmazonML.deleteDataSource
Assigns the DELETED status to a DataSource, rendering it unusable.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| API key obtained from Amazon.
| apiSecret   | credentials| API secret obtained from Amazon.
| region      | String     | Region.
| dataSourceId| String     | A user-supplied ID that uniquely identifies the DataSource.

## AmazonML.deleteModel
Assigns the DELETED status to an MLModel, rendering it unusable.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| API key obtained from Amazon.
| apiSecret| credentials| API secret obtained from Amazon.
| region   | String     | Region.
| modelId  | String     | A user-supplied ID that uniquely identifies the MLModel.

