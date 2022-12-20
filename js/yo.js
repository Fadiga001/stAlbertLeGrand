jQuery(function($){
    /*var date = date    /!*new Date(2020,02,29,07,00,00);*!/;*/
    var jour = $('#jour');
    var heure = $('#heure');
    var min = $('#minute');
    var sec = $('#seconde');
    mois = ['JAN','FEV','MAR','AVR','MAI','JUN','JUL','AOU','SEP','OCT','NOV','DEC']
    setDate();
    function setDate(){
        var now = new Date();
        var s = (date.getTime() - now.getTime());
        console.log(s)
        var d = Math.floor(s/86400000);
        jour.html('<h4>'+d+'</h4>jour'+(d>1?'s':''));
        s -= d*86400000;

        var h = Math.floor(s/3600000);
        heure.html('<h4>'+h+'</h4>heure'+(h>1?'s':''));
        s -= h*3600000;

        var m = Math.floor(s/60000);
        min.html('<h4>'+m+'</h4>min'+(m>1?'s':''));
        s -= m*60000;

        var s = Math.floor(s/1000);
        sec.html('<h4>'+s+'</h4>sec'+(s>1?'s':''));

        setTimeout(setDate,1000);
    }
    $('.event-date').html('<h2>'+date.getDate('dd')+'</h2>'+mois[date.getMonth()]);
});