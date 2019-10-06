var app = require('http').createServer(handler),//このサーバーにリクエストが来た時にhandlerを実行しなさい
    io = require('socket.io').listen(app), //appサーバーとの紐づけ
    fs = require('fs');
app.listen(80443);//このサーバーをこのポートで待ち受け状態にしなさいという処理

 //サーバーにリクエストが来た時(この場合はポート1337へのリクエスト)に実行することを引数req,resとして渡している
function handler(req, res) {
    fs.readFile(__dirname + '/taimen.php', function(err, data){
        if(err) {
            res.writeHead(500);//500とはserver errorを吐くエラーコード
            return res.end('リクエストエラーが発生しました');//resを指定することでresponse時に行う処理を指定できる
        }
        res.writeHead(200);//コード200番を返す
        res.write(data);//dataの中には上記のindex.htmlのdataが格納されている
        res.end();//作業終了
    })            
}
           //socket接続     
io.sockets.on('connection', function(socket) {
       socket.on('emit_from_client', function(data){
           //console.log(data);
           
           //接続しているソケットのみ
           //socket.emit('emit_from_server', 'hello from server:' + data);
           
           //接続しているソケット以外全部
           //socket.broadcast.emit('emit_from_server', 'hello from server:' + data);
           
           //接続しているソケット全部
           io.sockets.emit('emit_from_server', '[' + socket.id +'] :' + data);
       });
    });
    
