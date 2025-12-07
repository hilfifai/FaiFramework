
!(function (e, t) {
    if ("object" == typeof exports && "object" == typeof module) module.exports = t();
    else if ("function" == typeof define && define.amd) define([], t);
    else {
        var n = t();
        for (var i in n) ("object" == typeof exports ? exports : e)[i] = n[i];
    }
})(self, function () {
    return (function () {
        "use strict";
        var e = {
            d: function (t, n) {
                for (var i in n) e.o(n, i) && !e.o(t, i) && Object.defineProperty(t, i, { enumerable: !0, get: n[i] });
            },
            o: function (e, t) {
                return Object.prototype.hasOwnProperty.call(e, t);
            },
            r: function (e) {
                "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(e, "__esModule", { value: !0 });
            },
        },
            t = {};
        function n(e) {
            return (
                a(e) ||
                (function (e) {
                    if (("undefined" != typeof Symbol && null != e[Symbol.iterator]) || null != e["@@iterator"]) return Array.from(e);
                })(e) ||
                r(e) ||
                o()
            );
        }
        function i(e, t) {
            return (
                a(e) ||
                (function (e, t) {
                    var n = null == e ? null : ("undefined" != typeof Symbol && e[Symbol.iterator]) || e["@@iterator"];
                    if (null != n) {
                        var i,
                            o,
                            r,
                            s,
                            a = [],
                            l = !0,
                            u = !1;
                        try {
                            if (((r = (n = n.call(e)).next), 0 === t)) {
                                if (Object(n) !== n) return;
                                l = !1;
                            } else for (; !(l = (i = r.call(n)).done) && (a.push(i.value), a.length !== t); l = !0);
                        } catch (e) {
                            (u = !0), (o = e);
                        } finally {
                            try {
                                if (!l && null != n.return && ((s = n.return()), Object(s) !== s)) return;
                            } finally {
                                if (u) throw o;
                            }
                        }
                        return a;
                    }
                })(e, t) ||
                r(e, t) ||
                o()
            );
        }
        function o() {
            throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
        }
        function r(e, t) {
            if (e) {
                if ("string" == typeof e) return s(e, t);
                var n = {}.toString.call(e).slice(8, -1);
                return "Object" === n && e.constructor && (n = e.constructor.name), "Map" === n || "Set" === n ? Array.from(e) : "Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n) ? s(e, t) : void 0;
            }
        }
        function s(e, t) {
            (null == t || t > e.length) && (t = e.length);
            for (var n = 0, i = Array(t); n < t; n++) i[n] = e[n];
            return i;
        }
        function a(e) {
            if (Array.isArray(e)) return e;
        }
        e.r(t),
            e.d(t, {
                Helpers: function () {
                    return d;
                },
            });
        var l = ["transitionend", "webkitTransitionEnd", "oTransitionEnd"],
            u = ["transition", "MozTransition", "webkitTransition", "WebkitTransition", "OTransition"];
        function c(e) {
            throw new Error("Parameter required".concat(e ? ": `".concat(e, "`") : ""));
        }
        var d = {
            ROOT_EL: "undefined" != typeof window ? document.documentElement : null,
            LAYOUT_BREAKPOINT: 1200,
            RESIZE_DELAY: 200,
            menuPsScroll: null,
            mainMenu: null,
            _curStyle: null,
            _styleEl: null,
            _resizeTimeout: null,
            _resizeCallback: null,
            _transitionCallback: null,
            _transitionCallbackTimeout: null,
            _listeners: [],
            _initialized: !1,
            _autoUpdate: !1,
            _lastWindowHeight: 0,
            _scrollToActive: function () {
                var e = arguments.length > 0 && void 0 !== arguments[0] && arguments[0],
                    t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 500,
                    n = this.getLayoutMenu();
                if (n) {
                    var i = n.querySelector("li.menu-item.active:not(.open)");
                    if (i) {
                        var o = this.getLayoutMenu().querySelector(".menu-inner");
                        if (("string" == typeof i && (i = document.querySelector(i)), "number" != typeof i && (i = i.getBoundingClientRect().top + o.scrollTop), i < parseInt((2 * o.clientHeight) / 3, 10))) return;
                        var r = o.scrollTop,
                            s = i - r - parseInt(o.clientHeight / 2, 10),
                            a = +new Date();
                        !0 === e
                            ? (function e() {
                                var n,
                                    i,
                                    l,
                                    u = +new Date() - a,
                                    c = ((n = u), (i = r), (l = s), (n /= t / 2) < 1 ? (l / 2) * n * n + i : (-l / 2) * ((n -= 1) * (n - 2) - 1) + i);
                                (o.scrollTop = c), u < t ? requestAnimationFrame(e) : (o.scrollTop = s);
                            })()
                            : (o.scrollTop = s);
                    }
                }
            },
            _swipeIn: function (e, t) {
                var n = window.Hammer;
                if (void 0 !== n && "string" == typeof e) {
                    var i = document.querySelector(e);
                    i && new n(i).on("panright", t);
                }
            },
            _swipeOut: function (e, t) {
                var n = window.Hammer;
                void 0 !== n &&
                    "string" == typeof e &&
                    setTimeout(function () {
                        var i = document.querySelector(e);
                        if (i) {
                            var o = new n(i);
                            o.get("pan").set({ direction: n.DIRECTION_ALL, threshold: 250 }), o.on("panleft", t);
                        }
                    }, 500);
            },
            _overlayTap: function (e, t) {
                var n = window.Hammer;
                if (void 0 !== n && "string" == typeof e) {
                    var i = document.querySelector(e);
                    i && new n(i).on("tap", t);
                }
            },
            _addClass: function (e) {
                var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.ROOT_EL;
                t && void 0 !== t.length
                    ? t.forEach(function (t) {
                        t &&
                            e.split(" ").forEach(function (e) {
                                return t.classList.add(e);
                            });
                    })
                    : t &&
                    e.split(" ").forEach(function (e) {
                        return t.classList.add(e);
                    });
            },
            _removeClass: function (e) {
                var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.ROOT_EL;
                t && void 0 !== t.length
                    ? t.forEach(function (t) {
                        t &&
                            e.split(" ").forEach(function (e) {
                                return t.classList.remove(e);
                            });
                    })
                    : t &&
                    e.split(" ").forEach(function (e) {
                        return t.classList.remove(e);
                    });
            },
            _toggleClass: function () {
                var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : this.ROOT_EL,
                    t = arguments.length > 1 ? arguments[1] : void 0,
                    n = arguments.length > 2 ? arguments[2] : void 0;
                e.classList.contains(t) ? e.classList.replace(t, n) : e.classList.replace(n, t);
            },
            _hasClass: function (e) {
                var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.ROOT_EL,
                    n = !1;
                return (
                    e.split(" ").forEach(function (e) {
                        t.classList.contains(e) && (n = !0);
                    }),
                    n
                );
            },
            _findParent: function (e, t) {
                if ((e && "BODY" === e.tagName.toUpperCase()) || "HTML" === e.tagName.toUpperCase()) return null;
                for (e = e.parentNode; e && "BODY" !== e.tagName.toUpperCase() && !e.classList.contains(t);) e = e.parentNode;
                return e && "BODY" !== e.tagName.toUpperCase() ? e : null;
            },
            _triggerWindowEvent: function (e) {
                var t;
                "undefined" != typeof window &&
                    (document.createEvent
                        ? ("function" == typeof Event ? (t = new Event(e)) : (t = document.createEvent("Event")).initEvent(e, !1, !0), window.dispatchEvent(t))
                        : window.fireEvent("on".concat(e), document.createEventObject()));
            },
            _triggerEvent: function (e) {
                this._triggerWindowEvent("layout".concat(e)),
                    this._listeners
                        .filter(function (t) {
                            return t.event === e;
                        })
                        .forEach(function (e) {
                            return e.callback.call(null);
                        });
            },
            _updateInlineStyle: function () {
                var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0,
                    t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 0;
                this._styleEl || ((this._styleEl = document.createElement("style")), (this._styleEl.type = "text/css"), document.head.appendChild(this._styleEl));
                var n = "\n.layout-menu-fixed .layout-navbar-full .layout-menu,\n.layout-menu-fixed-offcanvas .layout-navbar-full .layout-menu {\n  top: {navbarHeight}px !important;\n}\n.layout-page {\n  padding-top: {navbarHeight}px !important;\n}\n.content-wrapper {\n  padding-bottom: {footerHeight}px !important;\n}"
                    .replace(/\{navbarHeight\}/gi, e)
                    .replace(/\{footerHeight\}/gi, t);
                this._curStyle !== n && ((this._curStyle = n), (this._styleEl.textContent = n));
            },
            _removeInlineStyle: function () {
                this._styleEl && document.head.removeChild(this._styleEl), (this._styleEl = null), (this._curStyle = null);
            },
            _redrawLayoutMenu: function () {
                var e = this.getLayoutMenu();
                if (e && e.querySelector(".menu")) {
                    var t = e.querySelector(".menu-inner"),
                        n = t.scrollTop,
                        i = document.documentElement.scrollTop;
                    return (e.style.display = "none"), (e.style.display = ""), (t.scrollTop = n), (document.documentElement.scrollTop = i), !0;
                }
                return !1;
            },
            _supportsTransitionEnd: function () {
                if (window.QUnit) return !1;
                var e = document.body || document.documentElement;
                if (!e) return !1;
                var t = !1;
                return (
                    u.forEach(function (n) {
                        void 0 !== e.style[n] && (t = !0);
                    }),
                    t
                );
            },
            _getNavbarHeight: function () {
                var e = this,
                    t = this.getLayoutNavbar();
                if (!t) return 0;
                if (!this.isSmallScreen()) return t.getBoundingClientRect().height;
                var n = t.cloneNode(!0);
                (n.id = null),
                    (n.style.visibility = "hidden"),
                    (n.style.position = "absolute"),
                    Array.prototype.slice.call(n.querySelectorAll(".collapse.show")).forEach(function (t) {
                        return e._removeClass("show", t);
                    }),
                    t.parentNode.insertBefore(n, t);
                var i = n.getBoundingClientRect().height;
                return n.parentNode.removeChild(n), i;
            },
            _getFooterHeight: function () {
                var e = this.getLayoutFooter();
                return e ? e.getBoundingClientRect().height : 0;
            },
            _getAnimationDuration: function (e) {
                var t = window.getComputedStyle(e).transitionDuration;
                return parseFloat(t) * (-1 !== t.indexOf("ms") ? 1 : 1e3);
            },
            _setMenuHoverState: function (e) {
                this[e ? "_addClass" : "_removeClass"]("layout-menu-hover");
            },
            _setCollapsed: function (e) {
                var t = this;
                this.isSmallScreen()
                    ? e
                        ? this._removeClass("layout-menu-expanded")
                        : setTimeout(
                            function () {
                                t._addClass("layout-menu-expanded");
                            },
                            this._redrawLayoutMenu() ? 5 : 0
                        )
                    : this[e ? "_addClass" : "_removeClass"]("layout-menu-collapsed");
            },
            _bindLayoutAnimationEndEvent: function (e, t) {
                var n = this,
                    i = this.getMenu(),
                    o = i ? this._getAnimationDuration(i) + 50 : 0;
                if (!o) return e.call(this), void t.call(this);
                (this._transitionCallback = function (e) {
                    e.target === i && (n._unbindLayoutAnimationEndEvent(), t.call(n));
                }),
                    l.forEach(function (e) {
                        i.addEventListener(e, n._transitionCallback, !1);
                    }),
                    e.call(this),
                    (this._transitionCallbackTimeout = setTimeout(function () {
                        n._transitionCallback.call(n, { target: i });
                    }, o));
            },
            _unbindLayoutAnimationEndEvent: function () {
                var e = this,
                    t = this.getMenu();
                this._transitionCallbackTimeout && (clearTimeout(this._transitionCallbackTimeout), (this._transitionCallbackTimeout = null)),
                    t &&
                    this._transitionCallback &&
                    l.forEach(function (n) {
                        t.removeEventListener(n, e._transitionCallback, !1);
                    }),
                    this._transitionCallback && (this._transitionCallback = null);
            },
            _bindWindowResizeEvent: function () {
                var e = this;
                this._unbindWindowResizeEvent();
                var t = function () {
                    e._resizeTimeout && (clearTimeout(e._resizeTimeout), (e._resizeTimeout = null)), e._triggerEvent("resize");
                };
                (this._resizeCallback = function () {
                    e._resizeTimeout && clearTimeout(e._resizeTimeout), (e._resizeTimeout = setTimeout(t, e.RESIZE_DELAY));
                }),
                    window.addEventListener("resize", this._resizeCallback, !1);
            },
            _unbindWindowResizeEvent: function () {
                this._resizeTimeout && (clearTimeout(this._resizeTimeout), (this._resizeTimeout = null)), this._resizeCallback && (window.removeEventListener("resize", this._resizeCallback, !1), (this._resizeCallback = null));
            },
            _bindMenuMouseEvents: function () {
                var e = this;
                if (!(this._menuMouseEnter && this._menuMouseLeave && this._windowTouchStart)) {
                    var t = this.getLayoutMenu();
                    if (!t) return this._unbindMenuMouseEvents();
                    this._menuMouseEnter ||
                        ((this._menuMouseEnter = function () {
                            return e.isSmallScreen() || !e._hasClass("layout-menu-collapsed") || e.isOffcanvas() || e._hasClass("layout-transitioning") ? e._setMenuHoverState(!1) : e._setMenuHoverState(!0);
                        }),
                            t.addEventListener("mouseenter", this._menuMouseEnter, !1),
                            t.addEventListener("touchstart", this._menuMouseEnter, !1)),
                        this._menuMouseLeave ||
                        ((this._menuMouseLeave = function () {
                            e._setMenuHoverState(!1);
                        }),
                            t.addEventListener("mouseleave", this._menuMouseLeave, !1)),
                        this._windowTouchStart ||
                        ((this._windowTouchStart = function (t) {
                            (t && t.target && e._findParent(t.target, ".layout-menu")) || e._setMenuHoverState(!1);
                        }),
                            window.addEventListener("touchstart", this._windowTouchStart, !0));
                }
            },
            _unbindMenuMouseEvents: function () {
                if (this._menuMouseEnter || this._menuMouseLeave || this._windowTouchStart) {
                    var e = this.getLayoutMenu();
                    this._menuMouseEnter && (e && (e.removeEventListener("mouseenter", this._menuMouseEnter, !1), e.removeEventListener("touchstart", this._menuMouseEnter, !1)), (this._menuMouseEnter = null)),
                        this._menuMouseLeave && (e && e.removeEventListener("mouseleave", this._menuMouseLeave, !1), (this._menuMouseLeave = null)),
                        this._windowTouchStart && (e && window.addEventListener("touchstart", this._windowTouchStart, !0), (this._windowTouchStart = null)),
                        this._setMenuHoverState(!1);
                }
            },
            scrollToActive: function () {
                var e = arguments.length > 0 && void 0 !== arguments[0] && arguments[0];
                this._scrollToActive(e);
            },
            swipeIn: function (e, t) {
                this._swipeIn(e, t);
            },
            swipeOut: function (e, t) {
                this._swipeOut(e, t);
            },
            overlayTap: function (e, t) {
                this._overlayTap(e, t);
            },
            scrollPageTo: function (e) {
                var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 500,
                    n = document.scrollingElement;
                "string" == typeof e && (e = document.querySelector(e)), "number" != typeof e && (e = e.getBoundingClientRect().top + n.scrollTop);
                var i = n.scrollTop,
                    o = e - i,
                    r = +new Date();
                !(function s() {
                    var a,
                        l,
                        u,
                        c = +new Date() - r,
                        d = ((a = c), (l = i), (u = o), (a /= t / 2) < 1 ? (u / 2) * a * a + l : (-u / 2) * ((a -= 1) * (a - 2) - 1) + l);
                    (n.scrollTop = d), c < t ? requestAnimationFrame(s) : (n.scrollTop = e);
                })();
            },
            setCollapsed: function () {
                var e = this,
                    t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : c("collapsed"),
                    n = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1];
                this.getLayoutMenu() &&
                    (this._unbindLayoutAnimationEndEvent(),
                        n && this._supportsTransitionEnd()
                            ? (this._addClass("layout-transitioning"),
                                t && this._setMenuHoverState(!1),
                                this._bindLayoutAnimationEndEvent(
                                    function () {
                                        e._setCollapsed(t);
                                    },
                                    function () {
                                        e._removeClass("layout-transitioning"), e._triggerWindowEvent("resize"), e._triggerEvent("toggle"), e._setMenuHoverState(!1);
                                    }
                                ))
                            : (this._addClass("layout-no-transition"),
                                t && this._setMenuHoverState(!1),
                                this._setCollapsed(t),
                                setTimeout(function () {
                                    e._removeClass("layout-no-transition"), e._triggerWindowEvent("resize"), e._triggerEvent("toggle"), e._setMenuHoverState(!1);
                                }, 1)));
            },
            toggleCollapsed: function () {
                var e = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0];
                this.setCollapsed(!this.isCollapsed(), e);
            },
            setPosition: function () {
                var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : c("fixed"),
                    t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : c("offcanvas");
                this._removeClass("layout-menu-offcanvas layout-menu-fixed layout-menu-fixed-offcanvas"),
                    !e && t ? this._addClass("layout-menu-offcanvas") : e && !t ? (this._addClass("layout-menu-fixed"), this._redrawLayoutMenu()) : e && t && (this._addClass("layout-menu-fixed-offcanvas"), this._redrawLayoutMenu()),
                    this.update();
            },
            getLayoutMenu: function () {
                return document.querySelector(".layout-menu");
            },
            getMenu: function () {
                var e = this.getLayoutMenu();
                return e ? (this._hasClass("menu", e) ? e : e.querySelector(".menu")) : null;
            },
            getLayoutNavbar: function () {
                return document.querySelector(".layout-navbar");
            },
            getLayoutFooter: function () {
                return document.querySelector(".content-footer");
            },
            getLayoutContainer: function () {
                return document.querySelector(".layout-page");
            },
            setNavbarFixed: function () {
                this[(arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : c("fixed")) ? "_addClass" : "_removeClass"]("layout-navbar-fixed"), this.update();
            },
            setNavbar: function (e) {
                "sticky" === e
                    ? (this._addClass("layout-navbar-fixed"), this._removeClass("layout-navbar-hidden"))
                    : "hidden" === e
                        ? (this._addClass("layout-navbar-hidden"), this._removeClass("layout-navbar-fixed"))
                        : (this._removeClass("layout-navbar-hidden"), this._removeClass("layout-navbar-fixed")),
                    this.update();
            },
            setFooterFixed: function () {
                this[(arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : c("fixed")) ? "_addClass" : "_removeClass"]("layout-footer-fixed"), this.update();
            },
            setContentLayout: function () {
                var e = this,
                    t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : c("contentLayout");
                setTimeout(function () {
                    var n,
                        i = document.querySelector(".content-wrapper > div"),
                        o = document.querySelector(".layout-navbar"),
                        r = document.querySelector(".layout-navbar > div"),
                        s = document.querySelector(".layout-navbar .search-input-wrapper"),
                        a = document.querySelector(".layout-navbar .search-input-wrapper .search-input"),
                        l = document.querySelector(".content-footer > div"),
                        u = [].slice.call(document.querySelectorAll(".container-fluid")),
                        c = [].slice.call(document.querySelectorAll(".container-xxl")),
                        d = document.querySelector(".menu-vertical"),
                        f = !1;
                    document.querySelector(".content-wrapper > .menu-horizontal > div") && ((f = !0), (n = document.querySelector(".content-wrapper > .menu-horizontal > div"))),
                        "compact" === t
                            ? (u.some(function (e) {
                                return [i, l].includes(e);
                            }) && (e._removeClass("container-fluid", [i, l]), e._addClass("container-xxl", [i, l])),
                                a && (e._removeClass("container-fluid", [a]), e._addClass("container-xxl", [a])),
                                d &&
                                u.some(function (e) {
                                    return [o].includes(e);
                                }) &&
                                (e._removeClass("container-fluid", [o]), e._addClass("container-xxl", [o])),
                                f &&
                                (e._removeClass("container-fluid", n),
                                    e._addClass("container-xxl", n),
                                    r && (e._removeClass("container-fluid", r), e._addClass("container-xxl", r)),
                                    s && (e._removeClass("container-fluid", s), e._addClass("container-xxl", s))))
                            : (c.some(function (e) {
                                return [i, l].includes(e);
                            }) && (e._removeClass("container-xxl", [i, l]), e._addClass("container-fluid", [i, l])),
                                a && (e._removeClass("container-xxl", [a]), e._addClass("container-fluid", [a])),
                                d &&
                                c.some(function (e) {
                                    return [o].includes(e);
                                }) &&
                                (e._removeClass("container-xxl", [o]), e._addClass("container-fluid", [o])),
                                f &&
                                (e._removeClass("container-xxl", n),
                                    e._addClass("container-fluid", n),
                                    r && (e._removeClass("container-xxl", r), e._addClass("container-fluid", r)),
                                    s && (e._removeClass("container-xxl", s), e._addClass("container-fluid", s))));
                }, 100);
            },
            update: function () {
                ((this.getLayoutNavbar() && ((!this.isSmallScreen() && this.isLayoutNavbarFull() && this.isFixed()) || this.isNavbarFixed())) || (this.getLayoutFooter() && this.isFooterFixed())) &&
                    this._updateInlineStyle(this._getNavbarHeight(), this._getFooterHeight()),
                    this._bindMenuMouseEvents();
            },
            setAutoUpdate: function () {
                var e = this,
                    t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : c("enable");
                t && !this._autoUpdate
                    ? (this.on("resize.Helpers:autoUpdate", function () {
                        return e.update();
                    }),
                        (this._autoUpdate = !0))
                    : !t && this._autoUpdate && (this.off("resize.Helpers:autoUpdate"), (this._autoUpdate = !1));
            },
            updateCustomOptionCheck: function (e) {
                e.checked
                    ? ("radio" === e.type &&
                        [].slice.call(e.closest(".row").querySelectorAll(".custom-option")).map(function (e) {
                            e.closest(".custom-option").classList.remove("checked");
                        }),
                        e.closest(".custom-option").classList.add("checked"))
                    : e.closest(".custom-option").classList.remove("checked");
            },
            isRtl: function () {
                return "rtl" === document.querySelector("body").getAttribute("dir") || "rtl" === document.querySelector("html").getAttribute("dir");
            },
            isMobileDevice: function () {
                return void 0 !== window.orientation || -1 !== navigator.userAgent.indexOf("IEMobile");
            },
            isSmallScreen: function () {
                return (window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth) < this.LAYOUT_BREAKPOINT;
            },
            isLayoutNavbarFull: function () {
                return !!document.querySelector(".layout-wrapper.layout-navbar-full");
            },
            isCollapsed: function () {
                return this.isSmallScreen() ? !this._hasClass("layout-menu-expanded") : this._hasClass("layout-menu-collapsed");
            },
            isFixed: function () {
                return this._hasClass("layout-menu-fixed layout-menu-fixed-offcanvas");
            },
            isOffcanvas: function () {
                return this._hasClass("layout-menu-offcanvas layout-menu-fixed-offcanvas");
            },
            isNavbarFixed: function () {
                return this._hasClass("layout-navbar-fixed") || (!this.isSmallScreen() && this.isFixed() && this.isLayoutNavbarFull());
            },
            isFooterFixed: function () {
                return this._hasClass("layout-footer-fixed");
            },
            isLightStyle: function () {
                return document.documentElement.classList.contains("light-style");
            },
            isDarkStyle: function () {
                return document.documentElement.classList.contains("dark-style");
            },
            templateName: function () {
                return "";
            },
            on: function () {
                var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : c("event"),
                    t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : c("callback"),
                    o = i(e.split("."), 1)[0],
                    r = n(e.split(".")).slice(1);
                (r = r.join(".") || null), this._listeners.push({ event: o, namespace: r, callback: t });
            },
            off: function () {
                var e = this,
                    t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : c("event"),
                    o = i(t.split("."), 1)[0],
                    r = n(t.split(".")).slice(1);
                (r = r.join(".") || null),
                    this._listeners
                        .filter(function (e) {
                            return e.event === o && e.namespace === r;
                        })
                        .forEach(function (t) {
                            return e._listeners.splice(e._listeners.indexOf(t), 1);
                        });
            },
            init: function () {
                var e = this;
                this._initialized ||
                    ((this._initialized = !0),
                        this._updateInlineStyle(0),
                        this._bindWindowResizeEvent(),
                        this.off("init._Helpers"),
                        this.on("init._Helpers", function () {
                            e.off("resize._Helpers:redrawMenu"),
                                e.on("resize._Helpers:redrawMenu", function () {
                                    e.isSmallScreen() && !e.isCollapsed() && e._redrawLayoutMenu();
                                }),
                                "number" == typeof document.documentMode &&
                                document.documentMode < 11 &&
                                (e.off("resize._Helpers:ie10RepaintBody"),
                                    e.on("resize._Helpers:ie10RepaintBody", function () {
                                        if (!e.isFixed()) {
                                            var t = document.documentElement.scrollTop;
                                            (document.body.style.display = "none"), (document.body.style.display = "block"), (document.documentElement.scrollTop = t);
                                        }
                                    }));
                        }),
                        this._triggerEvent("init"));
            },
            destroy: function () {
                var e = this;
                this._initialized &&
                    ((this._initialized = !1),
                        this._removeClass("layout-transitioning"),
                        this._removeInlineStyle(),
                        this._unbindLayoutAnimationEndEvent(),
                        this._unbindWindowResizeEvent(),
                        this._unbindMenuMouseEvents(),
                        this.setAutoUpdate(!1),
                        this.off("init._Helpers"),
                        this._listeners
                            .filter(function (e) {
                                return "init" !== e.event;
                            })
                            .forEach(function (t) {
                                return e._listeners.splice(e._listeners.indexOf(t), 1);
                            }));
            },
            initPasswordToggle: function () {
                var e = document.querySelectorAll(".form-password-toggle i");
                null != e &&
                    e.forEach(function (e) {
                        e.addEventListener("click", function (t) {
                            t.preventDefault();
                            var n = e.closest(".form-password-toggle"),
                                i = n.querySelector("i"),
                                o = n.querySelector("input");
                            "text" === o.getAttribute("type")
                                ? (o.setAttribute("type", "password"), i.classList.replace("bx-show", "bx-hide"))
                                : "password" === o.getAttribute("type") && (o.setAttribute("type", "text"), i.classList.replace("bx-hide", "bx-show"));
                        });
                    });
            },
            initCustomOptionCheck: function () {
                var e = this;
                [].slice.call(document.querySelectorAll(".custom-option .form-check-input")).map(function (t) {
                    e.updateCustomOptionCheck(t),
                        t.addEventListener("click", function (n) {
                            e.updateCustomOptionCheck(t);
                        });
                });
            },
            initSpeechToText: function () {
                var e = window.SpeechRecognition || window.webkitSpeechRecognition,
                    t = document.querySelectorAll(".speech-to-text");
                if (null != e && null != t) {
                    var n = new e();
                    document.querySelectorAll(".speech-to-text i").forEach(function (e) {
                        var t = !1;
                        e.addEventListener("click", function () {
                            e.closest(".input-group").querySelector(".form-control").focus(),
                                (n.onspeechstart = function () {
                                    t = !0;
                                }),
                                !1 === t && n.start(),
                                (n.onerror = function () {
                                    t = !1;
                                }),
                                (n.onresult = function (t) {
                                    e.closest(".input-group").querySelector(".form-control").value = t.results[0][0].transcript;
                                }),
                                (n.onspeechend = function () {
                                    (t = !1), n.stop();
                                });
                        });
                    });
                }
            },
            initNavbarDropdownScrollbar: function () {
                var e = document.querySelectorAll(".navbar-dropdown .scrollable-container"),
                    t = window.PerfectScrollbar;
                void 0 !== t &&
                    null != e &&
                    e.forEach(function (e) {
                        new t(e, { wheelPropagation: !1, suppressScrollX: !0 });
                    });
            },
            ajaxCall: function (e) {
                return new Promise(function (t, n) {
                    var i = new XMLHttpRequest();
                    i.open("GET", e),
                        (i.onload = function () {
                            return 200 === i.status ? t(i.response) : n(Error(i.statusText));
                        }),
                        (i.onerror = function (e) {
                            return n(Error("Network Error: ".concat(e)));
                        }),
                        i.send();
                });
            },
            initSidebarToggle: function () {
                document.querySelectorAll('[data-bs-toggle="sidebar"]').forEach(function (e) {
                    e.addEventListener("click", function () {
                        var t = e.getAttribute("data-target"),
                            n = e.getAttribute("data-overlay"),
                            i = document.querySelectorAll(".app-overlay");
                        document.querySelectorAll(t).forEach(function (e) {
                            e.classList.toggle("show"),
                                null != n &&
                                !1 !== n &&
                                void 0 !== i &&
                                (e.classList.contains("show") ? i[0].classList.add("show") : i[0].classList.remove("show"),
                                    i[0].addEventListener("click", function (t) {
                                        t.currentTarget.classList.remove("show"), e.classList.remove("show");
                                    }));
                        });
                    });
                });
            },
        };
        return (
            "undefined" != typeof window &&
            (d.init(),
                d.isMobileDevice() && window.chrome && document.documentElement.classList.add("layout-menu-100vh"),
                "complete" === document.readyState
                    ? d.update()
                    : document.addEventListener("DOMContentLoaded", function e() {
                        d.update(), document.removeEventListener("DOMContentLoaded", e);
                    })),
            (window.Helpers = d),
            t
        );
    })();
});


(window.isRtl = window.Helpers.isRtl()), (window.isDarkStyle = window.Helpers.isDarkStyle());
let isHorizontalLayout = !1;
document.getElementById("layout-menu") && (isHorizontalLayout = document.getElementById("layout-menu").classList.contains("menu-horizontal")),
    (function () {
        setTimeout(function () {
            window.Helpers.initCustomOptionCheck();
        }, 1e3),

            document.querySelectorAll(".layout-menu-toggle").forEach((e) => {
                e.addEventListener("click", (e) => {
                    if ((e.preventDefault(), window.Helpers.toggleCollapsed(), configBe3.enableMenuLocalStorage && !window.Helpers.isSmallScreen()))
                        try {
                            localStorage.setItem("templateCustomizer-templateName--LayoutCollapsed", String(window.Helpers.isCollapsed()));
                            var t,
                                o = document.querySelector(".template-customizer-layouts-options");
                            o && ((t = window.Helpers.isCollapsed() ? "collapsed" : "expanded"), o.querySelector(`input[value="${t}"]`).click());
                        } catch (e) { }
                });
            });
        if (document.getElementById("layout-menu")) {
            var t = document.getElementById("layout-menu");
            var o = function () {
                Helpers.isSmallScreen() || document.querySelector(".layout-menu-toggle").classList.add("d-block");
            };
            let e = null;
            (t.onmouseenter = function () {
                e = Helpers.isSmallScreen() ? setTimeout(o, 0) : setTimeout(o, 300);
            }),
                (t.onmouseleave = function () {
                    document.querySelector(".layout-menu-toggle").classList.remove("d-block"), clearTimeout(e);
                });
        }
        window.Helpers.swipeIn(".drag-target", function (e) {
            window.Helpers.setCollapsed(!1);
        }),
            window.Helpers.swipeOut("#layout-menu", function (e) {
                window.Helpers.isSmallScreen() && window.Helpers.setCollapsed(!0);
            });
        let e = document.getElementsByClassName("menu-inner"),
            n = document.getElementsByClassName("menu-inner-shadow")[0];
        0 < e.length &&
            n &&
            e[0].addEventListener("ps-scroll-y", function () {
                this.querySelector(".ps__thumb-y").offsetTop ? (n.style.display = "block") : (n.style.display = "none");
            });
        t = document.querySelector(".dropdown-style-switcher");
        let a = document.documentElement.getAttribute("data-style");
        var s,
            l = localStorage.getItem("templateCustomizer-templateName--Style") || (window.templateCustomizer?.settings?.defaultStyle ?? "light"),
            i = "";

        if (i.length) {
            var r = i[0].querySelectorAll(".dropdown-item");
            for (let e = 0; e < r.length; e++)
                r[e].addEventListener("click", function () {
                    let o = this.getAttribute("data-language"),
                        n = this.getAttribute("data-text-direction");
                    for (var e of this.parentNode.children)
                        for (var t = e.parentElement.parentNode.firstChild; t;) 1 === t.nodeType && t !== t.parentElement && t.querySelector(".dropdown-item").classList.remove("active"), (t = t.nextSibling);
                    this.classList.add("active"),
                        i18next.changeLanguage(o, (e, t) => {
                            if (
                                (window.templateCustomizer && window.templateCustomizer.setLang(o),
                                    "rtl" === n
                                        ? "true" !== localStorage.getItem("templateCustomizer-" + templateName + "--Rtl") && window.templateCustomizer && window.templateCustomizer.setRtl(!0)
                                        : "true" === localStorage.getItem("templateCustomizer-" + templateName + "--Rtl") && window.templateCustomizer && window.templateCustomizer.setRtl(!1),
                                    e)
                            )
                                return console.log("something went wrong loading", e);
                            d();
                        });
                });
        }
        function d() {
            var e = document.querySelectorAll("[data-i18n]"),
                t = document.querySelector('.dropdown-item[data-language="' + i18next.language + '"]');
            t && t.click(),
                e.forEach(function (e) {
                    e.innerHTML = i18next.t(e.dataset.i18n);
                });
        }
        l = document.querySelector(".dropdown-notifications-all");
        function c(e) {
            "show.bs.collapse" == e.type || "show.bs.collapse" == e.type ? e.target.closest(".accordion-item").classList.add("active") : e.target.closest(".accordion-item").classList.remove("active");
        }
        let u = document.querySelectorAll(".dropdown-notifications-read");
        l &&
            l.addEventListener("click", (e) => {
                u.forEach((e) => {
                    e.closest(".dropdown-notifications-item").classList.add("marked-as-read");
                });
            }),
            u &&
            u.forEach((t) => {
                t.addEventListener("click", (e) => {
                    t.closest(".dropdown-notifications-item").classList.toggle("marked-as-read");
                });
            }),
            document.querySelectorAll(".dropdown-notifications-archive").forEach((t) => {
                t.addEventListener("click", (e) => {
                    t.closest(".dropdown-notifications-item").remove();
                });
            }),
            [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function (e) {
                return new bootstrap.Tooltip(e);
            });
        [].slice.call(document.querySelectorAll(".accordion")).map(function (e) {
            e.addEventListener("show.bs.collapse", c), e.addEventListener("hide.bs.collapse", c);
        });
        window.Helpers.setAutoUpdate(!0), window.Helpers.initPasswordToggle(), window.Helpers.initSpeechToText(), window.Helpers.initNavbarDropdownScrollbar();
        let m = document.querySelector("[data-template^='horizontal-menu']");
        if (
            (m && (window.innerWidth < window.Helpers.LAYOUT_BREAKPOINT ? window.Helpers.setNavbarFixed("fixed") : window.Helpers.setNavbarFixed("")),
                window.addEventListener(
                    "resize",
                    function (e) {
                        window.innerWidth >= window.Helpers.LAYOUT_BREAKPOINT &&
                            document.querySelector(".search-input-wrapper") &&
                            (document.querySelector(".search-input-wrapper").classList.add("d-none"), (document.querySelector(".search-input").value = "")),
                            m &&
                            (window.innerWidth < window.Helpers.LAYOUT_BREAKPOINT ? window.Helpers.setNavbarFixed("fixed") : window.Helpers.setNavbarFixed(""),
                                setTimeout(function () {
                                    window.innerWidth < window.Helpers.LAYOUT_BREAKPOINT
                                        ? document.getElementById("layout-menu") && document.getElementById("layout-menu").classList.contains("menu-horizontal") && menu.switchMenu("vertical")
                                        : document.getElementById("layout-menu") && document.getElementById("layout-menu").classList.contains("menu-vertical") && menu.switchMenu("horizontal");
                                }, 100));
                    },
                    !0
                ),
                !isHorizontalLayout &&
                !window.Helpers.isSmallScreen() &&
                ("undefined" != typeof TemplateCustomizer && (window.templateCustomizer.settings.defaultMenuCollapsed ? window.Helpers.setCollapsed(!0, !1) : window.Helpers.setCollapsed(!1, !1)), "undefined" != typeof configBe3) &&
                configBe3.enableMenuLocalStorage)
        )
            try {
                null !== localStorage.getItem("templateCustomizer-" + templateName + "--LayoutCollapsed") && window.Helpers.setCollapsed("true" === localStorage.getItem("templateCustomizer-" + templateName + "--LayoutCollapsed"), !1);
            } catch (e) { }
    })(),
    "undefined" != typeof $ &&
    $(function () {
        window.Helpers.initSidebarToggle();
        var t,
            o,
            e,
            n = $(".search-toggler"),
            a = $(".search-input-wrapper"),
            s = $(".search-input"),
            l = $(".content-backdrop");
        n.length &&
            n.on("click", function () {
                a.length && (a.toggleClass("d-none"), s.focus());
            }),
            $(document).on("keydown", function (e) {
                var t = e.ctrlKey,
                    e = 191 === e.which;
                t && e && a.length && (a.toggleClass("d-none"), s.focus());
            }),
            setTimeout(function () {
                var e = $(".twitter-typeahead");
                s.on("focus", function () {
                    a.hasClass("container-xxl") ? (a.find(e).addClass("container-xxl"), e.removeClass("container-fluid")) : a.hasClass("container-fluid") && (a.find(e).addClass("container-fluid"), e.removeClass("container-xxl"));
                });
            }, 10),
            s.length &&
            ((t = function (n) {
                return function (t, e) {
                    let o;
                    (o = []),
                        n.filter(function (e) {
                            if (e.name.toLowerCase().startsWith(t.toLowerCase())) o.push(e);
                            else {
                                if (e.name.toLowerCase().startsWith(t.toLowerCase()) || !e.name.toLowerCase().includes(t.toLowerCase())) return [];
                                o.push(e),
                                    o.sort(function (e, t) {
                                        return t.name < e.name ? 1 : -1;
                                    });
                            }
                        }),
                        e(o);
                };
            }),
                (n = "search-vertical.json"),
                $("#layout-menu").hasClass("menu-horizontal") && (n = "search-horizontal.json"),
                (o = $.ajax({ url: assetsPath + "json/" + n, dataType: "json", async: !1 }).responseJSON),
                s.each(function () {
                    var e = $(this);
                    s
                        .typeahead(
                            { hint: !1, classNames: { menu: "tt-menu navbar-search-suggestion", cursor: "active", suggestion: "suggestion d-flex justify-content-between px-3 py-2 w-100" } },
                            {
                                name: "pages",
                                display: "name",
                                limit: 5,
                                source: t(o.pages),
                                templates: {
                                    header: '<h6 class="suggestions-header text-primary mb-0 mx-3 mt-3 pb-2">Pages</h6>',
                                    suggestion: function ({ url: e, icon: t, name: o }) {
                                        return '<a href="' + e + '"><div><i class="bx ' + t + ' me-2"></i><span class="align-middle">' + o + "</span></div></a>";
                                    },
                                    notFound: '<div class="not-found px-3 py-2"><h6 class="suggestions-header text-primary mb-2">Pages</h6><p class="py-2 mb-0"><i class="bx bx-error-circle bx-xs me-2"></i> No Results Found</p></div>',
                                },
                            },
                            {
                                name: "files",
                                display: "name",
                                limit: 4,
                                source: t(o.files),
                                templates: {
                                    header: '<h6 class="suggestions-header text-primary mb-0 mx-3 mt-3 pb-2">Files</h6>',
                                    suggestion: function ({ src: e, name: t, subtitle: o, meta: n }) {
                                        return (
                                            '<a href="javascript:;"><div class="d-flex w-50"><img class="me-3" src="' +
                                            assetsPath +
                                            e +
                                            '" alt="' +
                                            t +
                                            '" height="32"><div class="w-75"><h6 class="mb-0">' +
                                            t +
                                            '</h6><small class="text-muted">' +
                                            o +
                                            '</small></div></div><small class="text-muted">' +
                                            n +
                                            "</small></a>"
                                        );
                                    },
                                    notFound: '<div class="not-found px-3 py-2"><h6 class="suggestions-header text-primary mb-2">Files</h6><p class="py-2 mb-0"><i class="bx bx-error-circle bx-xs me-2"></i> No Results Found</p></div>',
                                },
                            },
                            {
                                name: "members",
                                display: "name",
                                limit: 4,
                                source: t(o.members),
                                templates: {
                                    header: '<h6 class="suggestions-header text-primary mb-0 mx-3 mt-3 pb-2">Members</h6>',
                                    suggestion: function ({ name: e, src: t, subtitle: o }) {
                                        return (
                                            '<a href="app-user-view-account.html"><div class="d-flex align-items-center"><img class="rounded-circle me-3" src="' +
                                            assetsPath +
                                            t +
                                            '" alt="' +
                                            e +
                                            '" height="32"><div class="user-info"><h6 class="mb-0">' +
                                            e +
                                            '</h6><small class="text-muted">' +
                                            o +
                                            "</small></div></div></a>"
                                        );
                                    },
                                    notFound: '<div class="not-found px-3 py-2"><h6 class="suggestions-header text-primary mb-2">Members</h6><p class="py-2 mb-0"><i class="bx bx-error-circle bx-xs me-2"></i> No Results Found</p></div>',
                                },
                            }
                        )
                        .bind("typeahead:render", function () {
                            l.addClass("show").removeClass("fade");
                        })
                        .bind("typeahead:select", function (e, t) {
                            t.url && (window.location = t.url);
                        })
                        .bind("typeahead:close", function () {
                            s.val(""), e.typeahead("val", ""), a.addClass("d-none"), l.addClass("fade").removeClass("show");
                        }),
                        s.on("keyup", function () {
                            "" == s.val() && l.addClass("fade").removeClass("show");
                        });
                }),
                $(".navbar-search-suggestion").each(function () {
                    e = new PerfectScrollbar($(this)[0], { wheelPropagation: !1, suppressScrollX: !0 });
                }),
                s.on("keyup", function () {
                    e.update();
                }));
    });

!(function () {
    let o, e, r, t, a, s, i, n, l;
    let configBe3;
    configBe3 = {
        colors: {
            primary: "#696cff",
            secondary: "#8592a3",
            success: "#71dd37",
            info: "#03c3ec",
            warning: "#ffab00",
            danger: "#ff3e1d",
            dark: "#233446",
            black: "#22303e",
            white: "#fff",
            cardColor: "#fff",
            bodyBg: "#f5f5f9",
            bodyColor: "#646E78",
            headingColor: "#384551",
            textMuted: "#a7acb2",
            borderColor: "#e4e6e8",
        },
        colors_label: { primary: "#696cff29", secondary: "#8592a329", success: "#71dd3729", info: "#03c3ec29", warning: "#ffab0029", danger: "#ff3e1d29", dark: "#181c211a" },
        colors_dark: { cardColor: "#2b2c40", bodyBg: "#232333", bodyColor: "#b2b2c4", headingColor: "#d5d5e2", textMuted: "#7e7f96", borderColor: "#4e4f6c" },
        enableMenuLocalStorage: !0,
    };
    (window.assetsPath = document.documentElement.getAttribute("data-assets-path")),
    (window.templateName = document.documentElement.getAttribute("data-template")),
    (window.rtlSupport = !0),
    "undefined" != typeof TemplateCustomizer &&
    (window.templateCustomizer = new TemplateCustomizer({
        cssPath: assetsPath + "vendor/css" + (rtlSupport ? "/rtl" : "") + "/",
        themesPath: assetsPath + "vendor/css" + (rtlSupport ? "/rtl" : "") + "/",
        displayCustomizer: !0,
        lang: localStorage.getItem("templateCustomizer-" + templateName + "--Lang") || "en",
        controls: ["rtl", "style", "headerType", "contentLayout", "layoutCollapsed", "layoutNavbarOptions", "themes"],
    }));

    l = isDarkStyle
        ? ((o = configBe3.colors_dark.cardColor), (e = configBe3.colors_dark.headingColor), (r = configBe3.colors_dark.textMuted), (a = configBe3.colors_dark.borderColor), (t = "dark"), (s = "#4f51c0"), (i = "#595cd9"), (n = "#8789ff"), "#c3c4ff")
        : ((o = configBe3.colors.cardColor), (e = configBe3.colors.headingColor), (r = configBe3.colors.textMuted), (a = configBe3.colors.borderColor), (t = ""), (s = "#e1e2ff"), (i = "#c3c4ff"), (n = "#a5a7ff"), "#696cff");
    var d = document.querySelector("#visitorsChart"),
        c = {
            chart: { height: 120, width: 200, parentHeightOffset: 0, type: "bar", toolbar: { show: !1 } },
            plotOptions: { bar: { barHeight: "75%", columnWidth: "60%", startingShape: "rounded", endingShape: "rounded", borderRadius: 9, distributed: !0 } },
            grid: { show: !1, padding: { top: -25, bottom: -12 } },
            colors: [configBe3.colors_label.primary, configBe3.colors_label.primary, configBe3.colors_label.primary, configBe3.colors_label.primary, configBe3.colors_label.primary, configBe3.colors.primary, configBe3.colors_label.primary],
            dataLabels: { enabled: !1 },
            series: [{ data: [40, 95, 60, 45, 90, 50, 75] }],
            legend: { show: !1 },
            responsive: [
                { breakpoint: 1440, options: { plotOptions: { bar: { borderRadius: 9, columnWidth: "60%" } } } },
                { breakpoint: 1300, options: { plotOptions: { bar: { borderRadius: 9, columnWidth: "60%" } } } },
                { breakpoint: 1200, options: { plotOptions: { bar: { borderRadius: 8, columnWidth: "50%" } } } },
                { breakpoint: 1040, options: { plotOptions: { bar: { borderRadius: 8, columnWidth: "50%" } } } },
                { breakpoint: 991, options: { plotOptions: { bar: { borderRadius: 8, columnWidth: "50%" } } } },
                { breakpoint: 420, options: { plotOptions: { bar: { borderRadius: 8, columnWidth: "50%" } } } },
            ],
            xaxis: { categories: ["M", "T", "W", "T", "F", "S", "S"], axisBorder: { show: !1 }, axisTicks: { show: !1 }, labels: { style: { colors: r, fontSize: "13px" } } },
            yaxis: { labels: { show: !1 } },
        },
        d = (null !== d && new ApexCharts(d, c).render(), document.querySelector("#activityChart")),
        c = {
            chart: { height: 120, width: 220, parentHeightOffset: 0, toolbar: { show: !1 }, type: "area" },
            dataLabels: { enabled: !1 },
            stroke: { width: 2, curve: "smooth" },
            series: [{ data: [15, 22, 17, 40, 12, 35, 25] }],
            colors: [configBe3.colors.success],
            fill: { type: "gradient", gradient: { shade: t, shadeIntensity: 0.8, opacityFrom: 0.8, opacityTo: 0.25, stops: [0, 85, 100] } },
            grid: { show: !1, padding: { top: -20, bottom: -8 } },
            legend: { show: !1 },
            xaxis: { categories: ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"], axisBorder: { show: !1 }, axisTicks: { show: !1 }, labels: { style: { fontSize: "13px", colors: r } } },
            yaxis: { labels: { show: !1 } },
        },
        d = (null !== d && new ApexCharts(d, c).render(), document.querySelector("#profitChart")),
        c = {
            series: [{ data: [58, 28, 50, 80] }, { data: [50, 22, 65, 72] }],
            chart: { type: "bar", height: 80, toolbar: { tools: { download: !1 } } },
            plotOptions: { bar: { columnWidth: "65%", startingShape: "rounded", endingShape: "rounded", borderRadius: 3, dataLabels: { show: !1 } } },
            grid: { show: !1, padding: { top: -30, bottom: -12, left: -10, right: 0 } },
            colors: [configBe3.colors.success, configBe3.colors_label.success],
            dataLabels: { enabled: !1 },
            stroke: { show: !0, width: 5, colors: r },
            legend: { show: !1 },
            xaxis: { categories: ["Jan", "Apr", "Jul", "Oct"], axisBorder: { show: !1 }, axisTicks: { show: !1 }, labels: { style: { colors: r, fontSize: "13px" } } },
            yaxis: { labels: { show: !1 } },
        },
        d = (null !== d && new ApexCharts(d, c).render(), document.querySelector("#expensesChart")),
        c = {
            chart: { height: 130, sparkline: { enabled: !0 }, parentHeightOffset: 0, type: "radialBar" },
            colors: [configBe3.colors.primary],
            series: [78],
            plotOptions: {
                radialBar: {
                    startAngle: -90,
                    endAngle: 90,
                    hollow: { size: "55%" },
                    track: { background: configBe3.colors_label.secondary },
                    dataLabels: { name: { show: !1 }, value: { fontSize: "18px", fontFamily: "Public Sans", color: e, fontWeight: 500, offsetY: -5 } },
                },
            },
            grid: { show: !1, padding: { left: -10, right: -10, bottom: 5 } },
            stroke: { lineCap: "round" },
            labels: ["Progress"],
        },
        d = (null !== d && new ApexCharts(d, c).render(), document.querySelector("#totalIncomeChart")),
        c = {
            chart: { height: 290, type: "area", toolbar: !1, dropShadow: { enabled: !0, top: 14, left: 2, blur: 3, color: configBe3.colors.primary, opacity: 0.15 } },
            series: [{ data: [3350, 3350, 4800, 4800, 2950, 2950, 1800, 1800, 3750, 3750, 5700, 5700] }],
            dataLabels: { enabled: !1 },
            stroke: { width: 3, curve: "straight" },
            colors: [configBe3.colors.primary],
            fill: { type: "gradient", gradient: { shade: t, shadeIntensity: 0.8, opacityFrom: 0.7, opacityTo: 0.25, stops: [0, 95, 100] } },
            grid: { show: !0, strokeDashArray: 10, borderColor: a, padding: { top: -15, bottom: -10, left: 0, right: 0 } },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                labels: { offsetX: 0, style: { colors: r, fontFamily: "Public Sans", fontSize: "13px" } },
                axisBorder: { show: !1 },
                axisTicks: { show: !1 },
                lines: { show: !1 },
            },
            yaxis: {
                labels: {
                    offsetX: -15,
                    formatter: function (o) {
                        return "$" + parseInt(o / 1e3) + "k";
                    },
                    style: { fontSize: "13px", fontFamily: "Public Sans", colors: r },
                },
                min: 1e3,
                max: 6e3,
                tickAmount: 5,
            },
        },
        d = (null !== d && new ApexCharts(d, c).render(), document.querySelector("#performanceChart")),
        c = {
            series: [
                { name: "Income", data: [26, 29, 31, 40, 29, 24] },
                { name: "Earning", data: [30, 26, 24, 26, 24, 40] },
            ],
            chart: { height: 310, type: "radar", toolbar: { show: !1 }, dropShadow: { enabled: !0, enabledOnSeries: void 0, top: 6, left: 0, blur: 6, color: "#000", opacity: 0.14 } },
            plotOptions: { radar: { polygons: { strokeColors: a, connectorColors: a } } },
            stroke: { show: !1, width: 0 },
            legend: {
                show: !0,
                fontSize: "13px",
                position: "bottom",
                labels: { colors: "#aab3bf", useSeriesColors: !1 },
                markers: { height: 10, width: 10, offsetX: -5 },
                itemMargin: { horizontal: 10 },
                onItemHover: { highlightDataSeries: !1 },
            },
            colors: [configBe3.colors.primary, configBe3.colors.info],
            fill: { opacity: [1, 0.85] },
            markers: { size: 0 },
            grid: { show: !1, padding: { top: -8, bottom: -5 } },
            xaxis: { categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"], labels: { show: !0, style: { colors: [r, r, r, r, r, r], fontSize: "13px", fontFamily: "Public Sans" } } },
            yaxis: { show: !1, min: 0, max: 40, tickAmount: 4 },
        },
        d = (null !== d && new ApexCharts(d, c).render(), document.querySelector("#conversionRateChart")),
        c = {
            chart: { height: 80, width: 140, type: "line", toolbar: { show: !1 }, dropShadow: { enabled: !0, top: 10, left: 5, blur: 3, color: configBe3.colors.primary, opacity: 0.15 }, sparkline: { enabled: !0 } },
            markers: {
                size: 6,
                colors: "transparent",
                strokeColors: "transparent",
                strokeWidth: 4,
                discrete: [{ fillColor: configBe3.colors.white, seriesIndex: 0, dataPointIndex: 3, strokeColor: configBe3.colors.primary, strokeWidth: 4, size: 6, radius: 2 }],
                hover: { size: 7 },
            },
            grid: { show: !1, padding: { right: 8 } },
            colors: [configBe3.colors.primary],
            dataLabels: { enabled: !1 },
            stroke: { width: 5, curve: "smooth" },
            series: [{ data: [137, 210, 160, 245] }],
            xaxis: { show: !1, lines: { show: !1 }, labels: { show: !1 }, axisBorder: { show: !1 } },
            yaxis: { show: !1 },
        },
        d = (null !== d && new ApexCharts(d, c).render(), document.querySelector("#expensesBarChart")),
        c = {
            chart: { height: 190, stacked: !0, type: "bar", toolbar: { show: !1 } },
            series: [
                { name: "2021", data: [15, 37, 14, 30, 38, 30, 20, 13, 14, 23] },
                { name: "2020", data: [-33, -23, -29, -21, -25, -21, -23, -19, -37, -22] },
            ],
            plotOptions: { bar: { horizontal: !1, columnWidth: "40%", borderRadius: 5, startingShape: "rounded", endingShape: "rounded" } },
            colors: [configBe3.colors.primary, configBe3.colors.warning],
            dataLabels: { enabled: !1 },
            stroke: { curve: "smooth", width: 2, lineCap: "round", colors: [o] },
            legend: { show: !1 },
            grid: { show: !1, padding: { top: -10 } },
            fill: { opacity: [1, 1] },
            xaxis: { show: !1, categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"], labels: { show: !1 }, axisTicks: { show: !1 }, axisBorder: { show: !1 } },
            yaxis: { show: !1 },
            responsive: [
                { breakpoint: 1440, options: { plotOptions: { bar: { borderRadius: 5, columnWidth: "60%" } } } },
                { breakpoint: 1300, options: { plotOptions: { bar: { borderRadius: 5, columnWidth: "70%" } } } },
                { breakpoint: 1200, options: { plotOptions: { bar: { borderRadius: 4, columnWidth: "50%" } } } },
                { breakpoint: 1040, options: { plotOptions: { bar: { borderRadius: 4, columnWidth: "60%" } } } },
                { breakpoint: 991, options: { plotOptions: { bar: { borderRadius: 4, columnWidth: "40%" } } } },
                { breakpoint: 420, options: { plotOptions: { bar: { borderRadius: 5, columnWidth: "60%" } } } },
                { breakpoint: 360, options: { plotOptions: { bar: { borderRadius: 5, columnWidth: "70%" } } } },
            ],
            states: { hover: { filter: { type: "none" } }, active: { filter: { type: "none" } } },
        },
        d = (null !== d && new ApexCharts(d, c).render(), document.querySelector("#totalBalanceChart")),
        c = {
            series: [{ data: [137, 210, 160, 275, 205, 315] }],
            chart: { height: 245, parentHeightOffset: 0, parentWidthOffset: 0, type: "line", dropShadow: { enabled: !0, top: 10, left: 5, blur: 3, color: configBe3.colors.warning, opacity: 0.15 }, toolbar: { show: !1 } },
            dataLabels: { enabled: !1 },
            stroke: { width: 4, curve: "smooth" },
            legend: { show: !1 },
            colors: [configBe3.colors.warning],
            markers: {
                size: 6,
                colors: "transparent",
                strokeColors: "transparent",
                strokeWidth: 4,
                discrete: [{ fillColor: configBe3.colors.white, seriesIndex: 0, dataPointIndex: 5, strokeColor: configBe3.colors.warning, strokeWidth: 8, size: 8, radius: 8 }],
                hover: { size: 9 },
            },
            grid: { show: !1, padding: { top: -10, left: 0, right: 0, bottom: 10 } },
            xaxis: { categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"], axisBorder: { show: !1 }, axisTicks: { show: !1 }, labels: { show: !0, style: { fontSize: "13px", fontFamily: "Public Sans", colors: r } } },
            yaxis: { labels: { show: !1 } },
        };
    null !== d && new ApexCharts(d, c).render();
})();
