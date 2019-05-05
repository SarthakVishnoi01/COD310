#generating the hash of the certificate

import sys
import os
from py_essentials import hashing as hs

args = sys.argv

#Index PDF
fileName = args[1]
hash = hs.fileChecksum(fileName, "sha256")

print(hash)
