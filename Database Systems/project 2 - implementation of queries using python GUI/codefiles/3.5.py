#Server Connection to MySQL:
import mysql.connector

cnx = mysql.connector.connect(user='root', password='yashwanth',
                              host='127.0.0.1',port='8080',database='final')
cursor = cnx.cursor()
print("please enter the following details for updating role of an user \n")
print("\n")
print("enter the idno number of user : ")
idno= input()
print("\n")
print("enter the rolename: ")
rolename= input()
print("\n")
try:
   cursor.execute("""UPDATE useraccount SET rolename =(%s) where idno= (%s)""",(rolename,int(idno)))
   cnx.commit()
   print("successfully entered the values")
except:
   cnx.rollback()
   print("error")

cnx.close()
