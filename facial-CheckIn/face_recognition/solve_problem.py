########### Python 2.7 #############
import httplib, urllib, base64

headers = {
    # Request headers
    'Content-Type': 'application/json',
    'Ocp-Apim-Subscription-Key': '508740fcac7a42eb8991d7035fa6193d',
}

params = urllib.urlencode({
    # Request parameters
})

# Replace 'examplegroupid' with an ID you haven't used for creating a group before.
# The valid characters for the ID include numbers, English letters in lower case, '-' and '_'.
# The maximum length of the ID is 64.
personGroupId = 'tamuhack-2018-face-recognition'
personId = '70d07dff-bd34-4bac-a0d5-3021e4472c6b'

body = "{ 'url':'http://ec2-18-218-131-230.us-east-2.compute.amazonaws.com/static/testpic.jpg' }"

try:
    conn = httplib.HTTPSConnection('westcentralus.api.cognitive.microsoft.com')
    conn.request("POST", "/face/v1.0/persongroups/tamuhack-2018-face-recognition/persons/70d07dff-bd34-4bac-a0d5-3021e4472c6b/persistedFaces?%s" % params, body, headers)
    response = conn.getresponse()
    data = response.read()
    print(data)
    conn.close()
except Exception as e:
    print("[Errno {0}] {1}".format(e.errno, e.strerror))
