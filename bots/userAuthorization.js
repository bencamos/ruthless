var include = require('./includes.js')
const mysql = require('mysql')

module.exports.userAuth = (chunk) => {
  var taskInformation = chunk.toString().replace(/\r?\n|\r/g, '').split(',')// Properly converting the received data into processable chunks.
  var id=taskInformation[0],hashedPassword=taskInformation[1],website=taskInformation[2],productKeyWords=taskInformation[3],productLink=taskInformation[3],proxy=taskInformation[4],payment=taskInformation[5],quantity=taskInformation[6],variant=taskInformation[7],account=taskInformation[8],shipping=taskInformation[9],billing=taskInformation[10],exectime=parseInt(taskInformation[11]);
  var letters = /[ `!@#$%^&*()_+\-=[\]{};':'\\|,.<>/?~]/ // Illegal character whitelist.
  if (letters.test(id)) {
    console.log(`Malicous request denied.\n   From: ${include.socket.remoteAddress}\n   Request: '${taskInformation}'`)
  } else {
    var con = mysql.createConnection(include.db.databaseOptions);
    con.query(`SELECT * FROM users WHERE id = '${id}'`,(e,i)=>{if(e)throw e;i.forEach(e=>{e.password===hashedPassword?(console.log(`Incoming task from: ${id}\n   Verific: Success\n`),include.addTask.addTask(id, status, website, productKeyWords, productLink, proxy, payment, quantity, variant, account, shipping, billing, exectime)):console.log(`Incoming task from: ${id}\n   Verific: Failed`)})});
    con.end()
  }
}
