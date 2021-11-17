 
from flask import Flask, render_template, request, redirect, url_for, session
from flask_mysqldb import MySQL
import MySQLdb.cursors
import re
 
from mainFiles import yfinance
import plotly.express as px
import plotly

from pandas_datareader import data as pdr
import pandas as pd
from datetime import date
import json
import yfinance as yf
yf.pdr_override() 
app = Flask(__name__)
  
  
app.secret_key = 'vjp'
  
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'ps7'
  
mysql = MySQL(app)


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
      
 
     

     
        arryList = ['BSE:TCS','BSE:ITC','BSE:IDEA']
        jsonList = json.dumps(arryList)
        return render_template("chart.html", symbol=dataSearch, arryList=jsonList, arrylen=len(arryList))
            # else:
            #     return render_template("chart.html",symbol = dataSearch)

        # else:
        #     return render_template("Dashboard.html")
    else:
        return render_template("login.html",err =loginErr)



@app.route("/profile")
def profile():
    return render_template('profile.html')

@app.route("/",methods = ['GET','POST'])
def new():
    if request.method == 'GET' :
        return render_template('Dashboard.html',  )
    if request.method == 'POST':
        dataSearch = request.form['search']
        return render_template('Dashboard.html',msg = dataSearch)


@app.route("/predict",methods = ['GET','POST'])
def predict():
    if request.method == 'GET' :
        return render_template('predict.html')
    if request.method == 'POST':
        return render_template('predictResult.html')

    


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




@app.route('/login', methods =['GET', 'POST'])
def login():
    msg = ''
    err=''
    if request.method == 'POST' and 'email' in request.form and 'password' in request.form:
        email = request.form['email']
        password = request.form['password']
        cursor = mysql.connection.cursor(MySQLdb.cursors.DictCursor)
        cursor.execute('SELECT * FROM user WHERE email = % s AND password = % s', (email, password, ))
        account = cursor.fetchone()
        if account:
            session['loggedin'] = True
            session['userid'] = account['userid']
            session['email'] = account['email']
            msg = account["name"]
            logged_in = 1
            return render_template('Dashboard.html', msg = msg)
        else:
            err = 'Incorrect name / password !'
    return render_template('login.html', err = err)





  
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
        cursor = mysql.connection.cursor(MySQLdb.cursors.DictCursor)
        cursor.execute('SELECT * FROM user WHERE email = % s', (email, ))
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
            cursor.execute('INSERT INTO `user` (`userid`, `name`,`phoneno`, `email`, `password`) VALUES (NULL,% s, % s, % s, % s)', (name,phoneno, email, password, ))
            mysql.connection.commit()
            msg = 'You have successfully registered !'
    elif request.method == 'POST':
        msg = 'Please fill out the form !'
    return render_template('register.html', msg = msg)













if __name__ =='__main__':  
    app.run(debug = True,port=8000)  
    
