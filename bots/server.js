var include = require('./includes.js')
var net = require('net')
module.exports.runServer = () => {
  var server = net.createServer(function (socket) {
    socket.write(`Running RuthlessBot: ${include.version}\n\r`)
    socket.on('data', function (chunk) {
      var buffer = `${include.userAuthorization.userAuth(chunk)}`
    })
  })
  server.listen(1905, '0.0.0.0')
}
