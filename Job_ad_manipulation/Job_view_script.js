// imports files/ functions
import { sendData, todayDate } from "./Record_clicks.js";

//exports functions
export { hideMDDiv, DisplayMoreDetails, DisplayMDAd, addOnClick_MDbtn, cleanAdsDisplayDiv, displayFilter, displayRegion, displayUnpub, addClickFuncBtns  };


function makeDisplay(divName)
{ // makes filter btns display via divs
    // declared all DOM items to use
    //let btn = document.querySelector('#' + btnName);
    let div_filters = document.querySelector('#filters_bg');
    let form = document.querySelector('#' + divName);
    let forms = document.querySelectorAll(".filter_div");
    // making the div and form visible
    forms.forEach(elem => 
    {
        elem.classList.add("invis");
        elem.classList.remove('vis');
    });
    div_filters.classList.remove('invis');
    form.classList.remove('invis');
    div_filters.classList.add('vis');
    form.classList.add('vis');
}

function displayFilter()
{  // function to make DOM easier
    makeDisplay('filter_div');
}
function displayRegion()
{ // function to make DOM easier
    makeDisplay('region_div');
}
function displayUnpub()
{ // function to make DOM easier
    makeDisplay('unpub_div');
}

// adds click function to to display filters on function btns
function addClickFuncBtns()
{ // makes filter buttons
    let func_btns = document.querySelectorAll('.func_btn');
    let arrFuncs = [displayFilter, displayRegion, displayUnpub];
    arrFuncs.forEach(element => 
    {
        // const element = arrFuncs[i];
        func_btns[i].addEventListener('click',element);
    });
}

var forms = document.querySelectorAll(".filter_forms");
    forms.forEach(elem => {
        elem.classList.add('invis');
    });
    var filter_div = document.querySelector('#filters_bg');
    filter_div.classList.add("invis");


function DisplayMDAd(JT)
{ // displays extra details on ad 
    // JT = Job Title
    var elems = document.querySelectorAll('.'+JT);
    elems.forEach(elem => {
        // makes extra details visible
       elem.classList.remove('invis'); 
    });

}

// displays the current clicked btns divs and hides all others
function DisplayMoreDetails(JT,$uname)
{
    let btn = document.querySelector('.'+JT+'_btn');
    hideMDDiv();

    console.log(btn.classList.contains('open'));
    if (btn.classList.contains('open'))
    {
        btn.classList.remove('open');
    } else
    {
        DisplayMDAd(JT); 
        btn.classList.add('open');
        // creates data to send to server
        let date = todayDate();
        let data = [JT,date,$uname];
        console.log(date);
        data = JSON.stringify(data); // data has to be JSON
        // sends data to server
        sendData(data);
    }
}

// init add event listeners 
function addOnClick_MDbtn(btn,elemName,$uname)
{  
    if (btn != undefined)
    {
        btn.addEventListener('click', function()
        {DisplayMoreDetails(elemName,$uname);});
    } else
    {
        console.log("no btns found");
        return;
    }
}

// hides all more details divs.
function hideMDDiv()
{
    var divs = document.querySelectorAll('.MD_div')
    divs.forEach(elem => {
        elem.classList.add('invis');
    });
}

function cleanAdsDisplayDiv()
{ // cleans up the div for new filter results
    let parent = document.getElementById('display_ad_box');
    if (parent.lastChild.id == 'ads_display')
    {
    var element = document.querySelector('#ads_display').innerHTML = "";
    element.remove();
    } else 
    {
        return;
    }
}
