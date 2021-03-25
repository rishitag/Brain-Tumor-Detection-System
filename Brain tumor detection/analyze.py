#! C:/Users/Rishita/AppData/Local/Programs/Python/Python37/python.exe
import boto3
import sys;
item=sys.argv[1]
client = boto3.client('rekognition')


modelarn = 'arn:aws:rekognition:us-east-1:863330864015:project/braintumor/version/braintumor.2021-02-17T13.38.35/1613549313959'

response = client.detect_custom_labels( ProjectVersionArn=modelarn, Image={'S3Object': {'Bucket': 'testbrainaws','Name': item} })

for data in response['CustomLabels']:
    
    print(data['Name'])
   
    #print(data['Confidence']) 