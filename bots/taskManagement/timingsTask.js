var include = require('./../includes.js')
const mysql = require('mysql')
function sleep(ms) {
  return new Promise((resolve) => {
    setTimeout(resolve, ms);
  });
}
const doSomething = async () => {
  while (true) {
    await sleep(500)
    var time = Date.now();
    var con = mysql.createConnection(include.db.databaseOptions);
    con.query(`SELECT * FROM tasks WHERE status = 'Waiting...' and exectime <= ${time}`,(o,e)=>{if(o)throw o;e.forEach(o=>{console.log("New task is scheduled to launch!"),include.launchTask.launchTask(o.taskID)})});
    con.end()
  }
}
module.exports.timingsTask = () => {
  doSomething()
}