/*! bootstrap-timepicker v0.2.3 
* http://jdewit.github.com/bootstrap-timepicker 
* Copyright (c) 2013 Joris de Wit 
* MIT License 
*/ (function(
  e,
  t,
  n,
  r
) {
  "use strict";
  var i = function(t, n) {
    this.widget = "";
    this.$element = e(t);
    this.defaultTime = n.defaultTime;
    this.disableFocus = n.disableFocus;
    this.isOpen = n.isOpen;
    this.minuteStep = n.minuteStep;
    this.modalBackdrop = n.modalBackdrop;
    this.secondStep = n.secondStep;
    this.showInputs = n.showInputs;
    this.showMeridian = n.showMeridian;
    this.showSeconds = n.showSeconds;
    this.template = n.template;
    this.appendWidgetTo = n.appendWidgetTo;
    this.upArrowStyle = n.upArrowStyle;
    this.downArrowStyle = n.downArrowStyle;
    this.containerClass = n.containerClass;
    this._init();
  };
  i.prototype = {
    constructor: i,
    _init: function() {
      var t = this;
      if (
        this.$element.parent().hasClass("input-append") ||
        this.$element.parent().hasClass("input-prepend")
      ) {
        if (
          this.$element.parent(".input-append, .input-prepend").find(".add-on")
            .length
        ) {
          this.$element
            .parent(".input-append, .input-prepend")
            .find(".add-on")
            .on({ "click.timepicker": e.proxy(this.showWidget, this) });
        } else {
          this.$element
            .closest(this.containerClass)
            .find(".add-on")
            .on({ "click.timepicker": e.proxy(this.showWidget, this) });
        }
        this.$element.on({
          "focus.timepicker": e.proxy(this.highlightUnit, this),
          "click.timepicker": e.proxy(this.highlightUnit, this),
          "keydown.timepicker": e.proxy(this.elementKeydown, this),
          "blur.timepicker": e.proxy(this.blurElement, this)
        });
      } else {
        if (this.template) {
          this.$element.on({
            "focus.timepicker": e.proxy(this.showWidget, this),
            "click.timepicker": e.proxy(this.showWidget, this),
            "blur.timepicker": e.proxy(this.blurElement, this)
          });
        } else {
          this.$element.on({
            "focus.timepicker": e.proxy(this.highlightUnit, this),
            "click.timepicker": e.proxy(this.highlightUnit, this),
            "keydown.timepicker": e.proxy(this.elementKeydown, this),
            "blur.timepicker": e.proxy(this.blurElement, this)
          });
        }
      }
      if (this.template !== false) {
        this.$widget = e(this.getTemplate())
          .prependTo(this.$element.parents(this.appendWidgetTo))
          .on("click", e.proxy(this.widgetClick, this));
      } else {
        this.$widget = false;
      }
      if (this.showInputs && this.$widget !== false) {
        this.$widget.find("input").each(function() {
          e(this).on({
            "click.timepicker": function() {
              e(this).select();
            },
            "keydown.timepicker": e.proxy(t.widgetKeydown, t)
          });
        });
      }
      this.setDefaultTime(this.defaultTime);
    },
    blurElement: function() {
      this.highlightedUnit = r;
      this.updateFromElementVal();
    },
    decrementHour: function() {
      if (this.showMeridian) {
        if (this.hour === 1) {
          this.hour = 12;
        } else if (this.hour === 12) {
          this.hour--;
          return this.toggleMeridian();
        } else if (this.hour === 0) {
          this.hour = 11;
          return this.toggleMeridian();
        } else {
          this.hour--;
        }
      } else {
        if (this.hour === 0) {
          this.hour = 23;
        } else {
          this.hour--;
        }
      }
      this.update();
    },
    decrementMinute: function(e) {
      var t;
      if (e) {
        t = this.minute - e;
      } else {
        t = this.minute - this.minuteStep;
      }
      if (t < 0) {
        this.decrementHour();
        this.minute = t + 60;
      } else {
        this.minute = t;
      }
      this.update();
    },
    decrementSecond: function() {
      var e = this.second - this.secondStep;
      if (e < 0) {
        this.decrementMinute(true);
        this.second = e + 60;
      } else {
        this.second = e;
      }
      this.update();
    },
    elementKeydown: function(e) {
      switch (e.keyCode) {
        case 9:
          this.updateFromElementVal();
          switch (this.highlightedUnit) {
            case "hour":
              e.preventDefault();
              this.highlightNextUnit();
              break;
            case "minute":
              if (this.showMeridian || this.showSeconds) {
                e.preventDefault();
                this.highlightNextUnit();
              }
              break;
            case "second":
              if (this.showMeridian) {
                e.preventDefault();
                this.highlightNextUnit();
              }
              break;
          }
          break;
        case 27:
          this.updateFromElementVal();
          break;
        case 37:
          e.preventDefault();
          this.highlightPrevUnit();
          this.updateFromElementVal();
          break;
        case 38:
          e.preventDefault();
          switch (this.highlightedUnit) {
            case "hour":
              this.incrementHour();
              this.highlightHour();
              break;
            case "minute":
              this.incrementMinute();
              this.highlightMinute();
              break;
            case "second":
              this.incrementSecond();
              this.highlightSecond();
              break;
            case "meridian":
              this.toggleMeridian();
              this.highlightMeridian();
              break;
          }
          break;
        case 39:
          e.preventDefault();
          this.updateFromElementVal();
          this.highlightNextUnit();
          break;
        case 40:
          e.preventDefault();
          switch (this.highlightedUnit) {
            case "hour":
              this.decrementHour();
              this.highlightHour();
              break;
            case "minute":
              this.decrementMinute();
              this.highlightMinute();
              break;
            case "second":
              this.decrementSecond();
              this.highlightSecond();
              break;
            case "meridian":
              this.toggleMeridian();
              this.highlightMeridian();
              break;
          }
          break;
      }
    },
    formatTime: function(e, t, n, r) {
      e = e < 10 ? "0" + e : e;
      t = t < 10 ? "0" + t : t;
      n = n < 10 ? "0" + n : n;
      return (
        e +
        ":" +
        t +
        (this.showSeconds ? ":" + n : "") +
        (this.showMeridian ? " " + r : "")
      );
    },
    getCursorPosition: function() {
      var e = this.$element.get(0);
      if ("selectionStart" in e) {
        return e.selectionStart;
      } else if (n.selection) {
        e.focus();
        var t = n.selection.createRange(),
          r = n.selection.createRange().text.length;
        t.moveStart("character", -e.value.length);
        return t.text.length - r;
      }
    },
    getTemplate: function() {
      var e, t, n, r, i, s;
      if (this.showInputs) {
        t =
          '<input type="text" name="hour" class="bootstrap-timepicker-hour form-control" maxlength="2"/>';
        n =
          '<input type="text" name="minute" class="bootstrap-timepicker-minute form-control" maxlength="2"/>';
        r =
          '<input type="text" name="second" class="bootstrap-timepicker-second form-control" maxlength="2"/>';
        i =
          '<input type="text" name="meridian" class="bootstrap-timepicker-meridian form-control" maxlength="2"/>';
      } else {
        t = '<span class="bootstrap-timepicker-hour"></span>';
        n = '<span class="bootstrap-timepicker-minute"></span>';
        r = '<span class="bootstrap-timepicker-second"></span>';
        i = '<span class="bootstrap-timepicker-meridian"></span>';
      }
      s =
        "<table>" +
        "<tr>" +
        '<td><a href="#" data-action="incrementHour"><i class="' +
        this.upArrowStyle +
        '"></i></a></td>' +
        '<td class="separator">&nbsp;</td>' +
        '<td><a href="#" data-action="incrementMinute"><i class="' +
        this.upArrowStyle +
        '"></i></a></td>' +
        (this.showSeconds
          ? '<td class="separator">&nbsp;</td>' +
            '<td><a href="#" data-action="incrementSecond"><i class="' +
            this.upArrowStyle +
            '"></i></a></td>'
          : "") +
        (this.showMeridian
          ? '<td class="separator">&nbsp;</td>' +
            '<td class="meridian-column"><a href="#" data-action="toggleMeridian"><i class="' +
            this.upArrowStyle +
            '"></i></a></td>'
          : "") +
        "</tr>" +
        "<tr>" +
        "<td>" +
        t +
        "</td> " +
        '<td class="separator">:</td>' +
        "<td>" +
        n +
        "</td> " +
        (this.showSeconds
          ? '<td class="separator">:</td>' + "<td>" + r + "</td>"
          : "") +
        (this.showMeridian
          ? '<td class="separator">&nbsp;</td>' + "<td>" + i + "</td>"
          : "") +
        "</tr>" +
        "<tr>" +
        '<td><a href="#" data-action="decrementHour"><i class="' +
        this.downArrowStyle +
        '"></i></a></td>' +
        '<td class="separator"></td>' +
        '<td><a href="#" data-action="decrementMinute"><i class="' +
        this.downArrowStyle +
        '"></i></a></td>' +
        (this.showSeconds
          ? '<td class="separator">&nbsp;</td>' +
            '<td><a href="#" data-action="decrementSecond"><i class="' +
            this.downArrowStyle +
            '"></i></a></td>'
          : "") +
        (this.showMeridian
          ? '<td class="separator">&nbsp;</td>' +
            '<td><a href="#" data-action="toggleMeridian"><i class="' +
            this.downArrowStyle +
            '"></i></a></td>'
          : "") +
        "</tr>" +
        "</table>";
      switch (this.template) {
        case "modal":
          e =
            '<div class="bootstrap-timepicker-widget modal hide fade in" data-backdrop="' +
            (this.modalBackdrop ? "true" : "false") +
            '">' +
            '<div class="modal-header">' +
            '<a href="#" class="close" data-dismiss="modal">×</a>' +
            "<h3>Pick a Time</h3>" +
            "</div>" +
            '<div class="modal-content">' +
            s +
            "</div>" +
            '<div class="modal-footer">' +
            '<a href="#" class="btn btn-primary" data-dismiss="modal">OK</a>' +
            "</div>" +
            "</div>";
          break;
        case "dropdown":
          e =
            '<div class="bootstrap-timepicker-widget dropdown-menu">' +
            s +
            "</div>";
          break;
      }
      return e;
    },
    getTime: function() {
      return this.formatTime(
        this.hour,
        this.minute,
        this.second,
        this.meridian
      );
    },
    hideWidget: function() {
      if (this.isOpen === false) {
        return;
      }
      if (this.showInputs) {
        this.updateFromWidgetInputs();
      }
      this.$element.trigger({
        type: "hide.timepicker",
        time: {
          value: this.getTime(),
          hours: this.hour,
          minutes: this.minute,
          seconds: this.second,
          meridian: this.meridian
        }
      });
      if (this.template === "modal" && this.$widget.modal) {
        this.$widget.modal("hide");
      } else {
        this.$widget.removeClass("open");
      }
      e(n).off("mousedown.timepicker");
      this.isOpen = false;
    },
    highlightUnit: function() {
      this.position = this.getCursorPosition();
      if (this.position >= 0 && this.position <= 2) {
        this.highlightHour();
      } else if (this.position >= 3 && this.position <= 5) {
        this.highlightMinute();
      } else if (this.position >= 6 && this.position <= 8) {
        if (this.showSeconds) {
          this.highlightSecond();
        } else {
          this.highlightMeridian();
        }
      } else if (this.position >= 9 && this.position <= 11) {
        this.highlightMeridian();
      }
    },
    highlightNextUnit: function() {
      switch (this.highlightedUnit) {
        case "hour":
          this.highlightMinute();
          break;
        case "minute":
          if (this.showSeconds) {
            this.highlightSecond();
          } else if (this.showMeridian) {
            this.highlightMeridian();
          } else {
            this.highlightHour();
          }
          break;
        case "second":
          if (this.showMeridian) {
            this.highlightMeridian();
          } else {
            this.highlightHour();
          }
          break;
        case "meridian":
          this.highlightHour();
          break;
      }
    },
    highlightPrevUnit: function() {
      switch (this.highlightedUnit) {
        case "hour":
          this.highlightMeridian();
          break;
        case "minute":
          this.highlightHour();
          break;
        case "second":
          this.highlightMinute();
          break;
        case "meridian":
          if (this.showSeconds) {
            this.highlightSecond();
          } else {
            this.highlightMinute();
          }
          break;
      }
    },
    highlightHour: function() {
      var e = this.$element.get(0);
      this.highlightedUnit = "hour";
      if (e.setSelectionRange) {
        setTimeout(function() {
          e.setSelectionRange(0, 2);
        }, 0);
      }
    },
    highlightMinute: function() {
      var e = this.$element.get(0);
      this.highlightedUnit = "minute";
      if (e.setSelectionRange) {
        setTimeout(function() {
          e.setSelectionRange(3, 5);
        }, 0);
      }
    },
    highlightSecond: function() {
      var e = this.$element.get(0);
      this.highlightedUnit = "second";
      if (e.setSelectionRange) {
        setTimeout(function() {
          e.setSelectionRange(6, 8);
        }, 0);
      }
    },
    highlightMeridian: function() {
      var e = this.$element.get(0);
      this.highlightedUnit = "meridian";
      if (e.setSelectionRange) {
        if (this.showSeconds) {
          setTimeout(function() {
            e.setSelectionRange(9, 11);
          }, 0);
        } else {
          setTimeout(function() {
            e.setSelectionRange(6, 8);
          }, 0);
        }
      }
    },
    incrementHour: function() {
      if (this.showMeridian) {
        if (this.hour === 11) {
          this.hour++;
          return this.toggleMeridian();
        } else if (this.hour === 12) {
          this.hour = 0;
        }
      }
      if (this.hour === 23) {
        this.hour = 0;
        return;
      }
      this.hour++;
      this.update();
    },
    incrementMinute: function(e) {
      var t;
      if (e) {
        t = this.minute + e;
      } else {
        t = this.minute + this.minuteStep - (this.minute % this.minuteStep);
      }
      if (t > 59) {
        this.incrementHour();
        this.minute = t - 60;
      } else {
        this.minute = t;
      }
      this.update();
    },
    incrementSecond: function() {
      var e = this.second + this.secondStep - (this.second % this.secondStep);
      if (e > 59) {
        this.incrementMinute(true);
        this.second = e - 60;
      } else {
        this.second = e;
      }
      this.update();
    },
    remove: function() {
      e("document").off(".timepicker");
      if (this.$widget) {
        this.$widget.remove();
      }
      delete this.$element.data().timepicker;
    },
    setDefaultTime: function(e) {
      if (!this.$element.val()) {
        if (e === "current") {
          var t = new Date(),
            n = t.getHours(),
            r = Math.floor(t.getMinutes() / this.minuteStep) * this.minuteStep,
            i = Math.floor(t.getSeconds() / this.secondStep) * this.secondStep,
            s = "AM";
          if (this.showMeridian) {
            if (n === 0) {
              n = 12;
            } else if (n >= 12) {
              if (n > 12) {
                n = n - 12;
              }
              s = "PM";
            } else {
              s = "AM";
            }
          }
          this.hour = n;
          this.minute = r;
          this.second = i;
          this.meridian = s;
          this.update();
        } else if (e === false) {
          this.hour = 0;
          this.minute = 0;
          this.second = 0;
          this.meridian = "AM";
        } else {
          this.setTime(e);
        }
      } else {
        this.updateFromElementVal();
      }
    },
    setTime: function(e) {
      var t, n;
      if (this.showMeridian) {
        t = e.split(" ");
        n = t[0].split(":");
        this.meridian = t[1];
      } else {
        n = e.split(":");
      }
      this.hour = parseInt(n[0], 10);
      this.minute = parseInt(n[1], 10);
      this.second = parseInt(n[2], 10);
      if (isNaN(this.hour)) {
        this.hour = 0;
      }
      if (isNaN(this.minute)) {
        this.minute = 0;
      }
      if (this.showMeridian) {
        if (this.hour > 12) {
          this.hour = 12;
        } else if (this.hour < 1) {
          this.hour = 12;
        }
        if (this.meridian === "am" || this.meridian === "a") {
          this.meridian = "AM";
        } else if (this.meridian === "pm" || this.meridian === "p") {
          this.meridian = "PM";
        }
        if (this.meridian !== "AM" && this.meridian !== "PM") {
          this.meridian = "AM";
        }
      } else {
        if (this.hour >= 24) {
          this.hour = 23;
        } else if (this.hour < 0) {
          this.hour = 0;
        }
      }
      if (this.minute < 0) {
        this.minute = 0;
      } else if (this.minute >= 60) {
        this.minute = 59;
      }
      if (this.showSeconds) {
        if (isNaN(this.second)) {
          this.second = 0;
        } else if (this.second < 0) {
          this.second = 0;
        } else if (this.second >= 60) {
          this.second = 59;
        }
      }
      this.update();
    },
    showWidget: function() {
      if (this.isOpen) {
        return;
      }
      if (this.$element.is(":disabled")) {
        return;
      }
      var t = this;
      e(n).on("mousedown.timepicker", function(n) {
        if (e(n.target).closest(".bootstrap-timepicker-widget").length === 0) {
          t.hideWidget();
        }
      });
      this.$element.trigger({
        type: "show.timepicker",
        time: {
          value: this.getTime(),
          hours: this.hour,
          minutes: this.minute,
          seconds: this.second,
          meridian: this.meridian
        }
      });
      if (this.disableFocus) {
        this.$element.blur();
      }
      this.updateFromElementVal();
      if (this.template === "modal" && this.$widget.modal) {
        this.$widget.modal("show").on("hidden", e.proxy(this.hideWidget, this));
      } else {
        if (this.isOpen === false) {
          this.$widget.addClass("open");
        }
      }
      this.isOpen = true;
    },
    toggleMeridian: function() {
      this.meridian = this.meridian === "AM" ? "PM" : "AM";
      this.update();
    },
    update: function() {
      this.$element.trigger({
        type: "changeTime.timepicker",
        time: {
          value: this.getTime(),
          hours: this.hour,
          minutes: this.minute,
          seconds: this.second,
          meridian: this.meridian
        }
      });
      this.updateElement();
      this.updateWidget();
    },
    updateElement: function() {
      this.$element.val(this.getTime()).change();
    },
    updateFromElementVal: function() {
      var e = this.$element.val();
      if (e) {
        this.setTime(e);
      }
    },
    updateWidget: function() {
      if (this.$widget === false) {
        return;
      }
      var e = this.hour < 10 ? "0" + this.hour : this.hour,
        t = this.minute < 10 ? "0" + this.minute : this.minute,
        n = this.second < 10 ? "0" + this.second : this.second;
      if (this.showInputs) {
        this.$widget.find("input.bootstrap-timepicker-hour").val(e);
        this.$widget.find("input.bootstrap-timepicker-minute").val(t);
        if (this.showSeconds) {
          this.$widget.find("input.bootstrap-timepicker-second").val(n);
        }
        if (this.showMeridian) {
          this.$widget
            .find("input.bootstrap-timepicker-meridian")
            .val(this.meridian);
        }
      } else {
        this.$widget.find("span.bootstrap-timepicker-hour").text(e);
        this.$widget.find("span.bootstrap-timepicker-minute").text(t);
        if (this.showSeconds) {
          this.$widget.find("span.bootstrap-timepicker-second").text(n);
        }
        if (this.showMeridian) {
          this.$widget
            .find("span.bootstrap-timepicker-meridian")
            .text(this.meridian);
        }
      }
    },
    updateFromWidgetInputs: function() {
      if (this.$widget === false) {
        return;
      }
      var t =
        e("input.bootstrap-timepicker-hour", this.$widget).val() +
        ":" +
        e("input.bootstrap-timepicker-minute", this.$widget).val() +
        (this.showSeconds
          ? ":" + e("input.bootstrap-timepicker-second", this.$widget).val()
          : "") +
        (this.showMeridian
          ? " " + e("input.bootstrap-timepicker-meridian", this.$widget).val()
          : "");
      this.setTime(t);
    },
    widgetClick: function(t) {
      t.stopPropagation();
      t.preventDefault();
      var n = e(t.target)
        .closest("a")
        .data("action");
      if (n) {
        this[n]();
      }
    },
    widgetKeydown: function(t) {
      var n = e(t.target).closest("input"),
        r = n.attr("name");
      switch (t.keyCode) {
        case 9:
          if (this.showMeridian) {
            if (r === "meridian") {
              return this.hideWidget();
            }
          } else {
            if (this.showSeconds) {
              if (r === "second") {
                return this.hideWidget();
              }
            } else {
              if (r === "minute") {
                return this.hideWidget();
              }
            }
          }
          this.updateFromWidgetInputs();
          break;
        case 27:
          this.hideWidget();
          break;
        case 38:
          t.preventDefault();
          switch (r) {
            case "hour":
              this.incrementHour();
              break;
            case "minute":
              this.incrementMinute();
              break;
            case "second":
              this.incrementSecond();
              break;
            case "meridian":
              this.toggleMeridian();
              break;
          }
          break;
        case 40:
          t.preventDefault();
          switch (r) {
            case "hour":
              this.decrementHour();
              break;
            case "minute":
              this.decrementMinute();
              break;
            case "second":
              this.decrementSecond();
              break;
            case "meridian":
              this.toggleMeridian();
              break;
          }
          break;
      }
    }
  };
  e.fn.timepicker = function(t) {
    var n = Array.apply(null, arguments);
    n.shift();
    return this.each(function() {
      var r = e(this),
        s = r.data("timepicker"),
        o = typeof t === "object" && t;
      if (!s) {
        r.data(
          "timepicker",
          (s = new i(
            this,
            e.extend({}, e.fn.timepicker.defaults, o, e(this).data())
          ))
        );
      }
      if (typeof t === "string") {
        s[t].apply(s, n);
      }
    });
  };
  e.fn.timepicker.defaults = {
    defaultTime: "current",
    disableFocus: false,
    isOpen: false,
    minuteStep: 15,
    modalBackdrop: false,
    secondStep: 15,
    showSeconds: false,
    showInputs: true,
    showMeridian: true,
    template: "dropdown",
    appendWidgetTo: ".bootstrap-timepicker",
    upArrowStyle: "glyphicon glyphicon-chevron-up",
    downArrowStyle: "glyphicon glyphicon-chevron-down",
    containerClass: "bootstrap-timepicker"
  };
  e.fn.timepicker.Constructor = i;
})(jQuery, window, document);
