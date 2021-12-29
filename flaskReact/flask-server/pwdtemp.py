import base64

password = "my_password".encode("utf-8")

encoded = base64.b64encode(password)
print(encoded)

print(base64.b64decode(encoded))
