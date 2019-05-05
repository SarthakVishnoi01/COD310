# import os
import sys
args = sys.argv
result = args[1]
# result = os.popen("curl http://api-testnet.coinsecrets.org/block/1457460").read()

print(result[0])
