<style>
    .m-pop {
        display: none;
        background: rgba(0, 0, 0, .9);
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        justify-content: center;
        align-items: center;
        z-index: 999999999;
    }
    #m-action-pop:checked + .m-pop {
        display: grid;
    }
    .m-pop > div {
        display: block;
        position: relative;
        background: #FFF;
        width: 700px;
        max-width: 90vw;
    }
    .m-pop > div > img {
        display: block;
        width: 100%;
    }
    .m-pop > div > form {
        position: absolute;
        bottom: 0;
        left: 0;
        padding: 24px;
        display: grid;
        grid-template-columns: 1fr 150px;
        width: 100%;
        grid-gap: 24px;
    }
    .m-pop > div > form [type=text] {
        background: #FFF;
        border-radius: 5px;
        border: none;
        padding: 12px;
        font-size: 16px;
    }
    .m-pop > div > form [type=submit] {
        font-size: 16px;
        background: #C00;
        color: #FFF;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }
    .m-pop > div > form [type=submit]:hover {
        filter: contrast(1.5);
    }
    .m-pop > div > label {
        display: grid;
        width: 30px;
        height: 30px;
        background: #C00;
        color: #FFF;
        font-weight: bold;
        border-radius: 30px;
        text-align: center;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-family: monospace;
        position: absolute;
        right: -15px;
        top: -15px;
        z-index: 999;
    }
</style>

<input type="checkbox" id="m-action-pop"  hidden>
<div class="m-pop">
    <div>
        <label for="m-action-pop"> X </label>
        <img src="<?= content_url( 'uploads/lead-popup/foto.jpg' ) ?>">
        <form action="javascript:void(meInscrever())">
            <input type="text" id="tel-popup" onkeypress="setMascara(this, '(99) 9 9999-9999')" required>
            <input type="submit" value="Me Cadastrar">
        </form>
    </div>  
</div>

<script>
    function popAction()
    {
        document.querySelector( '#m-action-pop' ).click()
    }

    function meInscrever()
    {
        let mail = document.querySelector( '#tel-popup' ).value
        fetch( `<?= plugins_url('popup/api.php') ?>?email=${mail}` )
        document.querySelector( '#tel-popup' ).value = ''
        popAction()
    }

    function setMascara(el, pattern, limit = true ) 
    {         
        let value   = el.value || ''
        let misterX = pattern.replace(/9/g, 'x')
        let max     = pattern.replace( /\D/gi, '' )
        value       = value.replace( /\D/gi, '' )
        if( limit ) {
            el.setAttribute( 'maxlength', misterX.length )
        }
        if( value.length <= max.length && value.length > 0) {
            value.split('').forEach( x => {
                let index      = misterX.indexOf('x')
                misterX        = misterX.split('')
                misterX[index] = x
                misterX        = misterX.join('')
            } )
            let ultimo         = misterX.split('').reverse().join('').search(/\d/)
            ultimo             = misterX.length - ultimo
            value              = misterX.substr(0,ultimo)
        }
        el.value = value
    }

    if( ! sessionStorage.getItem('visto') ) {
        popAction()
        sessionStorage.setItem('visto', '1')
    }

</script>
