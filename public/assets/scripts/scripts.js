function roomExists(room) {
	var ref = firebase.database().ref(room);

}

function makeid() {
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	for (var i = 0; i < 10; i++)
	text += possible.charAt(Math.floor(Math.random() * possible.length));

	return text;
}


 window.setDate = function() {
    var d, timestamp;
    timestamp = $("<div>").addClass("timestamp");
    d = new Date();
    timestamp.text(d.getHours() + ":" + (d.getMinutes() < 10 ? '0' : '') + d.getMinutes());
    return timestamp.appendTo($('.message:last'));
  };

  window.updateScrollbar = function() {
    return messages.mCustomScrollbar("update").mCustomScrollbar('scrollTo', 'bottom', {
      scrollInertia: 10,
      timeout: 0
    });
  };


function addMessage(msg, name) {
	var table = document.getElementById('displayTable');
	var rowNum = table.rows.length;
	var row = table.insertRow(rowNum);

	var time = setDate();

	var msgCell = row.insertCell(0);
	msgCell.innerHTML = '<strong>' + name + '</strong><br/>' + msg + '</br>';

	var inputField = document.getElementById('textField');
	inputField.value = "";

	
	updateScrollbar();

}

function createRoomFirebase(name) {
	var ref = firebase.database().ref(name);
	ref.set({
		start: {
			username: "ROOM",
			message: "Your room has been created."
		}
	});
	console.log("ROOM MADE");
	ref.on("child_added", function(snapshot, prevChildKey) {
		var newMsg = snapshot.val();
		console.log("Username: " + newMsg.username);
		console.log("Message: " + newMsg.message);
		console.log("Previous Message ID: " + prevChildKey);
		addMessage(newMsg.message, newMsg.username);
	});
}








document.getElementById('sendButton').addEventListener("click", function () {
	var message = document.getElementById('textField').value;
	var room = $("#roomName").text();
	var username = $("#username").text();

	var ref = firebase.database().ref(room);
	var msgId = makeid();
	ref.set({
		[msgId]: {
			username: username,
			message: message
		}
	});
	// addMessage(message, name);
});

function sendMessage (input) {
	if (event.keyCode == 13) {
		var message = document.getElementById('textField').value;
		var room = $("#roomName").text();
		console.log("Ayesh",room);
		var username = $("#username").text();

		var ref = firebase.database().ref(room);
		var msgId = makeid();
		ref.set({
			[msgId]: {
				username: username,
				message: message
			}
		});
		input.value="";
	}
}

// document.getElementById('createRoomButton').addEventListener("click", function() {
// 	$("#homeContainer").hide();
// 	$("#createRoomContainer").show();
// });

// document.getElementById('confirmRoomCreateButton').addEventListener("click", function () {
// 	var roomName = document.getElementById('createRoomNameField');
// 	var username = document.getElementById('createRoomNameUserNameField');

// 	if (roomName.value == "" || username.value == "") {
// 		alert("Empty fields!");
// 	} else {
// 		$("#createRoomContainer").hide();
// 		$("#messageContainer").show();

// 		var roomNameValue = roomName.value;
// 		var usernameValue = username.value;

// 		$("#roomName").html(roomNameValue);
// 		$("#username").html(usernameValue);

// 		createRoomFirebase(roomNameValue);
// 	}
// });

// document.getElementById('joinRoomButton').addEventListener("click", function() {
// 	// $("#homeContainer").hide();
// 	$("#joinRoomContainer").show();
// });

window.onload = function(e){ 
    console.log("window.onload", "Ayesh" ); 

	var roomName = document.getElementById('joinRoomNameField');
	var username = document.getElementById('joinRoomUserNameField');

	if (roomName.value == "" || username.value == "") {
		alert("Empty fields!");
	} else {
		$("#joinRoomContainer").hide();
		$("#messageContainer").show();

		var roomNameValue = roomName.value;
		var usernameValue = username.value;

		$("#roomName").html(roomNameValue);
		$("#username").html(usernameValue);

		var msgId = makeid();
		var ref = firebase.database().ref(roomNameValue);
		ref.set({
			[msgId]: {
				username: "IoT-Shop",
				message: usernameValue + " has joined the room."
			}
		});
		ref.on("child_added", function(snapshot, prevChildKey) {
			var newMsg = snapshot.val();
			console.log("Username: " + newMsg.username);
			console.log("Message: " + newMsg.message);
			console.log("Previous Message ID: " + prevChildKey);
			addMessage(newMsg.message, newMsg.username);
		});
	}
}
