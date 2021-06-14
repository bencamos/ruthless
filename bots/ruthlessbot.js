// This file is the head of all tasks driven by user specified input commands.
process.env.UV_THREADPOOL_SIZE=64;var include=require("./includes.js");const readline=require("readline").createInterface({input:process.stdin,output:process.stdout});
const {Worker} = require('worker_threads');
const mysql = require('mysql')
var ruthless = async () => {
  console.log(`Running RuthlessBot: ${include.version}\n\r\n\r`)
  process.stdout.write(`Checking database connectivity...    `)
  var con = mysql.createConnection(include.db.databaseOptions);
  con.query(`SELECT * FROM users Limit 1`,(o,e)=>{if(o)throw o;e.forEach(o=>{console.log("Success!\n\r")})});
  con.end()
  var serverWorker = `${include.server.runServer()}`
  var serverWorkerRun=new Worker(serverWorker,{eval:!0});
  var timingsWorker = `${include.timingsTask.timingsTask()}`
  var timingsWorkerRun=new Worker(timingsWorker,{eval:!0});

  function sleep(ms) {
    return new Promise((resolve) => {
      setTimeout(resolve, ms);
    });
  }
  await sleep(500);
  var prompt = function (){
    readline.question('>> ', (command) => {
      switch (command.toLowerCase()) {
        case 'help' : {
          console.log(`Commands:
              Status:   Display the status of the bot.`)
          break;
        }
        case 'status' : {
          console.log(serverWorkerRun)
          console.log(timingsWorkerRun)
          break;
        }
      }
      prompt();
    });
  }
  prompt();
}
ruthless();