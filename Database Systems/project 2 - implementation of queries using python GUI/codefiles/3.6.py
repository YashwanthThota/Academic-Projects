#Server Connection to MySQL:
import mysql.connector

cnx = mysql.connector.connect(user='root', password='yashwanth',
                              host='127.0.0.1',port='8080',database='final')
cursor = cnx.cursor()
print("please enter the account privilege details \n")
print("\n")
print("enter the account privilege id number(by default it is 1): ")
aid= input()
print("\n")
print("enter the rolename: ")
rolename= input()
print("\n")
print("enter the accountprivilegetype: ")
ap= input()
print("\n")
try:
   cursor.execute("""INSERT INTO accountprivileges VALUES (%s,%s,%s)""",(int(aid),rolename,ap))
   cnx.commit()
   print("successfully entered the values")
except:
   cnx.rollback()
   print("error")

cnx.close()
