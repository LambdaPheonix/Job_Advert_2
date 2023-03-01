var server = "localhost";
var user = "root";
var PW = '';
var db = "job_adverts";
import { createConnection } from "./package/index";


export function connectDB(){
    var con = createConnection({
        host: server,
        user: user,
        password: PW,
        database: db
      });
      
      con.connect(function(err) {
        if (err) throw err;
        console.log("Connected!");
      });  
    return con;
}