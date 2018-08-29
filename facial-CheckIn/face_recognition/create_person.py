########### Python 2.7 #############
import httplib, urllib, base64

headers = {
    # Request headers
    'Content-Type': 'application/json',
    'Ocp-Apim-Subscription-Key': '508740fcac7a42eb8991d7035fa6193d',
}

params = urllib.urlencode({
})

personGroupId = 'tamuhack-2018-face-recognition-3'


body = "{ 'name':'Mihir Desai', 'userData':'Mihir' }"

try:
    conn = httplib.HTTPSConnection('westcentralus.api.cognitive.microsoft.com')
    conn.request("POST", "/face/v1.0/persongroups/" + personGroupId + "/persons?%s" % params, body, headers)
    response = conn.getresponse()
    data = response.read()
    print(data)
    conn.close()
except Exception as e:
    print("[Errno {0}] {1}".format(e.errno, e.strerror))























headers = {
    # Request headers.
    'Content-Type': 'application/json',

    # NOTE: Replace the "Ocp-Apim-Subscription-Key" value with a valid subscription key.
    'Ocp-Apim-Subscription-Key': KEY,
}


params = urllib.urlencode({
    # Request parameters
    #'targetFace': targetFace
})

body = "{ 'url': '" + img_url + "' }"

persistedFaceId = ""

try:
    conn = httplib.HTTPSConnection('westcentralus.api.cognitive.microsoft.com')
    tempString = "/face/v1.0/persongroups/" + personGroupId + "/persons/" + personId + "/persistedFaces?%s"
    conn.request("POST", tempString % params, body, headers)
    response = conn.getresponse()
    data = response.read()
    temp = json.loads(data)
    persistedFaceId = temp['persistedFaceId']
    print(data)
    conn.close()
except Exception as e:
    print(str(e))
