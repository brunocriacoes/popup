<?php
  
  include __DIR__ . "/functions.php";

  existDir();

  $arr = getInscritos();

?>
<style>
    .m-container {
        display: block;
        width: 98%;
    }
    .grid-2 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 30px;
    }
    .m-container img {
        width: 100%;
        cursor: pointer;
    }
    .m-container a {
        margin-left: 4px;
        padding: 4px 8px;
        position: relative;
        top: -3px;
        text-decoration: none;
        border: none;
        border: 1px solid #ccc;
        border-radius: 2px;
        background: #f7f7f7;
        text-shadow: none;
        font-weight: 600;
        font-size: 13px;
        line-height: normal;
        color: #0073aa;
        cursor: pointer;
    }
    .m-container a:hover {
        border-color: #008ec2;
        background: #00a0d2;
        color: #fff;
    }
    .m-container h1 {
        display: inline-block;
    }    
</style>

<div class="m-container">
    <h1>Popup</h1>
    <a href="<?= content_url( 'uploads/lead-popup/lista.txt' ) ?>" download>Baixar Lista</a>
    <br>
    <b>Total inscritos( <?= count( $arr ) ?> )</b>
    <br>
    <br>
    <div class="grid-2" >
        <table class="wp-list-table widefat fixed striped posts">
            <thead>
                <tr> <th scope="col" class="manage-column column-name column-primary">Numero WhatsApp</th> </tr>
            </thead>
            <tbody id="the-list">
                <?= drawTr( $arr ) ?>        
            </tbody>
        </table>    
        <div>
            <label for="popup-upload">
                <img src="<?= content_url( 'uploads/lead-popup/foto.jpg?'. uniqid() ) ?>" id="popup-upload-p">
            </label>
            <input type="file" id="popup-upload" onchange="previwew_img( 'popup-upload', 'popup-upload-p' )" hidden>   
        </div>
    </div>
</div>

<script>

async function saveImg( foto ) 
{
    let option   = {
        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
        credentials: "same-origin",
        method: 'POST',
        mode: 'cors',
        cache: 'default',
        body: null,
    }
    option.body = encodeURI(`file=${foto}`)
    let post = await fetch( `<?= plugins_url('popup/api.php') ?>`, option )        
 
    return true
}

function previwew_img( ID, ID_PREVIEW )
{
    let input     = document.querySelector( `#${ID}` );
    let nome      = input.name || 'default';
    let preview   = document.querySelector( `#${ID_PREVIEW}` );
    if (input.files && input.files[0])
    {
        let reader                   = new FileReader();
        reader.onload                = ( e ) =>  {
            let img                  = e.srcElement.result;
            saveImg( window.btoa(img) );
            preview.src              = img;
        };           
        reader.readAsDataURL( input.files[0] );
    }        
}


</script>