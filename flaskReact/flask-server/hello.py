import mysql.connector
mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="ps7"
)

cursor = mydb.cursor()
email="vjp264@hotmail.com"
password = "123"
data_user = (email,password)
add_user = 'SElect * from DB.tbluser WHERE email = % s AND password=% s'

cursor.execute('SElect * from user WHERE email = "'+email+'" AND password="'+password+'"')
account = cursor.fetchall()
print(account)
