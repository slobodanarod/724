var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
http.listen(3000, function () {
    console.log("Server çalışıyor...")
});

var users = [];

app.get('/', function (req, res) {
    res.send('Burası Anasayfa')
});

io.on('connection', socket => {

    socket.on('login', function (data) {
        nData = { id : socket.id, room_id : data.room_id , user : data.user};
        users.push(nData);
    });

    socket.on('new_msg', function (data) {
        io.emit("chat", data);

    });

    socket.on('chat_login', function () {
        io.emit("chat_login",users);
    });


    socket.on('onlineCheck', function (data) {
        kontrol = users.filter(item => item.user.id === data.user_id);
        sendData = kontrol.length > 0;
        io.emit("onlineCheck",sendData);
    });

    socket.on('GetOnlines', function () {
        newusers = users.filter(item => item.id !== socket.id);
        io.emit("GetOnlines",newusers);
    });

    socket.on('sendMessage', function (data) {
        io.emit("sendMessage",data);
    });

    socket.on('disconnect', () => {
        newusers = users.filter(item => item.id !== socket.id);
        users = newusers;
    });
});
