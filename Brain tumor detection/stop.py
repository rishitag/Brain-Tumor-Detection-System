import boto3

client = boto3.client('rekognition')

modelarn = 'arn:aws:rekognition:us-east-1:863330864015:project/braintumor/version/braintumor.2021-02-17T13.38.35/1613549313959'

response = client.stop_project_version( ProjectVersionArn=modelarn)
print(response)
