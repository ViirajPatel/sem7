import base64
import mysql.connector
mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="ps7"
)

cursor = mydb.cursor()

email = "ABcd@bcd.com"
password = "123"
passObj = password.encode("utf-8")
encodeed= base64.b64encode(passObj)
strpwd = str(encodeed).split("'")
print(strpwd)
strpass = strpwd[1]
cursor.execute(
    'INSERT INTO `user` ( `name`,`phoneno`, `email`, `password`) VALUES ("viraj",7046529350,"'+email+'","'+strpass+'" )')
mydb.commit()

cursor.execute('SELECT password FROM user WHERE email ="'+email+'"')
account = cursor.fetchone()


list1 = account
if(str(base64.b64decode(account[0])).split("'")[1]=="Viraj Patel"):
    print("okk")
print(base64.b64decode(account[0]))
