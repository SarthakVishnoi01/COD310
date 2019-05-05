#Checking if the generated hash is present in the index file uploaded by the user
#Returns the index of the file hash in the blockChain else error message

import PyPDF2
import sys
args = sys.argv

#location of the index file uploaded by the user
indexPDF = args[1]
#Certificate hash which we need to compare
toCompare = args[2]
# toCompare = "b1674191a88ec5cdd733e4240a81803105dc412d6c6708d53ab94fc248f4f553"

pdfFileObj = open(indexPDF, 'rb')
pdfReader = PyPDF2.PdfFileReader(pdfFileObj)

pageObj = pdfReader.getPage(0)
text = pageObj.extractText()

numLines = len(text)/65
numLines = int(numLines)

index = -1
for i in range(numLines):
    newHash = text[65*i:65*i+64]
    # print(newHash)
    if(toCompare == newHash):
        print("The uploaded Certificate is authentic")
        index = i

if(index == -1):
    print("The uploaded Certificate is incorrect")
