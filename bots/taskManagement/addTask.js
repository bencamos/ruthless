var include = require('./../includes.js');
const mysql = require('mysql')

module.exports.addTask = (id, status, website, productKeyWords, productLink, proxy, payment, quantity, variant, account, shipping, billing, exectime) => {
  var con = mysql.createConnection(include.db.databaseOptions);
  con.query(`INSERT INTO tasks (id, status, website, productKeyWords, productLink, proxy, payment, quantity, variant, account, exectime, shipping, billing, success, fail) VALUES (${id}, ${status}, ${website}, ${productKeyWords}, ${productLink}, ${proxy}, ${payment}, ${quantity}, ${variant}, ${account}, ${exectime}, ${shipping}, ${billing}, "0", "0")`)
  con.end()
}
