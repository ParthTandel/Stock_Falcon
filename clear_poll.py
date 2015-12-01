import time
import mysql.connector
import datetime
cnx = mysql.connector.connect(user='project', password='tcejorp',
                                  host='127.0.0.1',
                                  database='stockfalcon')
cursor = cnx.cursor(buffered=True)
cursor2 = cnx.cursor(buffered=True)
query = ("SELECT stock_ticker FROM stockfalcon.prediction")
cursor.execute(query)
for index, row in enumerate(cursor):
            row2 = row[0].strip("\n")
            row2 = row2.strip("\r")
            table = "vote_"+row2.lower()
            query = ("DELETE FROM `"+table+"` WHERE 1")
            print query
            cursor2.execute(query)
query = ("UPDATE `prediction` SET `sell_poll`=0,`buy_poll`=0,`hold_poll`=0 WHERE 1")
cursor.execute(query)
cnx.commit()
    
       
       
