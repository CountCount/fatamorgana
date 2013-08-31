getKey();
var checkCP = window.setInterval(function() {checkDVstate();}, 1000);

function checkDVstate() {
  if ( $('.root_wall1').length > 0 && $('a.fm-constructions').length == 0 ) {
    // first show percentages
    var bbars = document.getElementsByClassName("bbar");
    for (i in bbars) {
      var cbar=bbars[i];
      if ( cbar != undefined ) {
        var cwid=parseFloat(cbar.offsetWidth);
        var cpar=cbar.parentNode;
        if ( cpar != undefined ) {
          var pwid=parseFloat(cpar.offsetWidth);
          var cpro=Math.round(cwid/pwid*100,2);
          var newdiv=document.createElement("div");
          var newtext=document.createTextNode(cpro+"%");newdiv.style.float="right";
          newdiv.style.color="#ff0";
          newdiv.style.fontWeight="bold";
          newdiv.style.fontSize="12px";
          newdiv.style.textAlign="right";
          newdiv.appendChild(newtext);
          cpar.appendChild(newdiv);
        }
      }
    }
    // second, let's get that updater working
    var constable = $('.root_wall1').parent().parent();
    var cuf = $(document.createElement('form'));
    cuf.attr('id','fm-constructions-form').attr('method','POST').attr('action','http://dieverdammten.net/fatamorgana/update/constructions').attr('target','_blank');
    var tmk = $(document.createElement('input'));
    tmk.attr('type','hidden').attr('value',personalKey).attr('name','key').addClass('fm-transferkey');
    cuf.append(tmk);
    var tmt = $(document.createElement('input'));
    tmt.attr('type','hidden').attr('value','').attr('name','data').addClass('fm-transfermessage');
    cuf.append(tmt);
    cuf.insertBefore(constable);
    var cub = $(document.createElement('a'));
    cub.addClass('button').addClass('fm-constructions').html('<img src="http://www.dieverdammten.de/file/29.dat" alt="" title="Alle fertigen Gebäude auflisten und senden"> <strong>Transfer zu Fata Morgana</strong>');
    cub.insertBefore(constable);
    //alert('button inserted');
    $('.fm-constructions').live('click',function() {
      scanconstpage();
    });
  }
}

function scanconstpage() {
  var buildings = new Array;
  var rows = $('tr.building');
  rows.each(function() { 
    var bname = $(this).children('.name').children('strong').html();
    var bdone = $(this).hasClass('done');
    var block = $(this).hasClass('locked');
    var bimg = $(this).children('.name').children('img:last').attr('src');
		var bindent = $(this).children('.name').children('img').length - 1;
    if (bdone == false && block == false) {
      var bap = $(this).children('.rsc').children('.list').children('.rscItem:first').text().trim();
    }
    else {
      var bap = "0";
    }
    
    buildings.push(JSON.stringify({"name":bname, "done":bdone, "lock":block, "image":bimg, "ap":bap, "indent":bindent})); 
  }); 
  $('.fm-transfermessage').attr('value',buildings.toString());
  $('form#fm-constructions-form').submit();
  return false;
  //alert(buildings.toString());
}

var personalKey = '';

function getKey() {
  var xhr = null;
  xhr = new XMLHttpRequest();
  if (xhr) {
    xhr.open('GET', '/disclaimer?id=26;rand='  + Math.random(), true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && /name=\"key\"\s+value=\"([a-zA-Z0-9]+)\"/.test(this.responseText)) {
        personalKey = RegExp.$1;
      }
    };
    xhr.send(null);
  }
} 