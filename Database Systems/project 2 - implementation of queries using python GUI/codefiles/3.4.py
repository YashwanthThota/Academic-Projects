#Server Connection to MySQL:
import mysql.connector

cnx = mysql.connector.connect(user='root', password='yashwanth',
                              host='127.0.0.1',port='8080',database='final')
count=0
cursor = cnx.cursor()
print("enter privilege display\n")
print("select the privilege:\n")
print("enter 1 for account privileges\n")
print("enter 2 for relation privileges\n")
option = input()

try:
   if option=="1":
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

   else:
       print("please enter the relation privilege details \n")
       print("\n")
       print("enter the relation privilege id number(by default it is 2): ")
       rid= input()
       print("\n")
       print("enter the rolename: ")
       rolename= input()
       print("\n")
       print("enter the relationprivilegetype: ")
       rp= input()
       print("\n")
       print("enter the tablename: ")
       tablename= input()
       print("\n")
       try:
           cursor.execute("""INSERT INTO relationprivileges VALUES (%s,%s,%s,%s)""",(int(rid),rolename,rp,tablename))
           cnx.commit()
           print("successfully entered the values")
       except:
           cnx.rollback()
           print("error")
except:
   cnx.rollback()
   print("error")
cnx.close()
           
