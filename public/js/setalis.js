$.fn.dataTable.ext.errMode = 'none';

const sidebarToggle = document.body.querySelector('#sidebarToggle');
if (sidebarToggle) {    
    
    const isMobile = window.matchMedia('only screen and (max-width: 768px)').matches;

    if (localStorage.getItem('sb|sidebar-toggle') === 'true' && !isMobile) {
        document.body.classList.toggle('sb-sidenav-toggled');
    }

    sidebarToggle.addEventListener('click', event => {
        event.preventDefault();
        document.body.classList.toggle('sb-sidenav-toggled');

        localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
    });
}

window.addEventListener('load', (event) => {    
    if(document.location.pathname.indexOf("/page/") != -1) {
      var route = document.location.origin + document.location.pathname.replace("/page", "");
      menu(route);    
    }
  });

  window.addEventListener('popstate', function(_) {
    var route = window.location.origin + window.location.pathname.replace("/page", "");
    menu(route);

  }, false);

  document.body.addEventListener('click', function (evt) {
    if (evt.target.classList.contains('targetMenu')) {
        menu(evt.target.dataset.route, evt);

        const isMobile = window.matchMedia('only screen and (max-width: 768px)').matches;

        if (localStorage.getItem('sb|sidebar-toggle') === 'true' && isMobile) {
            document.body.classList.remove('sb-sidenav-toggled');
        }
    }
  }, false);

  function back() {
    history.back();

    var query = new URLSearchParams(window.location.search);
    let title = query.get("title");

    document.title = title + " · " + document.title.split(" · ").pop();
  }

  function menu(address, evt) {
    var targetAddress = address;

    loaderPage(true);
    
    if (navigator.onLine) {
        $.ajax({
            url : targetAddress,
            success : function(result){        
            loaderPage(false);

            $("#page-content-wrapper").html(result);             
            replaceFormValiation();
    
            $("#buttonSideBar").html($("#buttonsPindah").html());
            $("#buttonsPindah").html("");
    
            if(evt != null) {
    
                if(!evt.target.classList.contains('nomenu')) {
                    var parentCollapse = document.querySelector("a.nav-link.active")?.parentNode.getElementsByTagName("div")[0];
    
                    document.querySelector("a.targetMenu.active")?.classList.remove("active");
                    document.querySelector("a.nav-link.toggle.active")?.classList.add("collapsed");
                    document.querySelector("a.nav-link.active")?.classList.remove("active");
                }
                
                document.title = evt.target.dataset.title + " · " + document.title.split(" · ").pop();
    
                var exploded = evt.target.dataset.route.split("/");
                var route = exploded[exploded.length - 1];       
    
                if(evt.target.dataset.route.indexOf("/public/") != -1) {
                    var split = evt.target.dataset.route.split("/public/");
    
                    if(exploded.length == 7) {
                        route = exploded[exploded.length - 2] + "/" + exploded[exploded.length - 1];
                    }
                    var change = split.slice(0, split.length - 1).join("/") + "/public/page/" + route + "?title=" + evt.target.dataset.title; 
    
                }else{
                    var split = evt.target.dataset.route.split("/page/");
    
                    if(exploded.length == 5) {
                        route = exploded[exploded.length - 2] + "/" + exploded[exploded.length - 1];
                    }
                    var change = split.slice(0, split.length - 1).join("/") + "/page/" + route + "?title=" + evt.target.dataset.title; 
    
                }
    
                window.history.pushState(route, evt.target.dataset.title, change);

                if(!evt.target.classList.contains('nomenu')) {
                    if(parentCollapse != evt.target.closest('div.collapse')) {
                        parentCollapse?.classList.remove("show")
                    }
        
                    evt.target.classList.add("active");
                    evt.target.closest('div.collapse')?.classList.add("show");
                    evt.target.closest('li.nav-item')?.firstElementChild.classList.add("active")
                }
            }
                
            var query = new URLSearchParams(window.location.search);
            if(query.get("message_id") !== null) {
                lodDetailMail(query.get("message_id"));
            }   


            }, error: function(e) {
            loaderPage(false);
            }
        });
    }
  }

function replaceValidationUI( form ) {
    // Suppress the default bubbles
    form.addEventListener( "invalid", function( event ) {
        event.preventDefault();
    }, true );

    // Support Safari, iOS Safari, and the Android browser—each of which do not prevent
    // form submissions by default
    form.addEventListener( "submit", function( event ) {
        if ( !this.checkValidity() ) {
            event.preventDefault();
        }
    });

    var submitButton = form.querySelector( "button:not([type=button]), input[type=submit]" );
    if(submitButton != null) {
        submitButton.addEventListener( "click", function( event ) {
            var invalidFields = form.querySelectorAll( ":invalid" ),
                errorMessages = form.querySelectorAll( ".error-message" ),
                parent;
    
            // Remove any existing messages
            for ( var i = 0; i < errorMessages.length; i++ ) {
                errorMessages[ i ].parentNode.removeChild( errorMessages[ i ] );
            }
    
            for ( var i = 0; i < invalidFields.length; i++ ) {
                parent = invalidFields[ i ].parentNode;
                parent.classList.add("error");
                parent.insertAdjacentHTML( "beforeend", "<div class='error-message'>" + 
                    invalidFields[ i ].validationMessage +
                    "</div>" );
                invalidFields[ i ].addEventListener("change", clearErrorValidationUI);
            }
    
            // If there are errors, give focus to the first invalid field
            if ( invalidFields.length > 0 ) {
                invalidFields[ 0 ].focus();
            }
        });
    }
}

function addErrorField(component, errorMessage) {
    setTimeout(() => {
        var parent = component.parentNode;
        parent.classList.add("error");
        parent.insertAdjacentHTML( "beforeend", "<div class='error-message'>" + 
            errorMessage +
        "</div>" );
        component.addEventListener("change", clearErrorValidationUI);
    }, 500)    

}

function nextByClass(node, cls) {
    while (node = node.nextSibling) {
        if (hasClass(node, cls)) {
            return node;
        }
    }
    return null;
}

function hasClass(elem, cls) {
    var str = " " + elem.className + " ";
    var testCls = " " + cls + " ";
    return(str.indexOf(testCls) != -1) ;
}

function clearErrorValidationUI() {
    this.parentNode.classList.remove("error");
    var childMessage = nextByClass(this, "error-message");
    if(childMessage != null) {
        childMessage.remove();
    }
}

function replaceFormValiation() {
    // Replace the validation UI for all forms
    var forms = document.querySelectorAll( "form" );
    for ( var i = 0; i < forms.length; i++ ) {
        replaceValidationUI( forms[ i ] );
    }
}

replaceFormValiation();

const getBase64 = async(file) => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
});

function customUploadInput() {
    var inputs = document.querySelectorAll( '.custom-file-input' );
    if(inputs != null) {
        Array.prototype.forEach.call( inputs, function( input )
        {
            var label	 = input.nextElementSibling,
                labelVal = label.innerHTML;
        
            input.addEventListener( 'change', function( e )
            {
                label.classList.remove("filled");

                var fileName = '';

                if( this.files && this.files.length > 1 )
                    fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                else
                    fileName = e.target.value.split( '\'' ).pop();
        
                if( fileName ) {
                    label.classList.add("filled");
                    var names = fileName.split('\\');
                    label.innerHTML = names[names.length - 1];
                } else {
                    label.innerHTML = labelVal;
                }
                    
            });
        });
    }
}

var deleteDialog = new bootstrap.Modal('#confirmDeleteDialog');
var onDeleted = function(data) {}

document.getElementById('confirmDeleteDialog').addEventListener('show.bs.modal', event => {
    var method = $(event.relatedTarget).data('method');
    var previous = $(event.relatedTarget).data('previous');
    var route = $(event.relatedTarget).data('route');
    var eid = $(event.relatedTarget).data('eid');

    $('#formDelete').data("route", route);
    $('#formDelete').data("method", method);
    $('#formDelete').data("previous", previous);
    $('#formDelete').data("eid", eid);
})

document.getElementById("dismissButtonDelete").addEventListener('click', event => {
    deleteDialog.hide();
    previousDialogCheck("formDelete", $('#formDelete').data("eid"));
});

function previousDialogCheck(form, id) {
    var previous = $('#'+form).data('previous');

    if(previous != null) {
        var objectDetailButton = $("[data-bs-target='#" + previous + "']");

        if(id != null) {
            objectDetailButton = $("[data-bs-target='#" + previous + "'][data-id='" + id + "']");
        }

        if(objectDetailButton.data("items") != null) {
            objectDetailButton.trigger("click");
        }
    }

    $('#formDelete').data('previous', "");
}

$('#formDelete').on("submit", function(e) {
    e.preventDefault();
    
    var method = $(this).data('method');
    var route = $(this).data('route');

    var formData = $(this).serializeArray().reduce(function(a, x) { a[x.name] = x.value; return a; }, {}); 

    $.ajax({
        url: route,
        type: method,
        data: formData,
        success: function(result) {
            if(!result.success) {
                $("#errorDeleteDialog").text(result.message);
            }else{
                onDeleted(result);
                deleteDialog.hide();
            }
        }, error: function(e) {
            $("#errorDeleteDialog").text(e.responseJSON.message);
        }
    });

    
    return false; 
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },

    statusCode: {
        401: function() {
            console.log("Unauthorized")
            $("#page-content-wrapper").html('<div class="container-fluid main-container hideOnScroll" id="maincontainer"> <div class="row"> <div class="col py-3"> <h1 class="title">Unauthorized</h1> </div> </div> </div>')
        }
    }
});

var last = 0;

document.getElementById("wrapper").addEventListener("scroll", scrolling);

function scrolling() {
    var pos = document.getElementById("wrapper").scrollTop;
    
    if (pos > last) {
        $(".hideOnScroll").addClass("scrolled");
    } else {
        $(".hideOnScroll").removeClass("scrolled");
    }

   last = pos;

}

function loader(state) {
    if (navigator.onLine) {
        if(state) {
            $(".loading-dialog").removeClass("d-none");
        }else{
            $(".loading-dialog").addClass("d-none");
        }
    }
}

function loaderPage(state) {
    if (navigator.onLine) {
        if(state) {
            $("#loadingpage").removeClass("d-none");
        }else{
            $("#loadingpage").addClass("d-none");
        }
    }
}

function humanFileSize(size) {
    var i = size == 0 ? 0 : Math.floor(Math.log(size) / Math.log(1024));
    return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
}

function formatCurrency(nilai) {
    let format = new Intl.NumberFormat();    

    return format.format(nilai);
}

let numberMask = { radixPoint: '.', digits: 0, prefix: "", rightAlign: false };
let nilaiMask = { radixPoint: '.', digits: 0, prefix: "Rp", rightAlign: false };
let persentaseMask = { radixPoint: '.', digits: 0, prefix: "", suffix: "%", rightAlign: false };