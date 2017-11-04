#Server Connection to MySQL:
import mysql.connector

cnx = mysql.connector.connect(user='root', password='yashwanth',
                              host='127.0.0.1',port='8080',database='final')
cursor = cnx.cursor()
print("user privilege display\n")
print("please enter the userid number for which privileges need to be retrieved:\n")
idno = input()

try:
   cursor.execute(""" select x.idno as idno,x.fname as fname, x.lname as lname,y.rolename as rolename,y.privilegetype as privilegetype,y.tablename as tablename,y.privilegename as privilegename from(select * from (select a.rolename, a.a_privilegetype as privilegetype,"null" as tablename,p.priv_name as privilegename from accountprivileges as a, privileges as p where a.aid=p.pid union select r.rolename, r.r_privilegetype,r.tablename as tablename,t.priv_name as privilegename from relationprivileges as r, privileges as t where r.rid=t.pid) as r)as y, useraccount as x where x.rolename=y.rolename and idno =%s;"""%(idno))
   row = cursor.fetchone()
   while row is not None:
            print(row)
            row = cursor.fetchone()
   print("successfully retrieved")
except:
   cnx.rollback()
   print("error")

cnx.close()
