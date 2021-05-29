"use strict";
//Wrapping all JavaScript code into a IIFE function for prevent global variables creation
(function ($) {

    function documentReadyInit() {
        var $body = $('body');
        var $window = $(window);
    
        //toggle mobile menu
        $('.page_header .toggle_menu, .page_toplogo .toggle_menu').on('click', function () {
            var $this = $(this);
            if (!$this.hasClass('toggle_menu_special')) {
                $this
                    .toggleClass('mobile-active')
                    .closest('.page_header')
                    .toggleClass('mobile-active')
                    .end()
                    .closest('.page_toplogo')
                    .next()
                    .find('.page_header')
                    .toggleClass('mobile-active');
            }
        });

        $('.sf-menu a').on('click', function () {
            var $this = $(this);
            //If this is a local link or item with sumbenu - not toggling menu
            if (($this.hasClass('sf-with-ul')) || !($this.attr('href').charAt(0) === '#')) {
                return;
            }
            $this
                .closest('.page_header')
                .toggleClass('mobile-active')
                .find('.toggle_menu')
                .toggleClass('mobile-active');
        });

        //side header processing
        var $sideHeader = $('.page_header_side');
        // toggle sub-menus visibility on menu-click
        $('ul.menu-click').find('li').each(function () {
            var $thisLi = $(this);
            //toggle submenu only for menu items with submenu
            if ($thisLi.find('ul').length) {
                $thisLi
                    .append('<span class="toggle_submenu color-darkgrey"></span>')
                    //adding anchor
                    .find('.toggle_submenu, > a')
                    .on('click', function (e) {
                        var $thisSpanOrA = $(this);
                        //if this is a link and it is already opened - going to link
                        if (($thisSpanOrA.attr('href') === '#') || !($thisSpanOrA.parent().hasClass('active-submenu'))) {
                            e.preventDefault();
                        }
                        if ($thisSpanOrA.parent().hasClass('active-submenu')) {
                            $thisSpanOrA.parent().removeClass('active-submenu');
                            return;
                        }
                        $thisLi.addClass('active-submenu').siblings().removeClass('active-submenu');
                    });
            } //eof sumbenu check
        });
        if ($sideHeader.length) {
            $('.toggle_menu_side').on('click', function () {
                var $thisToggler = $(this);
                $thisToggler.toggleClass('active');
                if ($thisToggler.hasClass('header-slide')) {
                    $sideHeader.toggleClass('active-slide-side-header');
                } else {
                    if ($thisToggler.parent().hasClass('header_side_right')) {
                        $body.toggleClass('active-side-header slide-right');
                    } else {
                        $body.toggleClass('active-side-header');
                    }
                    $body.parent().toggleClass('html-active-push-header');
                }
                //fixing mega menu and aside affix on toggling side sticked header
                if ($thisToggler.closest('.header_side_sticked').length) {
                    initMegaMenu(600);
                    var $affixAside = $('.affix-aside');
                    if ($affixAside.length) {
                        $affixAside.removeClass("affix affix-bottom").addClass("affix-top").css({
                            "width": "",
                            "left": ""
                        }).trigger('affix-top.bs.affix');
                        setTimeout(function () {
                            $affixAside.removeClass("affix affix-bottom").addClass("affix-top").css({
                                "width": "",
                                "left": ""
                            }).trigger('affix-top.bs.affix');
                        }, 10);
                    }
                }
            });
            //hidding side header on click outside header
            $body.on('mousedown touchstart', function (e) {
                if (!($(e.target).closest('.page_header_side').length) && !($sideHeader.hasClass('header_side_sticked'))) {
                    $sideHeader.removeClass('active-slide-side-header');
                    $body.removeClass('active-side-header slide-right');
                    $body.parent().removeClass('html-active-push-header');
                    var $toggler = $('.toggle_menu_side');
                    if (($toggler).hasClass('active')) {
                        $toggler.removeClass('active');
                    }
                }
            });
        } //sideHeader check

        //1 and 2/3/4th level offscreen fix
        var MainWindowWidth = $window.width();
        $window.on('resize', function () {
            MainWindowWidth = $(window).width();
        });
        //2/3/4 levels
        $('.top-nav .sf-menu').on('mouseover', 'ul li', function () {
            // $('.mainmenu').on('mouseover', 'ul li', function(){
            if (MainWindowWidth > 991) {
                var $this = $(this);
                // checks if third level menu exist
                var subMenuExist = $this.find('ul').length;
                if (subMenuExist > 0) {
                    var subMenuWidth = $this.find('ul, div').first().width();
                    var subMenuOffset = $this.find('ul, div').first().parent().offset().left + subMenuWidth;
                    // if sub menu is off screen, give new position
                    if ((subMenuOffset + subMenuWidth) > MainWindowWidth) {
                        var newSubMenuPosition = subMenuWidth + 0;
                        $this.find('ul, div').first().css({
                            left: -newSubMenuPosition,
                        });
                    } else {
                        $this.find('ul, div').first().css({
                            left: '100%',
                        });
                    }
                }
            }
            //1st level
        }).on('mouseover', '> li', function () {
            if (MainWindowWidth > 991) {
                var $this = $(this);
                var subMenuExist = $this.find('ul').length;
                if (subMenuExist > 0) {
                    var subMenuWidth = $this.find('ul').width();
                    var subMenuOffset = $this.find('ul').parent().offset().left;
                    // if sub menu is off screen, give new position
                    if ((subMenuOffset + subMenuWidth) > MainWindowWidth) {
                        var newSubMenuPosition = MainWindowWidth - (subMenuOffset + subMenuWidth);
                        $this.find('ul').first().css({
                            left: newSubMenuPosition,
                        });
                    }
                }
            }
        });

        /////////////////////////////////////////
        //single page localscroll and scrollspy//
        /////////////////////////////////////////
        var navHeight = $('.page_header').outerHeight(true);
        //if sidebar nav exists - binding to it. Else - to main horizontal nav
        if ($('.mainmenu_side_wrapper').length) {
            $body.scrollspy({
                target: '.mainmenu_side_wrapper',
                offset: navHeight
            });
        } else if ($('.top-nav').length) {
            $body.scrollspy({
                target: '.top-nav',
                offset: navHeight
            })
        }
        if ($().localScroll) {
            $('.top-nav > ul, .mainmenu_side_wrapper > ul, #land,  .comments-link').localScroll({
                duration: 900,
                easing: 'easeInOutQuart',
                offset: -navHeight + 40
            });
        }

        //toTop
        if ($().UItoTop) {
            $().UItoTop({easingType: 'easeInOutQuart'});
        }

        //parallax
        if ($().parallax) {
            $('.s-parallax').parallax("50%", 0.01);
        }


        //search modal
        $(".search_modal_button").on('click', function (e) {
            e.preventDefault();
            $('#search_modal').modal('show').find('input').first().focus();
        });
        //search form processing - not need in WP
        $('form.searchform, form.search-form').on('submit', function (e) {

            e.preventDefault();
            var $form = $(this);
            var $searchModal = $('#search_modal');
            $searchModal.find('div.searchform-respond').remove();

            //checking on empty values
            $($form).find('[type="text"], [type="search"]').each(function (index) {
                var $thisField = $(this);
                if (!$thisField.val().length) {
                    $thisField
                        .addClass('invalid')
                        .on('focus', function () {
                            $thisField.removeClass('invalid')
                        });
                }
            });
            //if one of form fields is empty - exit
            if ($form.find('[type="text"]').hasClass('invalid')) {
                return;
            }

            $searchModal.modal('show');
            //sending form data to PHP server if fields are not empty
            var request = $form.serialize();
            var ajax = jQuery.post("search.php", request)
                .done(function (data) {
                    $searchModal.append('<div class="searchform-respond">' + data + '</div>');
                })
                .fail(function (data) {
                    $searchModal.append('<div class="searchform-respond">Search cannot be done. You need PHP server to search.</div>');

                })
        });

    }

    documentReadyInit()
})(jQuery);