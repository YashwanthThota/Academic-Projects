#Server Connection to MySQL:
import mysql.connector

cnx = mysql.connector.connect(user='root', password='yashwanth',
                              host='127.0.0.1',port='8080',database='final')
count=0
cursor = cnx.cursor()
print("revoke role privilege display\n")
print("select the privilege:\n")
print("please enter the rolename for which privileges need to be retrieved:\n")
rolename = input()
print("enter 1 for account privileges\n")
print("enter 2 for relation privileges\n")
option = input()

try:
   if option=="1":
      cursor.execute(""" select * from accountprivileges where rolename = "%s";"""%(rolename))
      row = cursor.fetchone()
      while row is not None:
            print(row)
            count=count+1
            row = cursor.fetchone()
      if count>0:
         print("enter the accountprivileges which you want to revoke")
         privname=input();
         cursor.execute("""delete from accountprivileges where rolename= "%s" and a_privilegetype="%s";"""%(rolename,privname))
         cnx.commit()
         print("successfully deleted")
      else:
         print("empty set")
   else:
      cursor.execute(""" select * from relationprivileges where rolename = "%s";"""%(rolename))
      row = cursor.fetchone()
      while row is not None:
         print(row)
         count=count+1
         row = cursor.fetchone()
      if count>0:
         print("enter the relationprivileges which you want to revoke")
         privname=input();
         cursor.execute("""delete from relationprivileges where rolename= "%s" and r_privilegetype="%s";"""%(rolename,privname))
         cnx.commit()
         print("successfully deleted")
      else:
         print("empty set")
except:
   cnx.rollback()
   print("error")

cnx.close()
