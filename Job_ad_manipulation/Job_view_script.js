//import { Ad_record } from "Record_clicks.js";

export { hideMDDiv, DisplayMoreDetails, DisplayMDAd, addOnClick_MDbtn, cleanAdsDisplayDiv, displayFilter, displayRegion, displayUnpub, addClickFuncBtns  };


function makeDisplay(divName){
    // declared all DOM items to use
    //let btn = document.querySelector('#' + btnName);
    let div_filters = document.querySelector('#filters_bg');
    let form = document.querySelector('#'+divName);
    let forms = document.querySelectorAll(".filter_div");
    // making the div and form visible
    forms.forEach(elem => {
        elem.classList.add("invis");
        elem.classList.remove('vis');
    });
    div_filters.classList.remove('invis');
    form.classList.remove('invis');
    div_filters.classList.add('vis');
    form.classList.add('vis');
}
function displayFilter(){ 
    makeDisplay('filter_div');
}
function displayRegion(){
    makeDisplay('region_div');
}
function displayUnpub(){
    makeDisplay('unpub_div');
}

function addClickFuncBtns(){
    let func_btns = document.querySelectorAll('.func_btn');
    let arrFuncs = [displayFilter, displayRegion, displayUnpub];
    for (let i = 0; i < arrFuncs.length; i++) {
        const element = arrFuncs[i];
        func_btns[i].addEventListener('click',element);
    }
}

var forms = document.querySelectorAll(".filter_forms");
    forms.forEach(elem => {
        elem.classList.add('invis');
    });
    var filter_div = document.querySelector('#filters_bg');
    filter_div.classList.add("invis");


function DisplayMDAd(JT){
    // JT = Job Title
    var elems = document.querySelectorAll('.'+JT);
    elems.forEach(elem => {
       elem.classList.remove('invis'); 
    });
}

// displays the current clicked btns divs and hides all others
function DisplayMoreDetails(JT,Cls_ad){
    let btn = document.querySelector('.'+JT+'_btn');
    hideMDDiv();

    console.log(btn.classList.contains('open'));
    if (btn.classList.contains('open')){
        btn.classList.remove('open');
    } else{
        DisplayMDAd(JT);
        Cls_ad.onClickBtn(JT);  
        btn.classList.add('open');
    }
}

// init add event listeners 
function addOnClick_MDbtn(btn,elemName,Cls_ad){  
    if (btn != undefined){
        btn.addEventListener('click', function(){DisplayMoreDetails(elemName,Cls_ad);});
    }
    else{
        console.log("no btns found");
        return;
    }
}

// hides all more details divs.
function hideMDDiv(){
    var divs = document.querySelectorAll('.MD_div')
    divs.forEach(elem => {
        elem.classList.add('invis');
    });
}

function cleanAdsDisplayDiv(){
    let parent = document.getElementById('display_ad_box');
    if (parent.lastChild.id == 'ads_display'){
    var element = document.querySelector('#ads_display').innerHTML = "";
    element.remove();
    } else {
        return;
    }
}
