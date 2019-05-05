#For checking if the index file uploaded is correct

import sys
from py_essentials import hashing as hs

args = sys.argv
uploadedFile = args[1]
correctIndexFile = "/opt/lampp/htdocs/examples/server/Hash/finalHash.txt"

hashUploadedFile = hs.fileChecksum(uploadedFile, "sha256")
# hashCorrectFile = hs.fileChecksum(correctIndexFile, "sha256")

#Check if the hash is same as the string in the file

File_object = open(correctIndexFile,"r")
finalHash = File_object.read()
File_object.close()

if(hashUploadedFile == finalHash):
    print("The uploaded index File is correct")
else:
    print("The uploaded index File is incorrect")
