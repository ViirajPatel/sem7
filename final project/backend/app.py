from flask import Flask, render_template
from flask import Flask
from flaskext.mysql import MySQL


app = Flask(__name__)
db = MySQL()
app.config['MYSQL_DATABASE_USER'] = 'root'
app.config['MYSQL_DATABASE_PASSWORD'] = ''
app.config['MYSQL_DATABASE_DB'] = 'ps5'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'
db.init_app(app)

conn = db.connect()
cursor =conn.cursor()

cursor.execute("INSERT INTO `user`(`username`, `pwd`, `type`, `name`, `mobileno`, `email`, `zipcode`, `state`, `city`, `district`) VALUES ('viraj1','234','0','viraj','9996665551','xyz@yy.com','','','','')")
data = cursor.fetchone()
print(data)

# class prjct(db.Model):
#     userid = db.Column(db.Integer, primary_key =True)
#     name = db.Column(db.String,nullable=False)
#     password = db.Column(db.String,nullable=False)


    # def __repr__(self) -> str:
    #     return f"{self.userid} - {self.name}"



@app.route('/')
def hello():
    return render_template("index.html")


@app.route('/products')
def p():
    return "hello"


if __name__ =="__main__":
    app.run(debug = True)