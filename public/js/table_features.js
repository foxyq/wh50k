$(document).ready(function() {

    window.setInterval(function(){

        var vlhkosti = document.getElementsByClassName("vlhkost");
        var pocet_zobrazenych = 0;
        var suma_vlhkosti = 0;
        var tmp = '';

        for(var i=0; i<vlhkosti.length; i++) {

            tmp = vlhkosti[i].innerHTML.toString().replace(/[,]/, ".");

            var res = tmp.replace("%", "");
            res =  res.replace("-","0");

            suma_vlhkosti +=  Number(res);
            pocet_zobrazenych++;
        }
        var result = suma_vlhkosti / pocet_zobrazenych;

        $('#priemer').html( 'Priemer vlhkostí = ' +result.toFixed(2) + '%'); //.....  suma ' + suma_vlhkosti +',  pocet ' + pocet_zobrazenych);

        var tonaze = document.getElementsByClassName("tonaz");
        var suma_tonaz = 0;

        for( i=0; i<tonaze.length; i++) {
            suma_tonaz +=  Number(tonaze[i].innerHTML.toString().replace(/[,]/, "."));
        }

        $('#tonaz').html('Suma ton = ' + suma_tonaz );

        var m3 = document.getElementsByClassName("m3");
        var suma_m3= 0;

        for( i=0; i<m3.length; i++) {
            suma_m3 +=  Number(m3[i].innerHTML.toString().replace(/[,]/, "."));
        }

        $('#m3').html('Suma m<sup>3</sup>= ' + suma_m3 );

        var prm = document.getElementsByClassName("prm");
        var suma_prm= 0;

        for( i=0; i<prm.length; i++) {
            suma_prm +=  Number(prm[i].innerHTML.toString().replace(/[,]/, "."));
        }

        $('#prm').html('Suma prm = ' + suma_prm );

    }, 500);

});