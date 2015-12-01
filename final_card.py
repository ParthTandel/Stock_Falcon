import time
while 1:
    import mysql.connector
    import datetime

    cnx = mysql.connector.connect(user='project', password='tcejorp',
                                  host='127.0.0.1',
                                  database='stockfalcon')
    cursor = cnx.cursor(buffered=True)
    cursor2 = cnx.cursor(buffered=True)
    sql = "SELECT * FROM stockfalcon.last WHERE id = 1"
    cursor.execute(sql)
    previous_stock = ""
    for row in cursor:
      previous_stock = row[0]

    first = ""
    first_check = "false"
    last_check = "true"
    previous = "false"
    query = ("SELECT stock_ticker FROM stockfalcon.prediction")
    cursor.execute(query)
    for index, row in enumerate(cursor):
            row2 = row[0].strip("\n")
            row2 = row2.strip("\r")
            if(first_check == "false"):
                first_check = "true"
                first = row2
            if(previous == 'true'):
                last_check = 'false'
                query = "UPDATE stockfalcon.last SET stock_ticker ='"+row2+"' where id = 1"
                print query
                cursor.execute(query)
                break
            if(row2 == previous_stock):
                previous="true" 
                print row2
    if(last_check == "true"):
            print first
            query = ("UPDATE stockfalcon.last SET stock_ticker ='"+first+"' where id = 1")
            print query
            cursor.execute(query)
    cnx.commit()
    time.sleep(2)
       
       
