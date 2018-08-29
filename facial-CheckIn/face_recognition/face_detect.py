import cognitive_face as CF
import requests
from io import BytesIO
from PIL import Image, ImageDraw
import httplib, urllib, base64
import json

KEY = '508740fcac7a42eb8991d7035fa6193d'  # Replace with a valid subscription key (keeping the quotes in place).
CF.Key.set(KEY)
# If you need to, you can change your base API url with:
#CF.BaseUrl.set('https://westcentralus.api.cognitive.microsoft.com/face/v1.0/')

BASE_URL = 'https://westcentralus.api.cognitive.microsoft.com/face/v1.0/'  # Replace with your regional Base URL
CF.BaseUrl.set(BASE_URL)

img_url = 'http://ec2-18-218-131-230.us-east-2.compute.amazonaws.com/static/testpic8.jpg'
faces = CF.face.detect(img_url)
print(faces)
#Convert width height to a point in a rectangle
def getRectangle(faceDictionary):
    rect = faceDictionary['faceRectangle']
    left = rect['left']
    top = rect['top']
    bottom = left + rect['height']
    right = top + rect['width']
    return ((left, top), (bottom, right))

def getRectangleTarget(faceDictionary):
    rect = faceDictionary['faceRectangle']
    left = rect['left']
    top = rect['top']
    height = rect['height']
    width = rect['width']
    return ("targetFace=" + str(left) + "," + str(top) + "," + str(width) + "," + str(height) )

def getFaceId(faceDictionary):
    id = faceDictionary['faceId']
    return id


# You can use this example JPG or replace the URL below with your own URL to a JPEG image.


# Replace 'examplegroupid' with an ID you haven't used for creating a group before.
# The valid characters for the ID include numbers, English letters in lower case, '-' and '_'.
# The maximum length of the ID is 64.
personGroupId = 'tamuhack-2018-face-recognition-3'
personId = "7225cbb7-4bb6-45a7-a9a0-9f5ef97f4724"



headers = {
    # Request headers
    'Content-Type': 'application/json',
    'Ocp-Apim-Subscription-Key': KEY,
}

params = urllib.urlencode({
})

faceArray = ""
for index, face in enumerate(faces):
    if (index < len(faces) - 1):
        faceArray = faceArray + "'" + getFaceId(face) + "'"
    else:
        faceArray = faceArray + "'" + getFaceId(face) + "', "

print(faceArray)

body = ("{ 'personGroupId' : '" + personGroupId + "', 'faceIds' : [" + faceArray + "],"
    "'maxNumOfCandidatesReturned' : '1', 'confidenceThreshold' : '0.5' }")

try:
    conn = httplib.HTTPSConnection('westcentralus.api.cognitive.microsoft.com')
    conn.request("POST", "/face/v1.0/identify?%s" % params, body, headers)
    response = conn.getresponse()
    data = response.read()
    print(data)
    conn.close()
except Exception as e:
    print(str(e))

def getMatchedFaces(faceDictionary):
    candidates = faceDictionary['candidates']
    for candidate in candidates:
        confidenceLevel = candidate['confidence']
        if float(confidenceLevel) > float(0.5):
            return faceDictionary['faceId']

matchedFaces = json.loads(data)
matchedFacesList = []
for face in matchedFaces:
    matchedFacesList.append(getMatchedFaces(face))

#Download the image from the url
response = requests.get(img_url)
img = Image.open(BytesIO(response.content))

for matchedFace in matchedFacesList:
    for face in faces:
        if getFaceId(face) == matchedFace:

            #For each face returned use the face rectangle and draw a red box.
            draw = ImageDraw.Draw(img)
            draw.rectangle(getRectangle(face), outline='red')

            #Display the image in the users default image browser.
            img.show()

            headers = {
                # Request headers
                'Ocp-Apim-Subscription-Key': KEY,
            }

            params = urllib.urlencode({
            })

            try:
                conn = httplib.HTTPSConnection('westcentralus.api.cognitive.microsoft.com')
                conn.request("GET", "/face/v1.0/persongroups/" + personGroupId + "/persons/" + personId + "?%s" % params, "{body}", headers)
                response = conn.getresponse()
                data = response.read()
                temp = json.loads(data)
                print(temp['name'])
                print(data)
                conn.close()
            except Exception as e:
                print(str(e))
