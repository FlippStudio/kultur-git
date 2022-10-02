$(document).ready(function () {
  checkFont();

  $("#increase-font img, #increase-font2 img").on(
    "click keypress",
    function (e) {
      if ($("body").css("fontSize") == "16px") {
        $("body").css("fontSize", "112.5%");
        $.removeCookie("fontsize");
        $.cookie("fontsize", 2, { path: "/" });
      } else if ($("body").css("fontSize") == "14px") {
        $("body").css("fontSize", "100%");
        $.cookie("fontsize", 1);
      }
    }
  );

  $("#descrease-font img, #descrease-font2 img").on(
    "click keypress",
    function (e) {
      if ($("body").css("fontSize") == "16px") {
        $("body").css("fontSize", "87.5%");
        $.removeCookie("fontsize");
        $.cookie("fontsize", 0, { path: "/" });
      } else if ($("body").css("fontSize") == "18px") {
        $("body").css("fontSize", "100%");
        $.removeCookie("fontsize");
        $.cookie("fontsize", 1, { path: "/" });
      }
    }
  );

  function checkFont() {
    if ($.cookie("fontsize") != null) {
      if ($.cookie("fontsize") == 2) $("body").css("fontSize", "112.5%");
      else if ($.cookie("fontsize") == 0) $("body").css("fontSize", "87.5%");
      else $("body").css("fontSize", "100%");
    }
  }
});
