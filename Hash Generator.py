#!/usr/bin/env python
# coding: utf-8

# In[6]:


import hashlib
import numpy as np
import glob
import os
import PyPDF2 
from py_essentials import hashing as hs
import array 


# In[7]:


# import os
path = "/home/sarthak/Sem6/COD310/PDF"
file_list = [f for f in os.listdir(path) if os.path.isfile(os.path.join(path, f)) and f.endswith('.pdf')]
print(file_list)


# In[11]:


print(len(file_list))


# In[21]:


# arr = array.array(len(file_list))
hashes = []
for i in range(len(file_list)):
    location = "/home/sarthak/Sem6/COD310/PDF/" + file_list[i]
    hash = hs.fileChecksum(location, "sha256")
    print(hash)
    hashes.append(hash)


# In[ ]:


print(hashes)


# In[14]:


print(file_list[i])


# In[ ]:




