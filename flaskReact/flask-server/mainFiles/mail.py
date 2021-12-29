import smtplib
import sys
import math
import random
def send_mail(mail):
    server = smtplib.SMTP('smtp.gmail.com', 587)
    server.ehlo()
    server.starttls()
    server.ehlo()
    # mailadd = sys.argv[1]
    # print(mailadd)

    server.login('no.reply.stock.price.prediction@gmail.com', 'PASSWORD')
   
    
    subject = "OTP"

    string = '0123456789'
    OTP = ""

    length = len(string)
    for i in range(6) :
        OTP += string[math.floor(random.random() * length)]
    
    # body = sys.argv[2]
    #
    msg = f"Subject : {subject}\n\n{OTP}"


    # 'vjp264@hotmail.com'
    server.sendmail('no.reply.stock.price.prediction@gmail.com',mail, msg)
    

    print("sent")
    server.quit()
    return OTP
