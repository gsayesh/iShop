(function() {
  
  var fakeMsg, fakeNum, isTyping, messages, uctTimer;

  messages = $(".messages-content");

  fakeNum = 0;

  isTyping = true;

  uctTimer = null;

  window.userTypingClear = function() {
    return uctTimer = setTimeout(function() {
      $(".message.personal.typing").remove();
      return isTyping = true;
    }, 3500);
  };

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



  window.insertMessage = function() {
    var msg, msgText;
    msgText = $(".action-box-input").val();
    if ($.trim(msgText) === "") {
      return false;
    }
    msg = $("<div>").addClass("message");
    msg.text(msgText);
    msg.addClass("personal").appendTo($('.mCSB_container'));
    setDate();
    updateScrollbar();
    $(".action-box-input").val(null);
    $(".message.personal.typing").remove();
    isTyping = true;
    clearTimeout(uctTimer);
    if ($.trim(fakeMsg[fakeNum]) === "") {
      return false;
    }
    return setTimeout(function() {
      return setFakeMessage();
    }, 500 + (Math.random() * 10) * 100);
  };

  $(window).on('keydown', function(e) {
    if (e.which === 13) {
      insertMessage();
      return false;
    }
  });

  $(window).load(function() {
    messages.mCustomScrollbar();
    setTimeout(function() {
      return setFakeMessage();
    }, 100);
  });

  $(".action-box-input").on("keydown", function(e) {
    var typing;
    if ($(".action-box-input") !== "" && isTyping === true && e.which !== 13) {
      typing = $("<div>").append("<span>").addClass("message personal typing");
      typing.appendTo($('.mCSB_container'));
      updateScrollbar();
      isTyping = false;
      return userTypingClear();
    }
  });

}).call(this);