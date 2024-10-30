<div id="crmio_data">
<iframe id="crmio_view" name="crmio_view" style="width:100%; height: 800px;" src="<?php echo $crmio_url ?>"></iframe>
</div>
<script>
    /** to create cookie **/
    function crmio_setcookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }
    /** getting token from infinity**/
    function crmio_form() {
        window.addEventListener('message',(event)=>{
        var script_values   = event.data;
	            console.log(event.data);
        var api_key         = script_values['api_key'];
        var verify          = script_values['verify'];
        var region          = script_values['region'];
        if(api_key && !verify){
            var install_script  = 'true';
            var verify          = 'false';
            pbxplus_save_website(api_key,region,install_script,verify);
            setTimeout(()=>{
                var z=document.getElementById('crmio_view');
                z.contentWindow.postMessage({'crmio_script':true},'*');
            },2000);
        }else if(verify){
            var install_script = 'true';
            var verify = 'true';
            setTimeout(()=>{
                var z=document.getElementById('crmio_view');
                pbxplus_save_website(api_key,region,install_script,verify);
                z.contentWindow.postMessage({'crmio_verify':true},'*');
            },2000);
        }
    })
    }

/** To save website names to DB **/
function crmio_save_website(api_key,region,install_script,verify) {
    postData = {
        website_apikey: api_key,
        website_region: region,
        website_installscript: install_script,
        website_verify: verify,
        action: 'crmio_save_website'
    };
    jQuery.post(ajaxurl, postData, function (response) {
        setTimeout(function () {
            var response_data = jQuery.trim(response);
            if (response_data == 'updated0') {
                //console.log('updated');
            }
            else
            {
                //console.log('not updated');
            }
        }, 2000);
    });
    return false;
}
</script>
<?php
include 'other_products.php';
?>
<style>
    .crmio-content{
        text-align: center !important;
        margin-top: 50px;
    }
    </style>