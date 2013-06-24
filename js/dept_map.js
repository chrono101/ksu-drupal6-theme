$(document).ready(function() {
  // Create qTips on each map area
  $('area').each(function() {
    $(this).qtip( {      
      content: {
        text: 'Loading...',
        title: $(this).attr('alt')
      },
      show: {
        solo: true
      },
      hide: {
        delay: 500,
        fixed: true,
      },
      style: {
        width: 200,
        padding: 5,
        background: '#f1f0eb',
        color: 'black',
        border: {
          width: 2,
          radius: 2,
          color: '#666666'
        },
      title: {
         'background-color': '#DBD9CD',
         'color': 'black',          
      },
      name: 'dark'
      },
      api: {
        beforeShow: function() {
          var self = this;
          var url = this.elements.target.attr('href')
          if (url != '' && url != '#') {
            $('#temp').load(url + ' .room-content', function(response, status, xhr){
              // A little error handling
              if(status == "error") {
                var errMsg = "Error loading room data: ";
                self.updateContent(errMsg + xhr.status + " " + xhr.statusText);
              }
              else {
                self.updateContent($('#temp').html());
              }
            });
          }
          else {
            self.updateContent('No HREF to load room data from.');
          }
        },
      }
    });
   
    // Add the current room to the "Rooms" list
    $(this).attr('href', '/room/' + $(this).attr('id'));

  var rcFloor = ($(this).attr('id').charAt($(this).attr('id').indexOf('N')+1));
  switch(rcFloor) {
    case '0':
      $('#rooms0').append("<a name=\"#" + $(this).attr('id') + "\" href=\"" + $(this).attr('href') + "\">" + $(this).attr('alt') + "</a>" + " ");
      break;
    case '1':
      $('#rooms1').append("<a name=\"#" + $(this).attr('id') + "\" href=\"" + $(this).attr('href') + "\">" + $(this).attr('alt') + "</a>" + " ");
      break;
    case '2':
      $('#rooms2').append("<a name=\"#" + $(this).attr('id') + "\" href=\"" + $(this).attr('href') + "\">" + $(this).attr('alt') + "</a>" + " ");
      break;
    case '3':
      $('#rooms3').append("<a name=\"#" + $(this).attr('id') + "\" href=\"" + $(this).attr('href') + "\">" + $(this).attr('alt') + "</a>" + " ");
      break;
    default:
      break;
  }
  });
  // Provides the highlighting; uses maphilight();  
  $('.map').maphilight();
  
  // If we have a current room specificed by the URL, show that floor and highlight that room
  var rcID = getURLParameter("rc");
  if(rcID != "#" && rcID != "") {        
    $(rcID).mouseover();
  
    var rcFloor = (rcID.charAt(rcID.indexOf("N")+1));
  
    switch(rcFloor) {
      case '0':
        showBase();
        break;
      case '1':
        showFirst();
        break;
      case '2':
        showSecond();
        break;
      case '3':
        showThird();
        break;
      default:
        showFirst();
    }
  } else {
    showFirst();
  }
  
  $('#N1').click(function() {
    showFirst();
  });
  
  $('#N2').click(function() {
    showSecond();
  });
  
  $('#N3').click(function() {
    showThird();
  });
  
  $('#N0').click(function() {
    showBase();
  });
  
  $('#NAll').click(function() {
    showAll();
  });
  
});
  
function showBase() {
  $('#floor1').hide('fast');
  $("#rooms1").hide('fast');
  $('#floor2').hide('fast');
  $("#rooms2").hide('fast');
  $('#floor3').hide('fast');
  $("#rooms3").hide('fast');
  $('#floor0').show('fast');
  $("#rooms0").show('fast');
}
  
function showFirst() {
  $('#floor1').show('fast');
  $("#rooms1").show('fast');
  $('#floor2').hide('fast');
  $("#rooms2").hide('fast');
  $('#floor3').hide('fast');
  $("#rooms3").hide('fast');
  $('#floor0').hide('fast');
  $("#rooms0").hide('fast');
}

function showSecond() {
  $('#floor1').hide('fast');
  $("#rooms1").hide('fast');
  $('#floor2').show('fast');
  $("#rooms2").show('fast');
  $('#floor3').hide('fast');
  $("#rooms3").hide('fast');
  $('#floor0').hide('fast');
  $("#rooms0").hide('fast');
}

function showThird() {
  $('#floor1').hide('fast');
  $("#rooms1").hide('fast');
  $('#floor2').hide('fast');
  $("#rooms2").hide('fast');
  $('#floor3').show('fast');
  $("#rooms3").show('fast');
  $('#floor0').hide('fast');
  $("#rooms0").hide('fast');
}

function showAll() { 
  $('#floor1').show('fast');
  $("#rooms1").show('fast');
  $('#floor2').show('fast');
  $("#rooms2").show('fast');
  $('#floor3').show('fast');
  $("#rooms3").show('fast');
  $('#floor0').show('fast');
  $("#rooms0").show('fast');
}

// Taken from: http://stackoverflow.com/questions/1403888/get-url-parameter-with-jquery
function getURLParameter(name) {
  return decodeURI(
    (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
  );
}
