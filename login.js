require('dotenv').config();

var http = require('http');
var connect = require('connect');
var Pool = require('pg').Pool;
var express = require('express');
var path = require('path');

var bodyParser = require('body-parser')

var app = express();

app.use(bodyParser.urlencoded({ extended: false }))

app.use(bodyParser.json())


var config = {
    host: 'db.imad.hasura-app.io',
    port: '5432',
    user: 'divyanshchowdhary2016',
    database: 'divyanshchowdhary2016',
    password: 'db-divyanshchowdhary2016-41762'
}

var pool = new Pool(config); //connect to the database

app.get('/', function(req, res) {
    res.sendFile(path.join(__dirname, 'login.html'));
})

app.get('/signup', function(req, res) {
    res.sendFile(path.join(__dirname, 'signup.html'));
})
app.post('/logStat', function(req, res) {
    var username = req.body.username;
    var password = req.body.password;
    pool.query("SELECT customer_name, customer_password FROM customers WHERE customer_name='" + username + "' AND customer_password='" + password + "'", function(err, result) {
        if (err) {
            res.status(500).send(err.toString());
        } else {
            if (result.rows.length === 0) {
                res.send('Invalid Creditianls');
            } else {
                res.send('User Validated');
            }
        }
    });
})

app.post('/register', function(req, res) {
    var username = req.body.username;
    var email = req.body.mail;
    var number = req.body.phno;
    var address = req.body.address;
    var pass = req.body.password;
    var repass = req.body.password2;
    var registration_fee = 500;
    var regperiod = 12;
    pool.query("INSERT INTO customers(customer_name, subscription_fees, customer_phno, customer_address, subscription_period, customer_password) VALUES ('" + username + "','" + registration_fee + "','" + number + "','" + address + "', '" + regperiod + "','" + pass + "')", function(err, result) {
        if (err) {
            res.status(500).send(err.toString());
        } else {
            res.send('Data added Successfully!!');
        }
    });
})

var port = 8080;
app.listen(8080, function() {
    console.log('Listening on port');
})