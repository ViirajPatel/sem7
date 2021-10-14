from flask import Flask, render_template, request, redirect, url_for, session
from flask_mysqldb import MySQL
import MySQLdb.cursors
import re
import hello  
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



@app.route("/")
def new():
    sym = "INFY"
    # download dataframe
    data = pdr.get_data_yahoo(sym+".NS", start=date(2019,8,13),end=date(2021,9,13))
    df = pd.DataFrame(data)
    fig = px.line(df)
    graphJSON = json.dumps(fig, cls=plotly.utils.PlotlyJSONEncoder)
  #  data = yfinance.main("INFY")
    return render_template("index.html",graphJSON=graphJSON)

@app.route('/login', methods =['GET', 'POST'])
def login():
    msg = ''
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
            return render_template('index.html', msg = msg)
        else:
            msg = 'Incorrect name / password !'
    return render_template('login.html', msg = msg)
  
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
    