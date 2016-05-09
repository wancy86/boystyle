/**
 * Module dependencies.
 */

var express = require('express'),
    routes = require('./routes'),
    user = require('./routes/user'),
    http = require('http'),
    path = require('path'),
    request = require('request'),
    param = require('jquery-param'),
    md5 = require('md5'),
    moment = require('moment');

var app = express();

app.configure(function() {
    app.set('port', process.env.PORT || 80);
    app.set('views', __dirname + '/views');
    app.set('view engine', 'jade');
    app.use(express.favicon(path.join(__dirname, 'public', 'images', 'favicon.ico')));
    app.use(express.logger('dev'));
    app.use(express.bodyParser());
    app.use(express.methodOverride());
    app.use(app.router);
    app.use(express.static(path.join(__dirname, 'public')));

});

app.configure('development', function() {
    app.use(express.errorHandler());
});

//app.get('/', routes.index);
app.get('/users', user.list);

http.createServer(app).listen(app.get('port'), function() {
    console.log("Express server listening on port " + app.get('port'));
});

//-----------------------

var taobao = "http://gw.api.taobao.com/router/rest?sign="
var tdata = {
    app_key: "12129701",
    //fields: "num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,nick,seller_id,volume,total_results",
    fields: "pict_url",
    format: "json",
    method: "taobao.tbk.item.get",
    partner_id: "top-apitools",
    sign_method: "md5",
    timestamp: moment().format('YYYY-MM-DD HH:mm:SS'),
    v: "2.0"
};
console.log(tdata.timestamp);
var secret = 'test';
//2016-01-10 10:01:24
//timestamp2016-01-10+10%3A01%3A24
var paramstr = param(tdata).replace(/=/g, '').replace(/&/g, '').replace(/\+/g, ' ').replace(/\%3A/g, ':');
paramstr = secret + paramstr + secret;
console.log(paramstr);
var sign = md5(paramstr).toUpperCase();
console.log(sign);
taobao += sign + '&' + param(tdata);

console.log(taobao);

// var test ='testapp_keytestfieldsnickformatxmlmethodtaobao.user.seller.getsessiontestsign_methodmd5timestamp2013-05-06 13:52:03v2.0test';
// console.log(md5(test).toUpperCase());
//72CB4D809B375A54502C09360D879C64
//72CB4D809B375A54502C09360D879C64

app.get('/', function(req, res) {
    if (true)
        res.render('index', {
            title: "boystyle",
            taobao: taobao
        });

    if (false)
        request(taobao, function(error, response, body) {
            console.log(error);
            res.render('index', {
                title: "boystyle",
                taobao: taobao
            });
        });
});
