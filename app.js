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
    md5 = require('md5');

var app = express();

app.configure(function() {
    app.set('port', process.env.PORT || 3000);
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
    fields: "num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,nick,seller_id,volume,total_results",
    format: "json",
    method: "taobao.tbk.item.get",
    sign_method: "md5",
    timestamp: "2016-01-09 14:00:00",
    v: "2.0"
};
var secret = 'CooMark';
var sign = md5(secret + param(tdata).replace(/=/, '').toUpperCase() + secret);
sign = sign.toUpperCase();
taobao += sign + '&' + param(tdata)

app.get('/', function(req, res) {
    res.render('index', {
        title: "boystyle",
        taobao: taobao
    });
    if (false)
        request(taobao, function(req, res) {

            res.render('index', {
                title: "boystyle",
                taobao: taobao
            });
        });
});

