const app = require('express')();
const server = require('http').Server(app);
const io = require('socket.io')(server, {
    cors: {
        origin: '*',
    }
});
const redis = require('redis');

server.listen(8890);
io.on('connection', function(socket){
    console.log('client connected');
    let redisClient = redis.createClient();
    redisClient.subscribe('message');

    redisClient.on('message', function(channel, data){
        socket.emit(channel, data);
    });

    socket.on('disconnect', function(){
        redisClient.quit();
    });
})