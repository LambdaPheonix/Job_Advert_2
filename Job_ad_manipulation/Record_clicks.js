// files functions are to help record all the clicks on the ads available

// sends data to php through XMLHttpRequest


export function todayDate(){
    // formate dd-mm-yyyy
    const date = new Date();
    let yyyy = date.getFullYear();
    let mm = date.getMonth();
    let dd = date.getDate();
    if (dd < 10){
        dd = "0"+(dd);
    } else {
        dd = (dd);
    }
    if (mm < 10){
        mm = "0"+(mm);
    } else {
        mm = (mm);
    }
    let returnStr = yyyy+'-'+mm+'-'+dd;
    return returnStr;
}


// to upload data to db and transfer data to server. (for daily clicks)

// Transfers data to server (data is manipulated in Data_manipulation.php )
export function sendData(data){ // note data has to be in JSON form already
    var xhr = new XMLHttpRequest();

    // target for data
    //export_file = (doesFileExist("./Receive_data.php"))? "./Receive_data.php" : "./record_data/Receive_data.php";
    xhr.open("POST","./Data_manipulation.php",true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function(){
        if (xhr.readyState == XMLHttpRequest.DONE){
           // alert(xhr.responseText);
            let div1 = document.querySelector("#dump");
            let rStr =  "<p>"+ xhr.responseText +"</p>";
            console.log(rStr);
            div1.innerHTML = rStr;
        }
        if (xhr.status == 404){
            alert("file not found");
        }
    };

    xhr.send(data);
}

