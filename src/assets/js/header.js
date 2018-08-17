var getStyle = function (e, styleName) {
    var styleValue = "";
    if(document.defaultView && document.defaultView.getComputedStyle) {
        styleValue = document.defaultView.getComputedStyle(e, "").getPropertyValue(styleName);
    }
    else if(e.currentStyle) {
        styleName = styleName.replace(/\-(\w)/g, function (strMatch, p1) {
            return p1.toUpperCase();
        });
        styleValue = e.currentStyle[styleName];
    }
    return styleValue;
};


$(document).ready(function() {

    /*
    var menuEl = document.querySelector('#demo-menu');
    var menu = new mdc.menu.MDCMenu(menuEl);
    var menuButtonEl = document.querySelector('.menu-button');
    menuButtonEl.addEventListener('click', function () {
        console.log("HelloWorld");
        menu.open = !menu.open;
    });
    */

    $('a[data-toggle="submenu-mobile"]').click(function(){
       var li = $(this).parent()[0];
       var ul = $($(li).children(".mdc-list"))[0];

       if($(ul).height() > 0){
           //console.log($($(this).find('.caret'))[0]);
           $($($(this).find('.caret'))[0]).replaceWith('<span class="caret">&#9660;</span>');
           //$(li).css('padding-top', 'unset');
           $(ul).css('max-height', '0');
           $(ul).css('transition', 'max-height 0.15s ease-out');
           $(ul).css('-webkit-transition', 'max-height 0.15s ease-out');
           $(ul).css('-moz-transition', 'max-height 0.15s ease-out');
       } else {
           //console.log($($(this).find('.caret'))[0]);
           $($($(this).find('.caret'))[0]).replaceWith('<span class="caret">&#9650;</span>');
           //$(li).css('padding-top', '12px');
           $(ul).css('max-height', '100vh');
           $(ul).css('transition', 'max-height 0.25s ease-in');
           $(ul).css('-webkit-transition', 'max-height 0.25s ease-in');
           $(ul).css('-moz-transition', 'max-height 0.25s ease-in');
       }

    });


    $('a[data-toggle="submenu"]').click(function(e){
        var a = $($($(this)[0]).find('.caret')[0]);
        var li = $(this).parent()[0];
        var div = $($(li).children(".mdc-menu"))[0];

        a.replaceWith('<span class="caret">&#9650;</span>');

        var raised = ($(div).data('depth') > 0) ? 'mdc-button--raised' : '';

        $($(this).children('.menu_element')[0]).addClass('expanded ' + raised);

        //var menuEl = document.querySelector('#demo-menu');
        var menuTest = new mdc.menu.MDCMenu(div);

        menuTest.open = !menuTest.open;

        div.addEventListener('MDCMenu:cancel', function() {
            //console.log( $($($($(this).parent())[0]).children('a')[0]).children('.menu_element')[0] );
            //$($(this).children('.menu_element')[0]).removeClass('expanded');
            $($($($($(this).parent())[0]).children('a')[0]).find('.caret')[0]).replaceWith('<span class="caret">&#9660;</span>');
            $($($($($(this).parent())[0]).children('a')[0]).children('.menu_element')[0]).removeClass('expanded mdc-button--raised');

        });


    });

    //var myFlexibleHeaderLogo = document.querySelector("#logo");
    var myFlexibleHeaderLogo = $('#logo');
    //var myFlexibleHeaderTitle = document.querySelector(".mdc-toolbar__title");
    var myFlexibleHeaderTitle = $('#title');
    //var arrow = document.querySelector(".arrow");
    var arrow = $("#arrow");
    //var text = document.querySelector("#inv");
    var text = $("#inv");
    var toolbar = mdc.toolbar.MDCToolbar.attachTo(document.querySelector(".mdc-toolbar"));

    //var leftMarginLogo = parseInt(getStyle(myFlexibleHeaderLogo, 'margin-left').replace('px', ''));
    //var leftMarginLogo = parseInt(myFlexibleHeaderLogo.css('marginLeft').replace('px', ''));
    var leftMarginLogo = parseInt(myFlexibleHeaderLogo.offset().left);
    //var leftMarginTitle = parseInt(getStyle(myFlexibleHeaderTitle, 'margin-left').replace('px', ''));
    //var leftMarginTitle = parseInt(myFlexibleHeaderTitle.css('marginLeft').replace('px', ''));
    var leftMarginTitle = parseInt(myFlexibleHeaderTitle.offset().left);

    toolbar.listen('MDCToolbar:change', function(evt) {
        var flexibleExpansionRatio = evt.detail.flexibleExpansionRatio;

        var normalizedLeftMarginLogo = (flexibleExpansionRatio*(leftMarginLogo-0))+0;
        var normalizedLeftMarginTitle = (flexibleExpansionRatio*(leftMarginTitle+100))-100;

        console.log(normalizedLeftMarginTitle);

        //myFlexibleHeaderLogo.style.marginLeft = normalizedLeftMarginLogo+"px";
        myFlexibleHeaderLogo.css('marginLeft', normalizedLeftMarginLogo+'px');
        //myFlexibleHeaderTitle.style.marginLeft = normalizedLeftMarginTitle+"px";
        myFlexibleHeaderTitle.css('marginLeft', normalizedLeftMarginTitle+'px');
        //arrow.style.opacity = flexibleExpansionRatio;
        arrow.css('opacity', flexibleExpansionRatio);
        //text.style.opacity = flexibleExpansionRatio;
        text.css('opacity', flexibleExpansionRatio);

        if(flexibleExpansionRatio < 1) {
            $('#menu_section').removeClass('expanded');
        } else {
            $('#menu_section').addClass('expanded');
        }

    });

    toolbar.fixedAdjustElement = document.querySelector('.mdc-toolbar-fixed-adjust');
});

/*$(window).resize(function() {
    location.reload();
});*/

$('#scrolldown').click(function() {
    $.scrollTo('#content', 800);
});

$('#menuBtn').click(function() {
    console.log("Menu Button clicked");
    let drawer = new mdc.drawer.MDCTemporaryDrawer(document.querySelector('.mdc-drawer--temporary'));
    drawer.open = true;
});


var getMaterialIcon = function(classes) {
    console.log(classes);
}

/*
$(document).ready(function() {
    var drawerEl = document.querySelector('.mdc-drawer');
    var MDCTemporaryDrawer = mdc.drawer.MDCTemporaryDrawer;
    var drawer = new MDCTemporaryDrawer(drawerEl);
    document.querySelector('#menuBtn').addEventListener('click', function() {
        drawer.open = true;
    });
    drawerEl.addEventListener('MDCTemporaryDrawer:open', function() {
        console.log('Received MDCTemporaryDrawer:open');
    });
    drawerEl.addEventListener('MDCTemporaryDrawer:close', function() {
        console.log('Received MDCTemporaryDrawer:close');
    });

    // Demonstrate application of --activated modifier to drawer menu items
    var activatedClass = 'mdc-list-item--selected';
    document.querySelector('.mdc-drawer__drawer').addEventListener('click', function(event) {
        var el = event.target;
        while (el && !el.classList.contains('mdc-list-item')) {
            el = el.parentElement;
        }
        if (el) {
            var activatedItem = document.querySelector('.' + activatedClass);
            if (activatedItem) {
                activatedItem.classList.remove(activatedClass);
            }
            event.target.classList.add(activatedClass);
        }
    });

    var radioEl = document.querySelector('#demo-radio-buttons');
    radioEl.addEventListener('change', function(e) {
        drawerEl.classList.remove('demo-drawer--custom');
        drawerEl.classList.remove('demo-drawer--accessible');

        if(e.target.id === 'theme-radio-accessible') {
            drawerEl.classList.add('demo-drawer--accessible');
        } else if(e.target.id === 'theme-radio-custom') {
            drawerEl.classList.add('demo-drawer--custom');
        }
    });

    var rtlToggleBtn = document.querySelector('.demo-toolbar-example-heading__rtl-toggle-button');
    rtlToggleBtn.addEventListener('click', function(event) {
        document.body.setAttribute('dir', document.body.getAttribute('dir') === 'rtl' ? 'ltr' : 'rtl');
    });
});
*/