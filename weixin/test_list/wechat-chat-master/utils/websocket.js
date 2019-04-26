var url = 'http://www.anniluohaixing.xyz';

function connect (user, func) {

  wx.connectSocket({
    url: url + '?username='+user.nickName
  });

  wx.onSocketMessage(func);
}


function send (msg) {
  wx.sendSocketMessage({data:msg});
}
module.exports = {
  connect: connect,
  send : send
}
