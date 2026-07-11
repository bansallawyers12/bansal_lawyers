"use strict";

$(window).on("load", function () {
  $(".loader").fadeOut("slow");
});

if (typeof window.refreshLucideIcons === 'function') {
  window.refreshLucideIcons();
}
// Global
document.addEventListener('DOMContentLoaded', function () {
  let now_layout_class = null;

  // Sticky Kit removed - layout-2 class not used, replaced with CSS position: sticky
  // var sidebar_sticky = function () {
  //   if ($("body").hasClass("layout-2")) {
  //     $("body.layout-2 #sidebar-wrapper").stick_in_parent({
  //       parent: $("body")
  //     });
  //     $("body.layout-2 #sidebar-wrapper").stick_in_parent({ recalc_every: 1 });
  //   }
  // };
  // sidebar_sticky();

  var sidebar_dropdown = function () {
    if ($(".main-sidebar").length) {
      $(".main-sidebar .sidebar-menu li a.has-dropdown")
        .off("click")
        .on("click", function () {
          var me = $(this);

          me.parent()
            .find("> .dropdown-menu")
            .slideToggle(500, function () {
              return false;
            });
          return false;
        });
    }
  };
  sidebar_dropdown();

  if ($("#top-5-scroll").length) {
    $("#top-5-scroll").css({ height: 315 });
  }
  if ($("#scroll-new").length) {
    $("#scroll-new").css({ height: 200 });
  }

  $(".main-content").css({
    minHeight: $(window).outerHeight() - 95
  });

  $(".nav-collapse-toggle").click(function () {
    $(this)
      .parent()
      .find(".navbar-nav")
      .toggleClass("show");
    return false;
  });
  $(document).on("click", function (e) {
    // Only remove show class from custom nav-collapse, not Bootstrap navbar
    if (!$(e.target).closest('.navbar').length) {
      $(".nav-collapse:not(.navbar-collapse) .navbar-nav").removeClass("show");
    }
  });

  var toggle_sidebar_mini = function (mini) {
    let body = $("body");

    if (!mini) {
      body.removeClass("sidebar-mini");
      $(".main-sidebar").css({
        overflow: "hidden"
      });
      $(".main-sidebar .sidebar-menu > li > ul .dropdown-title").remove();
      $(".main-sidebar .sidebar-menu > li > a").removeAttr("data-toggle");
      $(".main-sidebar .sidebar-menu > li > a").removeAttr(
        "data-original-title"
      );
      $(".main-sidebar .sidebar-menu > li > a").removeAttr("title");
    } else {
      body.addClass("sidebar-mini");
      body.removeClass("sidebar-show");
      $(".main-sidebar .sidebar-menu > li").each(function () {
        let me = $(this);

        if (me.find("> .dropdown-menu").length) {
          me.find("> .dropdown-menu").hide();
          me.find("> .dropdown-menu").prepend(
            '<li class="dropdown-title pt-3">' + me.find("> a").text() + "</li>"
          );
        } else {
          me.find("> a").attr("data-toggle", "tooltip");
          me.find("> a").attr("data-original-title", me.find("> a").text());
          $("[data-toggle='tooltip']").tooltip({
            placement: "right"
          });
        }
      });
    }
  };

  // sticky header toggle function
  var toggle_sticky_header = function (sticky) {
    if (!sticky) {
      $(".main-navbar")[0].classList.remove("sticky");
    } else {
      $(".main-navbar")[0].classList += " sticky";
    }
  };

  $('.menu-toggle').on('click', function (e) {
    var $this = $(this);
    $this.toggleClass('toggled');

  });

  $.each($('.main-sidebar .sidebar-menu li.active'), function (i, val) {
    var $activeAnchors = $(val).find('a:eq(0)');

    $activeAnchors.addClass('toggled');
    $activeAnchors.next().show();
  });

  $("[data-toggle='sidebar']").click(function (e) {
    e.preventDefault();

    var body = $("body"),
      w = $(window),
      modernSidebar = $(".modern-sidebar");

    if (modernSidebar.length) {
      return false;
    }

    if (w.outerWidth() <= 1024) {
      body.removeClass("search-show search-gone");
      if (body.hasClass("sidebar-gone")) {
        body.removeClass("sidebar-gone");
        body.addClass("sidebar-show");
      } else {
        body.addClass("sidebar-gone");
        body.removeClass("sidebar-show");
      }
    } else {
      body.removeClass("search-show search-gone");
      if (body.hasClass("sidebar-mini")) {
        toggle_sidebar_mini(false);
      } else {
        toggle_sidebar_mini(true);
      }
    }

    return false;
  });

  var toggleLayout = function () {
    var w = $(window),
      layout_class = $("body").attr("class") || "",
      layout_classes =
        layout_class.trim().length > 0 ? layout_class.split(" ") : "";

    if (layout_classes.length > 0) {
      layout_classes.forEach(function (item) {
        if (item.indexOf("layout-") != -1) {
          now_layout_class = item;
        }
      });
    }

    if (w.outerWidth() <= 1024) {
      if ($("body").hasClass("sidebar-mini")) {
        toggle_sidebar_mini(false);
      }

      $("body").addClass("sidebar-gone");
      $("body").removeClass("layout-2 layout-3 sidebar-mini sidebar-show");
      $("body")
        .off("click")
        .on("click", function (e) {
          if (
            $(e.target).hasClass("sidebar-show") ||
            $(e.target).hasClass("search-show")
          ) {
            $("body").removeClass("sidebar-show");
            $("body").addClass("sidebar-gone");
            $("body").removeClass("search-show");
          }
        });

      if (now_layout_class == "layout-3") {
        let nav_second_classes = $(".navbar-secondary").attr("class"),
          nav_second = $(".navbar-secondary");

        nav_second.attr("data-nav-classes", nav_second_classes);
        nav_second.removeAttr("class");
        nav_second.addClass("main-sidebar");

        let main_sidebar = $(".main-sidebar");
        main_sidebar
          .find(".container")
          .addClass("sidebar-wrapper")
          .removeClass("container");
        main_sidebar
          .find(".navbar-nav")
          .addClass("sidebar-menu")
          .removeClass("navbar-nav");
        main_sidebar.find(".sidebar-menu .nav-item.dropdown.show a").click();
        main_sidebar.find(".sidebar-brand").remove();
        main_sidebar.find(".sidebar-menu").before(
          $("<div>", {
            class: "sidebar-brand"
          }).append(
            $("<a>", {
              href: $(".navbar-brand").attr("href")
            }).html($(".navbar-brand").html())
          )
        );
        sidebar_dropdown();
        $(".main-wrapper").removeClass("container");
      }
    } else {
      $("body").removeClass("sidebar-gone sidebar-show");
      if (now_layout_class) $("body").addClass(now_layout_class);

      let nav_second_classes = $(".main-sidebar").attr("data-nav-classes"),
        nav_second = $(".main-sidebar");

      if (
        now_layout_class == "layout-3" &&
        nav_second.hasClass("main-sidebar")
      ) {
        nav_second.find(".sidebar-menu li a.has-dropdown").off("click");
        nav_second.find(".sidebar-brand").remove();
        nav_second.removeAttr("class");
        nav_second.addClass(nav_second_classes);

        let main_sidebar = $(".navbar-secondary");
        main_sidebar
          .find(".sidebar-wrapper")
          .addClass("container")
          .removeClass("sidebar-wrapper");
        main_sidebar
          .find(".sidebar-menu")
          .addClass("navbar-nav")
          .removeClass("sidebar-menu");
        main_sidebar.find(".dropdown-menu").hide();
        main_sidebar.removeAttr("style");
        main_sidebar.removeAttr("tabindex");
        main_sidebar.removeAttr("data-nav-classes");
        $(".main-wrapper").addClass("container");
      } else if (now_layout_class == "layout-2") {
        $("body").addClass("layout-2");
      }
    }
  };
  toggleLayout();
  $(window).resize(toggleLayout);

  $("[data-toggle='search']").click(function () {
    var body = $("body");

    if (body.hasClass("search-gone")) {
      body.addClass("search-gone");
      body.removeClass("search-show");
    } else {
      body.removeClass("search-gone");
      body.addClass("search-show");
    }
  });

  // tooltip
  $("[data-toggle='tooltip']").tooltip();

  // popover
  $('[data-toggle="popover"]').popover({
    container: "body"
  });

  // Tom Select for .js-tom-select elements
  function initLegacyTomSelects(attempt) {
    if (typeof window.TomSelect === 'undefined' || typeof window.initTomSelect !== 'function') {
      if ((attempt || 0) < 40) {
        setTimeout(function() { initLegacyTomSelects((attempt || 0) + 1); }, 50);
      }
      return;
    }

    document.querySelectorAll('.js-tom-select').forEach(function(select) {
      if (!select.tomselect) {
        window.initTomSelect(select, {
          placeholder: 'Select an option',
          allowEmptyOption: true
        });
      }
    });
  }
  initLegacyTomSelects(0);

  $(".notification-toggle").dropdown();
  $(".message-toggle").dropdown();

  // Dismiss function
  $("[data-dismiss]").each(function () {
    var me = $(this),
      target = me.data("dismiss");

    me.click(function () {
      $(target).fadeOut(function () {
        $(target).remove();
      });
      return false;
    });
  });

  // Collapsable
  $("[data-collapse]").each(function () {
    var me = $(this),
      target = me.data("collapse");

    me.click(function () {
      $(target).collapse("toggle");
      $(target).on("shown.bs.collapse", function () {
        me.html('<i data-lucide="minus"></i>');
      });
      $(target).on("hidden.bs.collapse", function () {
        me.html('<i data-lucide="plus"></i>');
      });
      return false;
    });
  });

  // Background
  $("[data-background]").each(function () {
    var me = $(this);
    me.css({
      backgroundImage: "url(" + me.data("background") + ")"
    });
  });

  // Custom Tab
  $("[data-tab]").each(function () {
    var me = $(this);

    me.click(function () {
      if (!me.hasClass("active")) {
        var tab_group = $('[data-tab-group="' + me.data("tab") + '"]'),
          tab_group_active = $(
            '[data-tab-group="' + me.data("tab") + '"].active'
          ),
          target = $(me.attr("href")),
          links = $('[data-tab="' + me.data("tab") + '"]');

        links.removeClass("active");
        me.addClass("active");
        target.addClass("active");
        tab_group_active.removeClass("active");
      }
      return false;
    });
  });

  // Bootstrap 4 Validation
  $(".needs-validation").submit(function () {
    var form = $(this);
    if (form[0].checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    }
    form.addClass("was-validated");
  });

  // alert dismissible
  $(".alert-dismissible").each(function () {
    var me = $(this);

    me.find(".close").click(function () {
      me.alert("close");
    });
  });

  if ($(".main-navbar").length) {
  }

  // Image cropper
  $("[data-crop-image]").each(function (e) {
    $(this).css({
      overflow: "hidden",
      position: "relative",
      height: $(this).data("crop-image")
    });
  });

  // Slide Toggle
  $("[data-toggle-slide]").click(function () {
    let target = $(this).data("toggle-slide");

    $(target).slideToggle();
    return false;
  });

  // Dismiss modal
  $("[data-dismiss=modal]").click(function () {
    $(this)
      .closest(".modal")
      .modal("hide");

    return false;
  });

  // Width attribute
  $("[data-width]").each(function () {
    $(this).css({
      width: $(this).data("width")
    });
  });

  // Height attribute
  $("[data-height]").each(function () {
    $(this).css({
      height: $(this).data("height")
    });
  });

  // Sortable card
  if ($(".sortable-card").length && jQuery().sortable) {
    $(".sortable-card").sortable({
      handle: ".card-header",
      opacity: 0.8,
      tolerance: "pointer"
    });
  }

  // Date/time inputs — Flatpickr (replaces Moment + daterangepicker + bootstrap-timepicker)
  if (typeof window.initAdminFlatpickr === 'function') {
    window.initAdminFlatpickr();
  }

  $("#mini_sidebar_setting").on("change", function () {
    var _val = $(this).is(":checked") ? "checked" : "unchecked";
    if (_val === "checked") {
      toggle_sidebar_mini(true);
    } else {
      toggle_sidebar_mini(false);
    }
  });
  $("#sticky_header_setting").on("change", function () {
    if ($(".main-navbar")[0].classList.contains("sticky")) {
      toggle_sticky_header(false);
    } else {
      toggle_sticky_header(true);
    }
  });

  $(".theme-setting-toggle").on("click", function () {
    if ($(".theme-setting")[0].classList.contains("active")) {
      $(".theme-setting")[0].classList.remove("active");
    } else {
      $(".theme-setting")[0].classList += " active";
    }
  });

  // full screen call

  $(document).on("click", ".fullscreen-btn", function (e) {
    if (
      !document.fullscreenElement && // alternative standard method
      !document.mozFullScreenElement &&
      !document.webkitFullscreenElement &&
      !document.msFullscreenElement
    ) {
      // current working methods
      if (document.documentElement.requestFullscreen) {
        document.documentElement.requestFullscreen();
      } else if (document.documentElement.msRequestFullscreen) {
        document.documentElement.msRequestFullscreen();
      } else if (document.documentElement.mozRequestFullScreen) {
        document.documentElement.mozRequestFullScreen();
      } else if (document.documentElement.webkitRequestFullscreen) {
        document.documentElement.webkitRequestFullscreen(
          Element.ALLOW_KEYBOARD_INPUT
        );
      }
    } else {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
      } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
      }
    }
  });

  // setting sidebar

  $(".settingPanelToggle").on("click", function () {
    $(".settingSidebar").toggleClass("showSettingPanel");
  }),
    $(".page-wrapper").on("click", function () {
      $(".settingSidebar").removeClass("showSettingPanel");
    });

  // close right sidebar when click outside
  var mouse_is_inside = false;
  $(".settingSidebar").hover(
    function () {
      mouse_is_inside = true;
    },
    function () {
      mouse_is_inside = false;
    }
  );

  $("body").mouseup(function () {
    if (!mouse_is_inside) $(".settingSidebar").removeClass("showSettingPanel");
  });

  // theme change event
  $(".choose-theme li").on("click", function () {
    var bodytag = $("body"),
      selectedTheme = $(this),
      prevTheme = $(".choose-theme li.active").attr("title");

    $(".choose-theme li").removeClass("active"),
      selectedTheme.addClass("active");
    $(".choose-theme li.active").data("theme");

    bodytag.removeClass("theme-" + prevTheme);
    bodytag.addClass("theme-" + $(this).attr("title"));
  });

  // dark light sidebar button setting
  $(".sidebar-color input:radio").change(function () {
    if ($(this).val() == "1") {
      $("body").removeClass("dark-sidebar");
      $("body").addClass("light-sidebar");
    } else {
      $("body").removeClass("light-sidebar");
      $("body").addClass("dark-sidebar");
    }
  });

  // dark light layout button setting
  $(".layout-color input:radio").change(function () {
    if ($(this).val() == "1") {
      $("body").removeClass();
      $("body").addClass("light");
      $("body").addClass("light-sidebar");
      $("body").addClass("theme-white");

      $(".choose-theme li").removeClass("active");
      $(".choose-theme li[title|='white']").addClass("active");
      $(".selectgroup-input[value|='1']").prop("checked", true);
    } else {
      $("body").removeClass();
      $("body").addClass("dark");
      $("body").addClass("dark-sidebar");
      $("body").addClass("theme-black");

      $(".choose-theme li").removeClass("active");
      $(".choose-theme li[title|='black']").addClass("active");
      $(".selectgroup-input[value|='2']").prop("checked", true);
    }
  });

  // restore default to dark theme
  $(".btn-restore-theme").on("click", function () {
    //remove all class from body
    $("body").removeClass();
    jQuery("body").addClass("light");
    jQuery("body").addClass("light-sidebar");
    jQuery("body").addClass("theme-white");

    // set default theme
    $(".choose-theme li").removeClass("active");
    $(".choose-theme li[title|='white']").addClass("active");

    $(".select-layout[value|='1']").prop("checked", true);
    $(".select-sidebar[value|='2']").prop("checked", true);
    toggle_sidebar_mini(false);
    $("#mini_sidebar_setting").prop("checked", false);
    $("#sticky_header_setting").prop("checked", true);
    toggle_sticky_header(true);
  });

  //start up class add

  //add default class on body tag
  jQuery("body").addClass("light");
  jQuery("body").addClass("light-sidebar");
  jQuery("body").addClass("theme-white");
  // set theme default color
  $(".choose-theme li").removeClass("active");
  $(".choose-theme li[title|='white']").addClass("active");
  //set default dark or light layout(1=light, 2=dark)
  $(".select-layout[value|='1']").prop("checked", true);
  //set default dark or light sidebar(1=light, 2=dark)
  $(".select-sidebar[value|='1']").prop("checked", true);
  // sticky header default set to true
  $("#sticky_header_setting").prop("checked", true);
});
