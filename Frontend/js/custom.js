var buy1 = ['AAPL', 'IBM','MSFT','MCD','TRV','WMT','XOM'];
var sell1 = ['NKE', 'PFE','DWDP','JNJ','AXP','VZ','JPM'];

var buy2 = ['IBM', 'AAPL','MCD','MSFT','TRV','XOM','WMT'];
var sell2 = ['JNJ', 'VZ','DWDP','NKE','AXP','PFE','JPM'];

var buy3 = ['AAPL', 'XOM','WMT','MCD','TRV','MSFT','IBM'];
var sell3 = ['JPM', 'PFE','NKE','JNJ','AXP','VZ','DWDP'];

var buy4 = ['MCD', 'IBM','MSFT','WMT','TRV','AAPL','XOM'];
var sell4 = ['PFE', 'AXP','DWDP','JNJ','NKE','VZ','JPM'];

var div1 = document.getElementById('algo1');
var div2 = document.getElementById('algo2');
var div3 = document.getElementById('algo3');
var div4 = document.getElementById('algo4');

document.addEventListener("DOMContentLoaded", function(event) {
  populate(buy1,sell1);
});


div1.addEventListener('click', function (event) {
  document.getElementById('algoefficiency').innerHTML = "Multi Stacked Lstm Final Graph (with Historic Data)"
  document.getElementById("imggraph").style.marginLeft = "120px";
  document.getElementById("imggraph").src="images/multistacklstminfy.png";
  
  });
div2.addEventListener('click', function (event) {
  document.getElementById('algoefficiency').innerHTML = "Combined CNN LSTM model Final Graph (with news  headlines)"
  document.getElementById("imggraph").style.marginLeft = "50px";
  document.getElementById("imggraph").src="images/newsfinal.png";
  document.getElementById("imggraph1").style.marginLeft = "200px";
  document.getElementById("imggraph1").src="images/newsfinalcmd.png";
  
  });
div3.addEventListener('click', function (event) {
  document.getElementById('algoefficiency').innerHTML = "ARIMA Model Final Graph"
  document.getElementById("imggraph").style.marginLeft = "0px";
  document.getElementById("imggraph").src="images/ar.png";
  
  });
div4.addEventListener('click', function (event) {

  document.getElementById('algoefficiency').innerHTML = "AR Model Final Graph"
  document.getElementById("buy1").innerHTML = "";
  document.getElementById("sell1").innerHTML = "";
    populate(buy4,sell4);
  });


function populate(buy,sell){
  var list = document.getElementById('buy1');

    for(var i = 0; i < 7; i++) {
        // Create the list item:
        var item = document.createElement('li');

        // Set its contents:
        item.appendChild(document.createTextNode(buy[i]));

        // Add it to the list:
        list.appendChild(item);
    }

    var list2 = document.getElementById('sell1');

      for(var i = 0; i < 7; i++) {
          // Create the list item:
          var item2 = document.createElement('li');

          // Set its contents:
          item2.appendChild(document.createTextNode(sell[i]));

          // Add it to the list:
          list2.appendChild(item2);
      }

    // Finally, return the constructed list:
}
