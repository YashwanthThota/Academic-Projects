#Server Connection to MySQL:
import mysql.connector

cnx = mysql.connector.connect(user='root', password='yashwanth',
                              host='127.0.0.1',port='8080',database='final')
cursor = cnx.cursor()
print("please enter the table details \n")
print("\n")
print("enter the ownerid number: ")
ownerid= input()
print("\n")
print("enter the tablename: ")
tablename= input()
print("\n")
try:
   cursor.execute("""INSERT INTO tables VALUES (%s,%s)""",(ownerid,tablename))
   cnx.commit()
   print("successfully entered the values")
except:
   cnx.rollback()
   print("error")

cnx.close()
