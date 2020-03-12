jQuery(document).ready(function( $ ) {
(function (){

   // This sticky bar is created using only javascript and it's prepared to avoid any browser problem. It was tested on Google Tag Manager and works fine, hope you enjoy.

    // Default color settings

    // Color settings:
        var mainBackgroundColor = '#6b39b5' // Primary color
        var mainBorderLeftpColor = '#6b39b5 ' // Primary border color
        var mainTextColor = '#fff' // Secudanry color
        //var declineButtonBackgroundColor = 'rgba(74, 36, 132, 0.4)' // Rejection button color
        var acceptButtonTextColor = '#6b39b5 ' // Accecpt button color

    // It animated our sticky bar

    function slideUp (target, duration) {
        target.style.transitionProperty = 'height, margin, padding';
        target.style.transitionDuration = duration + 'ms';
        target.style.boxSizing = 'border-box';
        target.style.height = target.offsetHeight + 'px';
        target.offsetHeight;
        target.style.overflow = 'hidden';
        target.style.height = 0;
        target.style.paddingTop = 0;
        target.style.paddingBottom = 0;
        target.style.marginTop = 0;
        target.style.marginBottom = 0;
        window.setTimeout( function () {
            target.style.display = 'none';
            target.style.removeProperty('height');
            target.style.removeProperty('padding-top');
            target.style.removeProperty('padding-bottom');
            target.style.removeProperty('margin-top');
            target.style.removeProperty('margin-bottom');
            target.style.removeProperty('overflow');
            target.style.removeProperty('transition-duration');
            target.style.removeProperty('transition-property');
        }, duration);
    }

    // It creates a ajax request for our accept button to whatever you want to
        function accept()
        {
            var APID = '{{APID}}'
            var campaignID = '{{campaignID}}'
            var email = '{{email}}'

            var xhr = new XMLHttpRequest()
            xhr.open("POST", "http://localhost/dicaboa2/db/assets_dashboard/php/pixel.php")
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
            xhr.send("action=test&campaignID="+campaignID+"&transactionID="+APID+"&email="+email+"")
        }

    // It creates the background of out sticky bar
        var background = document.createElement('div')
        background.setAttribute('style', 'max-width: 200px; height: 250px; background-color: #fff; box-sizing: border-box; position: fixed; bottom: 0; right: 0; margin: 10px; z-index: 999999;  display: inline-table;font-family: Arial, Helvetica, sans-serif; box-shadow: 0 25px 35px -5px rgba(0,0,0,0.1)')
        background.setAttribute('class', 'popup')

    // It creates the image promo Lafuente
        var img = document.createElement('img')
        img.setAttribute('style', 'max-width: 200px; height: auto; box-sizing: border-box; display: block; z-index:9999999')
        img.setAttribute('src', 'https://lafuente.es/wp-content/uploads/2020/03/dia-del-padre_v02.jpg')
        img.setAttribute('class', 'promo-img')


    // It creates the P element of out sticky bar
        var p = document.createElement("p")

        p.setAttribute(
            'style', 'color: #000; text-align:center; float: left; word-wrap: break-word; padding: 15px; font-weight: normal; margin: 0; font-size: 11px; line-height:12px; display: inline-table'
        )
        p.setAttribute('class', 'info')

        // P element text
            p.innerText = 'Promoción válida para toda España hasta el 19 de marzo de 2020 a las 23:59 horas. Se aplicará un descuento del 10% al introducir el código DIADELPADRE.'

        // It creates the h2 element of out sticky bar
        var h2 = document.createElement("h2")

        h2.setAttribute(
            'style', 'color: #000; text-align:center; float: left; word-wrap: break-word; padding: 15px; font-weight: 700; margin: 0; font-size: 18px; line-height:18px; display: inline-table'
        )
        h2.setAttribute('class', 'heading-h2')

        // P element text
        h2.innerText = '10% de descuento con el código DIADELPADRE'

        background.appendChild(img)
        background.appendChild(h2)
        background.appendChild(p)

        // Accept button
        var button = document.createElement("button")

        button.setAttribute(
            'style', 'text-align: center; margin:10px; background-color: #9e2b3f; color: #fff; border: none; padding: 8px; min-width: 25%; border-radius: 5px; font-size: 11pt; float: right; cursor: pointer; display: inline-block; font-weight: normal'
        )
        button.setAttribute('class', 'button-accept')
        button.setAttribute('title', 'Comprar')
        // Accept butotn text:
            button.innerText = "OK"

        background.appendChild(button)


        var button = document.createElement("button")

        document.body.appendChild(background);

    // Action buttons events:
        document.querySelector(".button-accept").addEventListener('click', function () {
            //accept()
            slideUp(document.querySelector(".popup"), 200);
        });


    document.body.appendChild(background)




})()
})
