// files functions are to help record all the clicks on the ads available
// process 
//  person clicks more dtails
//  click added to csv with date
//    format (click_count,job_title/vancany ref,date);
            // vacancy ref will be captured when the btns are created in form (JT,VR)
//  once the page is closed the data in the csv is retrieved and updated to the db
import { connectDB } from "../serverDetail.js";
//import { createConnection } from "mysql";

export class Ad_record {

    #jobTitle;
    #clickCount = 0;
    #day ;
    #entry;
    constructor (jobTitle,date){
        this.#day = date;
        this.#jobTitle = jobTitle;
        this.#clickCount = 0;
        this.#entry = [this.jobTitle,toString(this.clickCount),this.day];
        
    }

    set jobTitle(JT){
        if(this.#jobTitle === undefined){
            this.#jobTitle = JT;
            } else {
                console.log('VR has been set');
            }
    }
    set clickCount(clickCount){
        if (isNaN(clickCount)){
            console.log('click Count needs to be a number');
        } else {
            this.#clickCount = clickCount;
        }
    }
    get day(){
        return this.#day;
    }
    get jobTitle(){
        return this.#jobTitle;
    }
    get clickCount(){
        return this.#clickCount;
    }
    get entry(){
        this.#entry = [this.jobTitle,toString(this.clickCount),this.day];
        return this.#entry;
    }
    onClickBtn(JT) { // increase the click count 
        if (JT === this.#jobTitle){
        this.#clickCount += 1;
        console.log(this.clickCount);
        } else {
            console.log ('Wrong job title for this btn');
        }
    }
    onDestroyCls(){
        const fs = require("fs");
        content = toString(this.#entry);
        fs.appendFile(
            "Cls_save.txt",
            content,
            function (err) {
              if (err) {
                return console.error(err);
              }
        });       
    }
}


function createAssArr(arrkeys,arrValues){
    let arrResult = [];
    for (let i = 0; i < arrkeys.length; i++) {
        const key = arrkeys[i];
        const value = arrValues[i];     
        arrResult[key] = value; 
    }
    return arrResult;
}

export function todayDate(){
    // formate dd-mm-yyyy
    const date = new Date();
    let yyyy = date.getFullYear();
    let mm = date.getMonth();
    let dd = date.getDate();
    if (dd < 10){
        dd = "0"+toString(dd);
    } else {
        dd = toString(dd);
    }
    if (mm < 10){
        mm = "0"+toString(mm);
    } else {
        mm = toString(mm);
    }
    yyyy = toString(yyyy);
    let returnStr = dd+'-'+mm+'-'+yyyy;
    return returnStr;
}


function createUpdateQuery(arrCls){
    // gonna update all overall clicks (will try make it do it in one go)
        // recieves an arr of class Ad_record
        // takes clicks in from class
        // create new array with all classes that have clicks
        
        // create SQL that adds clicks to jt that has clicks added.
    let arrCls_with = [];
    arrCls.forEach(Cls => { // puts out any none used classes
        if (Cls.clickCount > 0){
            arrCls_with.push(Cls);
        }
    });   
    if(arrCls_with.length >0){
        let WhenStmtStr = "";
        arrCls.forEach(Cls => { // makes all the When statements needed for the SQL case
            WhenStmtStr += makeWhen(Cls);
        });
        // 
        let WhereList = listWhere(arrCls_with);
        // puts SQL elements together to use
        let SQL = makeSQL_update_case('tbl_clicks','job_title','Clicks',WhenStmtStr,WhereList);
        console.log(SQL);
        // connect to db
        let con = connectDB();
        con.connect(function(err) {
            if (err) throw err;
            con.query(SQL, function(err, result){
                if (err) throw err;
                console.log(result.affectedRows + " records(s) updated");
            });
        });

    } else {
        console.log('no classes updated');
        return;
    }
    con.end;   
}

// makes a when statement for the sql in str form
function makeWhen(Cls){
    let JT = Cls.jobTitle;
    let clicks = Cls.clickCount;
    let returnStr = "WHEN '"+JT+"' THEN Clicks + "+clicks;
    return returnStr;
}

// makes a list of where statments in str form
function listWhere(arrCls){
    let returnStr = "";
    arrCls.forEach(Cls => {
        returnStr += "'"+ Cls.jobTitle + "', ";
    }); 
    returnStr = returnStr.substr(0,returnStr.length-2);
    return returnStr;
}

// makes SQL for the updating of the total clicks
function makeSQL_update_case(tbl,columnKey,columnValue,WhenStmtStr,WhereList){
    SQL = '';
    SQL = "UPDATE " + tbl + " SET " + columnValue + " = CASE " + columnKey 
        + WhenStmtStr + " ELSE " + columnValue + " END WHERE "
        + columnKey + " IN( " + WhereList + " );";
    return SQL;
}

export function uploadUnseenADs(uname,jt,vacancy_ref){
    let con = connectDB();
    let sql = "Select companyName from tbl_users where username = '" + uname + "';";
    //let companyName = '';
    con.query(sql, (err,results,fields) =>{
        if (err) throw err;
        console.log(results);
        console.log(fields);
       // var res = results;
       // var fields_q = fields; 
    });
    //companyName = res;

}
