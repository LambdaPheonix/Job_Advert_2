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

var forms = document.querySelectorAll(".filter_forms");
forms.forEach(elem => {
    elem.classList.add('invis');
})
var filter_div = document.querySelector('#filters_bg');
filter_div.classList.add("invis");



