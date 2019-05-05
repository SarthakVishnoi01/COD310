text = "IITDDOCS"
ans = ""
for ch in text:
    ans += (hex(ord(ch)).lstrip("0x"))
ans.strip(" ")
print(ans)
