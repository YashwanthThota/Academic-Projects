#Server Connection to MySQL:
import mysql.connector

cnx = mysql.connector.connect(user='root', password='yashwanth',
                              host='127.0.0.1',port='8080',database='final')
cursor = cnx.cursor()
print("please enter the role details \n")
print("\n")
print("enter the rolename: ")
rolename= input()
print("\n")
print("enter the description of role: ")
description= input()
print("\n")
try:
   cursor.execute("""INSERT INTO userrole VALUES (%s,%s)""",(rolename,description))
   cnx.commit()
   print("successfully entered the values")
except:
   cnx.rollback()
   print("error")

cnx.close()
