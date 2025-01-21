<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>video Stream</title>
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('agoraVideo/main.css')}}">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" crossorigin="anonymous"></script>
</head>
<body>
@if(!session()->has('meeting'))
    <input type="text" id="linkname" value="">
@endif
<input type="text" id="linkUrl" value="{{url('joinMeeting')}}/{{$meeting->url}}">
<button id="join-btn" style="display: none;"></button>
<button id="join-btn2" onclick="showUserName()">Join Stream</button>
<button id="join-btns" onclick="copyLink()">Copy link</button>

<!-- Meeting Instance -->
<div id="stream-wrapper" style="height: 100%; display:block">
    <div id="video-streams"></div>

    <!-- User Name Display -->
    <div id="user-name" class="absolute top-0 right-0 m-4 p-2 bg-gray-800 text-white rounded" style="display: none;">
        <strong>{{ Auth::user()->name }}</strong>
    </div>

    <div id="stream-controls">
        <button id="leave-btn" onclick="hideUserName()">Leave Stream</button>
        <button id="mic-btn">Mic On</button>
        <button id="camera-btn">Camera on</button>
    </div>
</div>
<input id="appid" type="hidden" value="{{$meeting->app_id}}" readonly>
<input id="token" type="hidden" value="{{$meeting->token}}" readonly>
<input id="channel" type="hidden" value="{{$meeting->channel}}" readonly>
<input id="urlId" type="hidden" value="{{$meeting->url}}" readonly>
<input id="event" type="hidden" value="{{$event}}" readonly>

<style>
    #user-name {
        position: absolute;
        top: 50px;
        left: 50px;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
        font-size: 1.2em;
    }
</style>

<input id="timer" type="hidden" value="0">
<input id="user_meeting" type="hidden" value="0">
<input id="user_permission" type="hidden" value="0">

<script>
    function showUserName() {
        document.getElementById('user-name').style.display = 'block';
    }

    function hideUserName() {
        document.getElementById('user-name').style.display = 'none';
    }
</script>

@if(session()->has('meeting'))
<table class="table" id="dataTable2">
<thead>
    <tr>
        <th scope="col">S.no</th>
        <th scope="col">Name</th>
        <th scope="col">Meeting Url</th>
        <th scope="col">Start time</th>
        <th scope="col">End time</th>
    </tr>
</thead>
<tbody>
    <?php $i=1; ?>
    @foreach($users as $list)
    <tr>
        <th scope="row">{{$i++}}</th>
        <td>{{$list->name}}</td>
        <td>{{$list->email}}</td>
        <td> <a href="javascript:void(0)" onclick="sendMailNotification('{{$list->email}}')"> Send Notification</a></td>
       
    </tr>
    @endforeach
</tbody>
</table>
@endif
</body>

<script src="{{asset('agoraVideo/AgoraRTC_N-4.23.0.js')}}" ></script>
<script src="{{asset('agoraVideo/main.js')}}" ></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
function sendMailNotification(email)
{
 var url = "{{url('sendMailNotification')}}";
   var urlId = $('#urlId').val();
$.ajax({
  url : url,
  headers:{
    'X-CSRF-TOKEN':'{{csrf_token()}}'
  },
  data:{
    'email' : email,
     'url' : urlId,
  },
  type:'post',
  success:function (result){

  }
})
}


// Pusher web socket initialise
var notificationChannel = $('#channel').val();
var notificationEvent =    $('#event').val();
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('42c0604558adc6eaf167', {
  cluster: 'ap1'
});

var channel = pusher.subscribe(notificationChannel);
channel.bind(notificationEvent, function(data) {
  @if(session()->has('meeting'))
   // Host User
    if(confirm(data.data.title)){
      meetingApprove(data.data.random_user , 2);
    }else{
      meetingApprove(data.data.random_user , 3);
    }
  @else
   // Join User
    if(data.data.status == 2){
      // Meeting start
      $('#join-btn').click();
      document.getElementById('stream-controls').style.display='flex';
      $('#timer').val(1);
    }else if(data.data.status == 3){
      // Meeting entry denied by host
      alert('Host has been deneid your entry');
    }
  @endif
});
</script>

<script>

function copyLink()
{
  var urlPage = window.location.href;
  var temp = $("<input>");
  $("body").append(temp);
  temp.val(urlPage).select();
  document.execCommand("copy");
  temp.remove();
  $('#join-btns').text('URL Copied');
}


$('#join-btn2').click(function(){
  // Host User
    @if(session()->has('meeting'))
    $('#join-btn').click();
    document.getElementById('stream-controls').style.display='flex';
    @else
    // Join User
    var name = $('#linkname').val();
    if(name == '' || length.name <1){
      alert("Enter your name");
      return;
    }else{
      saveUserName(name);
      alert('Request has been sent to Host please wait');
    }
    @endif
})

function saveUserName(name){
  var url = "{{url('saveUserName')}}"
  var random = "{{session()->get('random_user')}}" ;
  var urlId = $('#urlId').val();
  $.ajax({
    url : url,
    headers:{
      'X-CSRF-TOKEN':'{{csrf_token()}}'
    },
    data:{
      'url' : urlId,
      'name':name,
      'random':random
    },
    type:'post',
    success:function (result){

    }
  })
}

function meetingApprove(random_user ,type)
{
  var url = "{{url('meetingApprove')}}"
  var urlId = $('#urlId').val();
  $.ajax({
    url : url,
    headers:{
      'X-CSRF-TOKEN':'{{csrf_token()}}'
    },
    data:{
      'url' : urlId,
      'type':type,
      'random':random_user
    },
    type:'post',
    success:function (result){

    }
  })
}

@if(!session()->has('meeting'))

window.setInterval(function(){
  callRecordTime();
},10000)

function callRecordTime()
{
  var timer = $('#timer').val();
  if(timer == 1){
    var url = "{{url('callRecordTime')}}";
    var random = "{{session()->get('random_user')}}" ;
  var urlId = $('#urlId').val();
  $.ajax({
    url : url,
    headers:{
      'X-CSRF-TOKEN':'{{csrf_token()}}'
    },
    data:{
      'url' : urlId,
      'random':random
    },
    type:'post',
    success:function (result){

    }
  })
  }
}
@endif
</script>
</html>