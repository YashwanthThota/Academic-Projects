#Server Connection to MySQL:
import mysql.connector

cnx = mysql.connector.connect(user='root', password='yashwanth',
                              host='127.0.0.1',port='8080',database='final')
cursor = cnx.cursor()
print("please enter the user details \n")
print("\n")
print("enter the idno: ")
idno= input()
print("\n")
print("enter the Fname: ")
fname= input()
print("\n")
print("enter the Lname: ")
lname= input()
print("\n")
print("enter the phone number:")
phone= input()
print("\n")
print("enter the userid")
userid= input()
print("\n")
print("enter the password: ")
password= input()
print("\n")
print("enter the rolename: ")
rolename= input()
print("\n")

try:
   cursor.execute("""INSERT INTO useraccount VALUES (%s,%s,%s,%s,%s,%s,%s)""",(int(idno),fname,lname,phone,userid,password,rolename))
   cnx.commit()
   print("successfully entered the values")
except:
   cnx.rollback()
   print("error")

cnx.close()
