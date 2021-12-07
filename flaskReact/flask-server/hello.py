import mysql.connector
mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="ps7"
)

cursor = mydb.cursor()
userid = "1"
cursor.execute('SElect stocks from stockportfolio WHERE userid ="'+userid+'"')
account = cursor.fetchall()

list1 = account
print(type(list1))
print(account[0])
