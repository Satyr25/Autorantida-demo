$(document).ready(function(){
    
    function blogAlturaTitulo(midiv) {
        var alto = 0;
        midiv.each(function() {
            altura = $(this).height();
            if(altura > alto) {
                alto = altura;
            }
        });
        midiv.height(alto);
    }
    
    function blogAlturaAutor(midiv) {
        var alto = 0;
        midiv.each(function() {
            altura = $(this).height();
            if(altura > alto) {
                alto = altura;
            }
        });
        midiv.height(alto);
    }
    
    function blogAlturaResumen(midiv) {
        
        var alto = 0;
        midiv.each(function() {
            altura = $(this).height();
            if(altura > alto) {
                alto = altura;
            }
        });
        midiv.height(alto);
    }
    
    function blogAlturaImg(midiv) {
        var alto = 0;
        midiv.each(function() {
            altura = $(this).height();
            if(altura > alto) {
                alto = altura;
            }
        });
        midiv.height(alto);
    }

    function numero_coma(num){
        var num_parts = num.toString().split(".");
        num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return num_parts.join(".");
    }

    function cc_format(value) {
        var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '')
        var matches = v.match(/\d{4,16}/g);
        var match = matches && matches[0] || ''
        var parts = []
        for (i=0, len=match.length; i<len; i+=4) {
          parts.push(match.substring(i, i+4))
        }
        if (parts.length) {
          return parts.join(' ')
        } else {
          return value
        }
    }
    function vencimiento_format(value) {
        var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '')
        var matches = v.match(/\d{2,4}/g);
        var match = matches && matches[0] || ''
        var parts = []
        for (i=0, len=match.length; i<len; i+=2) {
          parts.push(match.substring(i, i+2))
        }
        if (parts.length) {
          return parts.join('/')
        } else {
          return value
        }
    }
    function conekta_expiracion1(fecha){
        fecha = fecha.substr(0,2);
//        fecha = parseInt(fecha);
        return fecha;
    }
    function conekta_expiracion2(fecha){
        fecha = fecha.substr(3,5);
        fecha = '20'+fecha;
//        fecha = parseInt(fecha);
        return fecha;
    }
    
    var emailPattern = "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$";
    function checkCorreo(idInput, pattern) {
        return $(idInput).val().match(pattern) ? true : false;
    }
    
    function telefono_format(value) {
        var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '')
        var matches = v.match(/\d{2,10}/g);
        var match = matches && matches[0] || ''
        var parts = []
        for (i=0, len=match.length; i<len; i+=2) {
          parts.push(match.substring(i, i+2))
        }
        if (parts.length) {
          return parts.join(' ')
        } else {
          return value
        }
    }
    
    
    
    
    
    blogAlturaImg($('.blog-img-wrap'));
    blogAlturaTitulo($('.blog-titulo-wrap'));
    blogAlturaAutor($('.blog-autor-wrap'));
    blogAlturaResumen($('.blog-resumen-wrap'));
//    solucionAltura($('.solucion-wrap'));
    
    
    
    
    $('.desplegar-menu').on('click', function(){
        $(this).toggleClass('desplegado');
        if(!$(this).hasClass('desplegado')){
            $('body').removeClass('no-scroll');
            $('.collapse').hide();
            $('.navbar-pink').css('background-color', '#efe0e4')
            $('.navbar-white').css('background-color', '#efe0e4')
            $('.nav-logo').show();
            $('.nav-logo-rosa').hide();
        }else{
            $('body').addClass('no-scroll');
            $('.collapse').show();
            $('.navbar-pink').css('background-color', 'rgba(0, 0, 0, 0.9)');
            $('.navbar-white').css('background-color', 'rgba(0, 0, 0, 0.9)');
            $('.nav-logo-rosa').show();
            $('.nav-logo').hide();
        }

    });
    
    $('.blog-selector-tema').click(function(){
        $('.blog-temas').toggle();
    });
    
    $('.cerrar-modal').hover(function(){
       $('.img-cerrar-modal').toggle() 
       $('.img-cerrar-modal-hover').toggle() 
    });
    $('.cerrar-modal').click(function(){
        $('.col-numero-cotizar').css('display', 'none');
    })
    $('.col-input-cotizar').click(function(){
        $('.input-cotizar').focus();
    });
    
    $('.ir-paso-1').click(function(){
        $('.ver-paso-1').css('display', 'block')
        $('.ver-paso-2').css('display', 'none')
        $('.ver-paso-3').css('display', 'none')
        $('.checkout-paso-1').addClass('paso-seleccionado')
        $('.checkout-paso-2').removeClass('paso-seleccionado')
        $('.checkout-paso-3').removeClass('paso-seleccionado')
        $('.btn-realizar-pago').addClass('btn-disabled')
        $('.btn-realizar-pago').removeClass('realizar-pago')
        $('.btn-pedido-form').removeClass('realizar-pago')
        $('.btn-realizar-pago').prop('disabled', true)
        $('.btn-pedido-form').prop('disabled', true)
    })
    $('.ir-paso-2').click(function(){
        $('.ver-paso-1').css('display', 'none')
        $('.ver-paso-2').css('display', 'block')
        $('.ver-paso-3').css('display', 'none')
        $('.checkout-paso-1').removeClass('paso-seleccionado')
        $('.checkout-paso-2').addClass('paso-seleccionado')
        $('.checkout-paso-3').removeClass('paso-seleccionado')
        $('.btn-realizar-pago').addClass('btn-disabled')
        $('.btn-realizar-pago').removeClass('realizar-pago')
        $('.btn-pedido-form').removeClass('realizar-pago')
        $('.btn-realizar-pago').prop('disabled', true)
        $('.btn-pedido-form').prop('disabled', true)
    })
    $('.ir-paso-3').click(function(){
//        alert($('input[name=forma-pago]:checked').val())
        
        if($('input[name=forma-pago]:checked').val() == undefined ||
            !checkCorreo($('.correo-cliente-form'), emailPattern) ||
            $('.nombre-cliente-form').val() == '' ||
            $('.apellido-cliente-form').val() == '' ||
            $('.telefono-cliente-form').val().length != 14 ||
            $('.celular-cliente-form').val().length != 14
        ) {
            if($('input[name=forma-pago]:checked').val() == undefined){
                $('.error-forma-pago').show();
            } else {
                $('.error-forma-pago').hide();
            }
            if(!checkCorreo($('.correo-cliente-form'), emailPattern)) {
                $('.error-correo-pago').show();
            } else {
                $('.error-correo-pago').hide();
            }
            if($('.nombre-cliente-form').val() == ''){
                $('.error-nombre-pago').show();        
            } else {
                $('.error-nombre-pago').hide();        
            }
            if($('.apellido-cliente-form').val() == '') {
                $('.error-apellido-pago').show();
            } else {
                $('.error-apellido-pago').hide();
            }
            if($('.celular-cliente-form').val().length != 14){
                $('.error-celular-pago').show();  
            } else{
                $('.error-celular-pago').hide();  
            }
            if($('.telefono-cliente-form').val().length != 14){
                $('.error-telefono-pago').show();  
            } else{
                $('.error-telefono-pago').hide();  
            }
            
        } else if($('input[name=forma-pago]:checked').val() == 'tarjeta'){
            if(
                $('.numero-tarjeta-form').val().length < 19 || 
                $('.nombre-tarjeta-form').val().length < 1 ||
                $('.fecha-tarjeta-form').val().length < 5 ||
                $('.codigo-tarjeta-form').val().length < 3
              ){
                $('.error-datos-pago').show()            
            } else {
                $('.error-datos-pago').hide()   
                $('.error-forma-pago').hide()            
                $('.error-nombre-pago').hide()            
                $('.error-apellido-pago').hide()            
                $('.error-correo-pago').hide()            
                $('.error-telefono-pago').hide()            
                $('.error-celular-pago').hide()        
                $('.ver-paso-1').css('display', 'none')
                $('.ver-paso-2').css('display', 'none')
                $('.ver-paso-3').css('display', 'block')
                $('.checkout-paso-1').removeClass('paso-seleccionado')
                $('.checkout-paso-2').removeClass('paso-seleccionado')
                $('.checkout-paso-3').addClass('paso-seleccionado')
                $('.txt-metodo-pago').text($('input[name=forma-pago]:checked').val())
                $('.pago-paypal-3').hide();
                $('.pago-efectivo-3').hide();
                $('.pago-tarjeta-3').show();
                $('.datos-cliente-3').show();
                $('.paso-3-cliente-nombre').text($('.nombre-cliente-form').val());
                $('.paso-3-apellido').text($('.apellido-cliente-form').val());
                $('.paso-3-correo').text($('.correo-cliente-form').val());
                $('.paso-3-telefono').text($('.telefono-cliente-form').val());
                $('.paso-3-celular').text($('.celular-cliente-form').val());
                $('.paso-3-tarjeta').text('**** **** **** '+$('.numero-tarjeta-form').val().slice(15, 19));
                $('.paso-3-nombre').text($('.nombre-tarjeta-form').val());
                $('.paso-3-fecha').text($('.fecha-tarjeta-form').val());
                if ($('.codigo-tarjeta-form').val().length == 3 ){
                    $('.paso-3-seguridad').text('***');
                } else if ($('.codigo-tarjeta-form').val().length == 4 ) {
                    $('.paso-3-seguridad').text('****');
                }
                if($('.check-terminos:checked').val() == 'on'){
                    $('.btn-realizar-pago').removeClass('btn-disabled')
                    $('.btn-realizar-pago').addClass('realizar-pago')
                    $('.btn-pedido-form').addClass('realizar-pago')
                    $('.btn-realizar-pago').prop('disabled', false)
                } else {
                    $('.btn-realizar-pago').addClass('btn-disabled')
                    $('.btn-realizar-pago').removeClass('realizar-pago')
                    $('.btn-pedido-form').removeClass('realizar-pago')
                    $('.btn-realizar-pago').prop('disabled', true)
                    $('.btn-pedido-form').prop('disabled', true)
                }
            }
        } else {
            $('.error-datos-pago').hide()   
            $('.error-forma-pago').hide()            
            $('.error-nombre-pago').hide()            
            $('.error-apellido-pago').hide()            
            $('.error-correo-pago').hide()            
            $('.error-telefono-pago').hide()            
            $('.error-celular-pago').hide()          
            $('.datos-cliente-3').show();
            $('.paso-3-cliente-nombre').text($('.nombre-cliente-form').val());
            $('.paso-3-apellido').text($('.apellido-cliente-form').val());
            $('.paso-3-correo').text($('.correo-cliente-form').val());
            $('.paso-3-telefono').text($('.telefono-cliente-form').val());
            $('.paso-3-celular').text($('.celular-cliente-form').val());  
            $('.ver-paso-1').css('display', 'none')
            $('.ver-paso-2').css('display', 'none')
            $('.ver-paso-3').css('display', 'block')
            $('.checkout-paso-1').removeClass('paso-seleccionado')
            $('.checkout-paso-2').removeClass('paso-seleccionado')
            $('.checkout-paso-3').addClass('paso-seleccionado')
            $('.txt-metodo-pago').text($('input[name=forma-pago]:checked').val())
            if($('.check-terminos:checked').val() == 'on'){
                $('.btn-realizar-pago').removeClass('btn-disabled')
                $('.btn-realizar-pago').addClass('realizar-pago')
                $('.btn-pedido-form').addClass('realizar-pago')
                $('.btn-realizar-pago').prop('disabled', false)
            } else {
                $('.btn-realizar-pago').addClass('btn-disabled')
                $('.btn-realizar-pago').removeClass('realizar-pago')
                $('.btn-pedido-form').removeClass('realizar-pago')
                $('.btn-realizar-pago').prop('disabled', true)
                $('.btn-pedido-form').prop('disabled', true)
            }
        }
        if($('input[name=forma-pago]:checked').val() == 'efectivo'){
            $('.pago-paypal-3').hide();
            $('.pago-efectivo-3').show();
            $('.pago-tarjeta-3').hide();
        } else if($('input[name=forma-pago]:checked').val() == 'paypal'){
            $('.pago-paypal-3').show();
            $('.pago-efectivo-3').hide();
            $('.pago-tarjeta-3').hide();
        }
        
    })
    $('.check-terminos').click(function(){
        if($('.checkout-paso-3').hasClass('paso-seleccionado')){
            if($('.check-terminos:checked').val() == 'on'){
                if($('input[name=forma-pago]:checked').val() == 'tarjeta'){
                    if(
                        $('.numero-tarjeta-form').val().length == 19 || 
                        $('.nombre-tarjeta-form').val().length > 0 ||
                        $('.fecha-tarjeta-form').val().length == 5 ||
                        $('.codigo-tarjeta-form').val().length >= 3
                      ){
                        $('.btn-realizar-pago').removeClass('btn-disabled')
                        $('.btn-realizar-pago').addClass('realizar-pago')
                        $('.btn-pedido-form').addClass('realizar-pago')
                        $('.btn-realizar-pago').prop('disabled', false)
                    }
                } else if($('input[name=forma-pago]:checked').val() !== undefined){
                    $('.btn-realizar-pago').removeClass('btn-disabled')
                    $('.btn-realizar-pago').addClass('realizar-pago')
                    $('.btn-pedido-form').addClass('realizar-pago')
                    $('.btn-realizar-pago').prop('disabled', false)
                }
            } else {
                $('.btn-realizar-pago').addClass('btn-disabled')
                $('.btn-realizar-pago').removeClass('realizar-pago')
                $('.btn-pedido-form').removeClass('realizar-pago')
                $('.btn-realizar-pago').prop('disabled', true)
                $('.btn-pedido-form').prop('disabled', true)
            }
        }
    })
    
    $('.btn-agregar-solucion').click(function(){
        var clave = $(this).data('clave');
        $('.solucion-form-'+clave).submit(function(event){
            event.preventDefault();
        })
//        alert(clave);
        var data = $('.solucion-form-'+clave).serializeArray();
        var url = $('.solucion-form-'+clave).attr('action');
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(resp){
                var mensaje = resp.mensaje;
                var exito = resp.exito;
                if (exito == 0){
                    alert(mensaje);
                } else if ( exito == 1){
                    $('.cerrar-modal').trigger('click');
                    $('.btn-modal-2-'+clave).trigger('click');
                }
            },
            error: function(){
                alert('Error algo ha salido mal.');
            },
        })
    })
    
    $('.btn-realizar-pago').click(function(){
        $('.pedido-form').submit(function(event){
            event.preventDefault();
        })
        if($('.btn-realizar-pago').hasClass('realizar-pago') && $('.btn-pedido-form').hasClass('realizar-pago')){
            
            $('.btn-realizar-pago').addClass('btn-disabled')
            $('.btn-realizar-pago').removeClass('realizar-pago')
            $('.btn-pedido-form').removeClass('realizar-pago')
            $('.btn-realizar-pago').prop('disabled', true)
            $('.btn-pedido-form').prop('disabled', true)
            
            $('#pedidos-nombre').val($('.nombre-cliente-form').val());
            $('#pedidos-apellidos').val($('.apellido-cliente-form').val());
            $('#pedidos-correo').val($('.correo-cliente-form').val());
            $('#pedidos-telefono').val($('.telefono-cliente-form').val());
            $('#pedidos-celular').val($('.celular-cliente-form').val());
            $('#pedidos-pago_clave').val($('input[name=forma-pago]:checked').data('clave'));
            
            if($('input[name=forma-pago]:checked').val() == 'efectivo'){
                var data = $('.pedido-form').serializeArray();
                var producto = new Array();
                $('.producto-each').each(function(i){
                    var clave = $('.producto-each-'+i+'').data('clave');
                    if(clave == 'IMPR'){
                        var cantidad = $('.producto-each-'+i+'').data('cantidad');
                        var papel_interior_id = $('.producto-each-'+i+'').data('interior');
                        var papel_portada_id = $('.producto-each-'+i+'').data('portada');
                        var retractil_id = $('.producto-each-'+i+'').data('retractil');
                        var solapas_id = $('.producto-each-'+i+'').data('solapas');
                        var tiraje = $('.producto-each-'+i+'').data('tiraje');
                        producto[i] = ({name:clave, quantity:cantidad, papel_interior_id:papel_interior_id, papel_portada_id:papel_portada_id, retractil_id:retractil_id, solapas_id:solapas_id, tiraje:tiraje});
                    } else {
                        var clave = $('.producto-each-'+i+'').data('clave');
                        var cantidad = $('.producto-each-'+i+'').data('cantidad');
                        producto[i] = ({name: clave, quantity:cantidad});
                    }
                });
                var url = $('.pedido-form').attr('action');
                var productos = JSON.stringify(producto);
                data.push({name:'productos', value:productos});
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: data,
                    success: function(resp){
                        var mensaje = resp.mensaje;
                        var exito = resp.exito;
                        if (exito == 0){
                            alert(resp.mensaje);
                        } else if ( exito == 1){
                            window.location = 'confirmacion?pedido='+resp.clave;
                        }
                    },
                    error: function(error){
                        alert('Error algo ha salido mal.');
                    },
                })
            }
            if($('input[name=forma-pago]:checked').val() == 'tarjeta'){
                
                var producto = new Array();
                $('.producto-each').each(function(i){
                    var clave = $('.producto-each-'+i+'').data('clave');
                    if(clave == 'IMPR'){
                        var cantidad = $('.producto-each-'+i+'').data('cantidad');
                        var papel_interior_id = $('.producto-each-'+i+'').data('interior');
                        var papel_portada_id = $('.producto-each-'+i+'').data('portada');
                        var retractil_id = $('.producto-each-'+i+'').data('retractil');
                        var solapas_id = $('.producto-each-'+i+'').data('solapas');
                        var tiraje = $('.producto-each-'+i+'').data('tiraje');
                        producto[i] = ({clave:clave, cantidad:cantidad, papel_interior_id:papel_interior_id, papel_portada_id:papel_portada_id, retractil_id:retractil_id, solapas_id:solapas_id, tiraje:tiraje});
                    } else {
                        var clave = $('.producto-each-'+i+'').data('clave');
                        var cantidad = $('.producto-each-'+i+'').data('cantidad');
                        producto[i] = ({name: clave, quantity:cantidad});
                    }
                });
                var url = $('.pedido-form').attr('action');

                var productos = JSON.stringify(producto);
                
                var numero = $('.numero-tarjeta-form').val();
                var nombre = $('.nombre-tarjeta-form').val();
                var exp_month = conekta_expiracion1($('.fecha-tarjeta-form').val());
                var exp_year = conekta_expiracion2($('.fecha-tarjeta-form').val());
                var cvc = $('.codigo-tarjeta-form').val();
                
                var tokenParams = {
                    "card": {
                        "number": numero,
                        "name": nombre,
                        "exp_year": exp_year,
                        "exp_month": exp_month,
                        "cvc": cvc
                    }
                };
                
                var data = $('.pedido-form').serializeArray(); 
                data.push({name:'productos', value:productos});

                if(!Conekta.card.validateNumber(numero)){
                    alert('El número de tarjeta no es válido.')
                    $('.ir-paso-2').trigger('click');
                    return;
                };
                if(!Conekta.card.validateExpirationDate(exp_month, exp_year)){
                    alert('El fecha de expiración de la tarjeta no es válido.')
                    $('.ir-paso-2').trigger('click');
                    return;
                };
                if(!Conekta.card.validateCVC(cvc)){
                    alert('El código de seguridad de la tarjeta no es válido.')
                    $('.ir-paso-2').trigger('click');
                    return;
                }
                Conekta.setPublicKey($('#pedidos-tok').val());
                Conekta.Token.create(tokenParams, function(token){
                    token = JSON.stringify(token);
                    data.push({name:'token', value:token});
                    $.ajax({
                        url: url,
                        type: 'post',
                        dataType: 'json',
                        data: data,
                        success: function(resp){
                            var mensaje = resp.mensaje;
                            var exito = resp.exito;
                            if (exito == 0){
                                alert(resp.mensaje);
                            } else if ( exito == 1){
                                window.location = 'confirmacion?pedido='+resp.clave;
                            }
                        },
                        error: function(error){
                            alert('Error algo ha salido mal.');
                        },
                    })
                });
            };
        }
    })
    
    $('.fecha-tarjeta-form').keyup(function(){
        var vencimiento = vencimiento_format($('.fecha-tarjeta-form').val())
        $('.fecha-tarjeta-form').val(vencimiento)
    })
    $('.numero-tarjeta-form').keyup(function(){
        var vencimiento = cc_format($('.numero-tarjeta-form').val())
        $('.numero-tarjeta-form').val(vencimiento)
    })
    $('.telefono-cliente-form').keyup(function(){
        var telefono = telefono_format($('.telefono-cliente-form').val())
        $('.telefono-cliente-form').val(telefono)
    })
    $('.celular-cliente-form').keyup(function(){
        var telefono = telefono_format($('.celular-cliente-form').val())
        $('.celular-cliente-form').val(telefono)
    })
    
    $('.celular-cliente-form').keydown(function(e){
        var key = e.charCode || e.keyCode || 0;
        return (
            key == 8 ||
            key == 9 ||
            key == 13 ||
            key == 46 ||
            key == 110 ||
            key == 190 ||
            (key >= 35 && key <= 40) ||
            (key >= 48 && key <= 57) ||
            (key >= 96 && key <= 105)
        );
    });
    $('.telefono-cliente-form').keydown(function(e){
        var key = e.charCode || e.keyCode || 0;
        return (
            key == 8 ||
            key == 9 ||
            key == 13 ||
            key == 46 ||
            key == 110 ||
            key == 190 ||
            (key >= 35 && key <= 40) ||
            (key >= 48 && key <= 57) ||
            (key >= 96 && key <= 105)
        );
    });
    
    $('.numero-tarjeta-form').keydown(function(e){
        var key = e.charCode || e.keyCode || 0;
        return (
            key == 8 ||
            key == 9 ||
            key == 13 ||
            key == 46 ||
            key == 110 ||
            key == 190 ||
            (key >= 35 && key <= 40) ||
            (key >= 48 && key <= 57) ||
            (key >= 96 && key <= 105)
        );
    });
    $('.fecha-tarjeta-form').keydown(function(e){
        var key = e.charCode || e.keyCode || 0;
        return (
            key == 8 ||
            key == 9 ||
            key == 13 ||
            key == 46 ||
            key == 110 ||
            key == 190 ||
            (key >= 35 && key <= 40) ||
            (key >= 48 && key <= 57) ||
            (key >= 96 && key <= 105)
        );
    });
    $('.codigo-tarjeta-form').keydown(function(e){
        var key = e.charCode || e.keyCode || 0;
        return (
            key == 8 ||
            key == 9 ||
            key == 13 ||
            key == 46 ||
            key == 110 ||
            key == 190 ||
            (key >= 35 && key <= 40) ||
            (key >= 48 && key <= 57) ||
            (key >= 96 && key <= 105)
        );
    });
    
    $('.calcular-cotizacion').click(function(){
        var iniciar_cotizacion;
        var solucion_clave = $(this).data('clave');
//        var data = new Array()
        if (solucion_clave == 'trad'){
            var paginas = $('#cantidad-'+solucion_clave+'').val();   
            if ($('#idioma-inicio').val() == $('#idioma-final').val()){
                alert('Seleccione dos idiomas diferentes');
                iniciar_cotizacion = 0;
            }
            if ($.isNumeric(paginas) && paginas > 0){
                iniciar_cotizacion = 1;
            } else {
                alert('El número de páginas no es valido.')
                iniciar_cotizacion = 0;
            }
            
        } else if (solucion_clave == 'form' || solucion_clave == 'port' || solucion_clave == 'isbn' || solucion_clave == 'bann' || solucion_clave == 'esti'){
            var paginas = $('#cantidad-'+solucion_clave+'').val();  
            if ($.isNumeric(paginas) && paginas > 0){
                iniciar_cotizacion = 1;
            } else {
                alert('El número insertado no es válido.')
                iniciar_cotizacion = 0;
            }
        } else if (solucion_clave == 'impr' ){
            var paginas = $('#cantidad-'+solucion_clave+'').val();  
            var int_papel = $('#interior-papel-'+solucion_clave+'').val();  
            var int_color = $('#interior-color-'+solucion_clave+'').val();  
            var tamano = $('#tamano-'+solucion_clave+'').val();  
            var port_tipo = $('#portada-tipo-'+solucion_clave+'').val();  
            var port_papel = $('#portada-papel-'+solucion_clave+'').val();
//            var port_papel = $('#portada-papel-'+solucion_clave+'').val();  
            var solapas = $('#solapas-'+solucion_clave+'').is(':checked');  
            var retractil = $('#retractil-'+solucion_clave+'').is(':checked'); 
            var tiraje = $('#tiraje-'+solucion_clave+'').val();  
            if (
                $.isNumeric(paginas) && 
                paginas > 0 &&
                $.isNumeric(tiraje) && 
                tiraje > 0 &&
                int_papel != '' &&
                int_color != '' &&
                tamano != '' &&
                port_tipo != '' &&
                port_papel != ''                
            ){
                iniciar_cotizacion = 1;
            } else {
                alert('El número insertado no es válido.')
                iniciar_cotizacion = 0;
            }
        }
        if (iniciar_cotizacion == 1){
             $.ajax({
                url: 'cotizar',
                type: 'post',
                data: {paginas:paginas, solucion_clave:solucion_clave, int_papel:int_papel, int_color:int_color, port_papel:port_papel, port_tipo:port_tipo, tamano:tamano, solapas:solapas, retractil:retractil, tiraje:tiraje},
                success: function(cotizacion){ 
                    $('.mostrar-numero-cotizar').text(' '+parseFloat(cotizacion).toFixed(2)+' ');
                    $('.col-numero-cotizar').css('display', 'flex');
                },
                error: function(){
                    alert('Error algo ha salido mal al intentar crear su cotización.');
                }
            });
        }
    })
    
    $('.btn-eliminar-producto').click(function(){
        var clave = $(this).val();
        $.ajax({
            url: 'borrar-solucion',
            type: 'post',
            data: { clave:clave},
            success: function(respuesta){
                if (respuesta == 1){
                    alert('Se ha eliminado el producto del carrito');
                    $('.contenedor-producto-'+clave+'').hide();
                    $('.subtotal-'+clave+'').hide();  
                    var sub = parseFloat($('.span-subtotal-'+clave+'').text().replace(',',''));
                    var total = parseFloat($('.span-txt-total').text().replace(',',''));
                    var nuevo = (total-sub).toFixed(2);      
                    $('.span-txt-total').text(nuevo);
                    $('.numero-carrito').text(parseInt($('.numero-carrito').text())-1);
                    if (parseInt($('.numero-carrito').text()) == 0){
                        window.location.reload();
                    }
                } else {
                    alert ('Error, algo ha salido mal al borrar el producto del carrito');
                }
            },
            error: function(){
                alert('Error, algo ha salido mal al borrar el producto del carrito');
            }
        });
        
    })
    
    $('.contenedor-producto').last().addClass('ultimo');
    
    $('.radio-tarjeta').click(function(){
        $('.row-tarjeta-pago').show();
        $('.error-forma-pago').hide() 
    })
    $('.radio-efectivo').click(function(){
        $('.row-tarjeta-pago').hide();
        $('.error-datos-pago').hide()   
        $('.error-forma-pago').hide() 
    })
    $('.radio-paypal').click(function(){
        $('.row-tarjeta-pago').hide();
        $('.error-datos-pago').hide()   
        $('.error-forma-pago').hide() 
    })
    
    $('.click-input-archivo').click(function(){
        $('#input-archivo').trigger('click');
    });
    $('#input-archivo').on('change', function(){
        if (document.getElementById('input-archivo').files && document.getElementById('input-archivo').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.documento-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('input-archivo').files[0]);
        }
    });  
    $('.eliminar-doc').click(function(){
        var doc = $(this).data('id');
        $.ajax({
            url: 'borrar-documento',
            type: 'post',
            data: { doc:doc},
            success: function(respuesta){
                if (respuesta == 1){
                    alert('Se ha eliminado el documento');
                    $('.documento-'+doc+'').css('display', 'none');
                } else {
                    alert ('Error, algo ha salido mal al eliminar el documento');
                }
            },
            error: function(){
                alert('Error, algo ha salido mal al eliminar el documento');
            }
        });
    })
    
    
    
    
    $(window).resize(function(){
        
        $('.blog-img-wrap').css('height','auto');
        $('.blog-titulo-wrap').css('height','auto');
        $('.blog-autor-wrap').css('height','auto');
        $('.blog-resumen-wrap').css('height','auto');
//        $('.solucion-wrap').css('height','auto');
        
        blogAlturaImg($('.blog-img-wrap'));
        blogAlturaTitulo($('.blog-titulo-wrap'));
        blogAlturaAutor($('.blog-autor-wrap'));
        blogAlturaResumen($('.blog-resumen-wrap'));
//        solucionAltura($('.solucion-wrap'));
        
    })
})