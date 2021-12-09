 
from flask import Flask, render_template, request, redirect, url_for, session
import re
import mysql.connector

import numpy as np
from mainFiles import yfinance,prophetModel
import plotly.express as px
import time

from pandas_datareader import data as pdr
import pandas as pd
from datetime import date, time
import json
import yfinance as yf
yf.pdr_override() 
app = Flask(__name__)
  
  
app.secret_key = 'vjp'
mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="ps7"
)

cursor = mydb.cursor()
  
# app.config['MYSQL_HOST'] = 'localhost'
# app.config['MYSQL_USER'] = 'root'
# app.config['MYSQL_PASSWORD'] = ''
# app.config['MYSQL_DB'] = 'ps7'
  
# mysql = MySQL(app)


#######------MSG STRINGS--------#######
loginErr = 'Please Login First!!'

@app.route("/about")
def about():
    return render_template('about.html')

@app.route("/chart",methods = ['GET','POST'])
def chart():

    if session.get('loggedin')== True:
        # if request.method == "POST":
        dataSearch = request.form['search']
            # if dataSearch == "":
            #     err = "Please enter Symbol"
        userid = str(session['userid'])
        cursor.execute('SElect stocks from stockportfolio WHERE userid ="'+userid+'"')
        account = cursor.fetchall()
        arryList = account




        jsonList = json.dumps(arryList)
        return render_template("chart.html",  symbol=dataSearch, arryList=jsonList, arrylen=len(arryList))
            # else:
            #     return render_template("chart.html",symbol = dataSearch)

        # else:
        #     return render_template("Dashboard.html")
    else:
        return render_template("login.html",err =loginErr)



@app.route("/profile",methods = ['GET','POST'])
def profile():
    email = session['email']
    cursor.execute('SElect * from user WHERE email ="'+email+'"')
    account = cursor.fetchone()
    if request.method == 'POST':
        name = request.form['name']
        password = request.form['password']
        phoneno = request.form['phoneno']
        
        userid = request.form['userid']
        
        
        
        cursor.execute(
                'UPDATE `user` SET `name`="'+name+'",`phoneno`="'+phoneno+'",`password`="'+password+'" WHERE userid="'+userid+'"')
        mydb.commit()
        print('You have successfully registered !')
    
    return render_template('profile.html',data=account)

@app.route("/",methods = ['GET','POST'])
def new():
    if request.method == 'GET' :
        return render_template('Dashboard.html',  )
    if request.method == 'POST':
        dataSearch = request.form['search']
        return render_template('Dashboard.html',msg = dataSearch)

        
@app.route("/predict", methods=['GET', 'POST'])
def predict():
    if request.method == 'GET':
        return render_template('predict.html')
    if request.method == 'POST':
        quote = "tatamotors"
        days= 100
        result  = prophetModel.predictProphet(quote,days)
        print(result)
        return render_template('predictResult.html')

@app.route("/watchList",methods = ['GET','POST'])
def watchList():
    if request.method == 'GET':
        return render_template('watchList.html')
    if request.method == 'POST':
        count  = int(request.form['count'])
        print(type(count))

        watchListArr=[]
        userid = str(session['userid'])
        for c in range(0,int(count)):
            # watchListArr.append(request.form['symbol'+str(c)])
            tempSymbol = request.form['symbol'+str(c+1)]
            symbol= tempSymbol.split(":")
            cursor.execute(
                "INSERT INTO `stockportfolio`(`userid`, `stocks`) VALUES('"+userid+"', '"+symbol[1]+"')")
            
        arrJ = json.dumps(watchListArr)
        print(arrJ)
  
      
        # cursor.execute("INSERT INTO `stockportfolio`(`userid`, `stocks`) VALUES (`"+userid+"`, `"+arrJ+"`)")
        # cursor.execute('INSERT INTO `stockportfolio`(`stocks`) VALUES( `["NSE: RELIANCE", "NSE: INFY"]`)')
        mydb.commit()

        return render_template('watchList.html', msg=count )
  



    


@app.route("/home",methods = ['GET','POST'])
def home():
    if session.get('loggedin')== True: 

        if request.method == 'GET' :
            return render_template('Dashboard.html',  )
        if request.method == 'POST':
            dataSearch = request.form['search']
            return render_template('Dashboard.html',msg = dataSearch)
    else:
        return render_template("login.html", err=loginErr)

@app.route('/login', methods=['GET', 'POST'])
def login():
    msg = ''
    err = ''
    if request.method == 'POST' and 'email' in request.form and 'password' in request.form:
        email = request.form['email']
        password = request.form['password']
        if(email=="admin" and password=="123"):
            cursor.execute('SElect * from user')
            data = cursor.fetchall()
            print(data)
            return render_template('AdminPanel.html',data=data)
        else:
            cursor.execute('SElect * from user WHERE email ="'+email+'"  AND password ="'+password+'" ')
            account = cursor.fetchone()
            print(account)
            if account:
                session['loggedin'] = True
                session['userid'] = account[0]
                session['email'] = account[3]
                username = "Hello!"+account[1]
                # logged_in = 1
                return render_template('Dashboard.html', username=username)
            else:
                err = 'Incorrect name / password !' 
    return render_template('login.html', err=err)


@app.route('/AdminPanel', methods=['GET', 'POST'])
def admin():
    if request.method=='GET':
       cursor.execute('SElect * from user')
       data = cursor.fetchall()

       return render_template('AdminPanel.html', data=data)
    else:

        userid = request.form['userid']
        print(request.form)
        try:
            temp = request.form["delete"]
            action =0
        except:
            action = 1

        if(action==0):
            cursor.execute('DELETE FROM `user` WHERE userid="'+userid+'"')
            mydb.commit()
            msg ="deleted!"
            cursor.execute('SElect * from user')
            data = cursor.fetchall()
        else:
            cursor.execute('SElect * from user WHERE userid="'+userid+'"')
            data = cursor.fetchall()
            
        return render_template('editProfile.html', data=data,msg=request.method)
      
@app.route('/editProfile',methods=['GET', 'POST'])
def update():
    if request.method == 'POST':
        name = request.form['name']
        password = request.form['password']
        phoneno = request.form['phoneno']
        
        userid = request.form['userid']
        
        
        
        cursor.execute(
                'UPDATE `user` SET `name`="'+name+'",`phoneno`="'+phoneno+'",`password`="'+password+'" WHERE userid="'+userid+'"')
        mydb.commit()
        print('You have successfully registered !')

    return redirect('AdminPanel')

@app.route('/logout')
def logout():
    session.pop('loggedin', None)
    session.pop('userid', None)
    session.pop('name', None)
    return redirect(url_for('login'))
  



@app.route('/register', methods =['GET', 'POST'])
def register():
    msg = ''
    if request.method == 'POST' and 'name' in request.form and 'password' in request.form and 'email' in request.form :
        name = request.form['name']
        password = request.form['password']
        phoneno = request.form['phoneno']
        email = request.form['email']
        
        cursor.execute('SELECT * FROM user WHERE email ="'+email+'"')
        account = cursor.fetchone()
        if account:
            msg = 'EmailId already registered!'
        elif not re.match(r'[^@]+@[^@]+\.[^@]+', email):
            msg = 'Invalid email address !'
        elif not re.match(r'[A-Za-z0-9]+', name):
            msg = 'name must contain only characters and numbers !'
        elif not name or not password or not email or not phoneno:
            msg = 'Please fill out the form !'
        else:
            cursor.execute(
                'INSERT INTO `user` (`userid`, `name`,`phoneno`, `email`, `password`) VALUES (NULL,"'+name+'",'+phoneno+',"'+email+'","'+password+'" )')
            mydb.commit()
            msg = 'You have successfully registered !'
    elif request.method == 'POST':
        msg = 'Please fill out the form !'
    return render_template('register.html', msg = msg)



if __name__ =='__main__':  
    app.run(debug = True,port=8000)  
