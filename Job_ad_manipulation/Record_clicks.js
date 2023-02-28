// files functions are to help record all the clicks on the ads available
// process 
//  person clicks more dtails
//  click added to csv with date
//    format (click_count,job_title/vancany ref,date);
            // vacancy ref will be captured when the btns are created in form (JT,VR)
//  once the page is closed the data in the csv is retrieved and updated to the db
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


