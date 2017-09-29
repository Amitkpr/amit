<?php
/**
 * Template Name: Add Property
 *
 */

get_header();
$role = user_role();
if (!is_user_logged_in())
{
    wp_redirect(site_url());
}

global $wpdb, $current_user;
$userids = base64_encode($current_user->ID);

$propertyMeta = 'propertyImage' . $userids;
if (isset($_GET['tag']) && $_GET['tag'] == 'updateproperty')
{
    $propertyID = $_GET['id'];
}

?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/datepicker3.css" />
<link href="<?php echo get_template_directory_uri(); ?>/css/jquery.fileuploader.css" media="all" rel="stylesheet">
<link href="<?php echo get_template_directory_uri(); ?>/css/jquery.fileuploader-theme-dragdrop.css" media="all" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.fileuploader.min.js" type="text/javascript"></script>
<style>
.datepicker table tr td.active.day, .datepicker table tr td.active.day:hover{
    background: #ea0011 none repeat scroll 0 0;
}
.datepicker table tr td.today.day{
    background: #ffe0e2 none repeat scroll 0 0;
}
#addpropertyFile .fileuploader-input-button {
  background: #ff0000 none repeat scroll 0 0;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    /* jQuery('#appendfiles').val(''); */
    // enable fileuploader plugin
    $('#addpropertyFile input[name="files"]').fileuploader({
        changeInput: '<div class="fileuploader-input">' +
                          '<div class="fileuploader-input-inner">' +
                              '<img src="<?php echo get_template_directory_uri(); ?>/images/fileuploader-dragdrop-icon.png">' +
                              '<h3 class="fileuploader-input-caption"><span>Drag and drop files here</span></h3>' +
                              '<p>or</p>' +
                              '<div class="fileuploader-input-button"><span>Browse Files</span></div>' +
                          '</div>' +
                      '</div>',
        theme: 'dragdrop',
        upload: {
            url: '<?php echo get_template_directory_uri(); ?>/php/ajax_upload_file.php/?userID=<?php echo $userids; ?>&tag=addproperty',
            data: null,
            type: 'POST',
            enctype: 'multipart/form-data',
            start: true,
            synchron: true,
            beforeSend: null,
            onSuccess: function(result, item) {
                var data = JSON.parse(result);
               /*  console.log(data); */
                // if success
                if (data.isSuccess && data.files[0]) {
                    item.name = data.files[0].name;
                    var nVal = jQuery('#appendfiles').val();
                    if(nVal == 'null'){
                        jQuery('#appendfiles').val('');
                    }
                    var nValf = jQuery('#appendfiles').val();
                    if(nValf != ''){
                        jQuery('#appendfiles').val(nValf+','+'min_'+item.name);
                    }else{
                        jQuery('#appendfiles').val('min_'+item.name);
                    }

                    item.imgid = data.image_id;
                    item.html.find('.column-title > div:first-child').text(data.files[0].old_name).attr('title', 'min_'+data.files[0].name);
                }

                // if warnings
                if (data.hasWarnings) {
                    for (var warning in data.warnings) {
                        alert(data.warnings);
                    }

                    item.html.removeClass('upload-successful').addClass('upload-failed');
                    // go out from success function by calling onError function
                    // in this case we have a animation there
                    // you can also response in PHP with 404
                    return this.onError ? this.onError(item) : null;
                }

                item.html.find('.column-actions').append('<a data-id="'+data.image_id+'" class="fileuploader-action fileuploader-action-remove fileuploader-action-success" title="Remove"><i></i></a>');
                setTimeout(function() {
                    item.html.find('.progress-bar2').fadeOut(400);
                }, 400);
            },
            onError: function(item) {
                var progressBar = item.html.find('.progress-bar2');

                if(progressBar.length > 0) {
                    progressBar.find('span').html(0 + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(0 + "%");
                    item.html.find('.progress-bar2').fadeOut(400);
                }

                item.upload.status != 'cancelled' && item.html.find('.fileuploader-action-retry').length == 0 ? item.html.find('.column-actions').prepend(
                    '<a class="fileuploader-action fileuploader-action-retry" title="Retry"><i></i></a>'
                ) : null;
            },
            onProgress: function(data, item) {
                var progressBar = item.html.find('.progress-bar2');

                if(progressBar.length > 0) {
                    progressBar.show();
                    progressBar.find('span').html(data.percentage + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                }
            },
            onComplete: null,
        },
        onRemove: function(item) {
            var images = jQuery('#appendfiles').val();
            value = images.replace(',min_'+item.name,''); // value = 9:61
            // can then use it as
            alert(item.name);
            $("#appendfiles").val(value);
            $.post('<?php echo get_template_directory_uri(); ?>/php/ajax_remove_file.php', {
                file: item.name,
                imgid: item.imgid
            });
        },
        captions: {
            feedback: 'Drag and drop files here',
            feedback2: 'Drag and drop files here',
            drop: 'Drag and drop files here'
        },
    });


    /*update images*/

    $('#updatepropertyFile input[name="files"]').fileuploader({
        changeInput: '<div class="fileuploader-input">' +
                          '<div class="fileuploader-input-inner">' +
                              '<img src="<?php echo get_template_directory_uri(); ?>/images/fileuploader-dragdrop-icon.png">' +
                              '<h3 class="fileuploader-input-caption"><span>Drag and drop files here</span></h3>' +
                              '<p>or</p>' +
                              '<div class="fileuploader-input-button"><span>Browse Files</span></div>' +
                          '</div>' +
                      '</div>',
        theme: 'dragdrop',
        upload: {
            url: '<?php echo get_template_directory_uri(); ?>/php/ajax_upload_file.php/?propertyID=<?php echo $propertyID; ?>&userID=<?php echo $userids; ?>&tag=updateproperty',
            data: null,
            type: 'POST',
            enctype: 'multipart/form-data',
            start: true,
            synchron: true,
            beforeSend: null,
            onSuccess: function(result, item) {
                var data = JSON.parse(result);
               /*  console.log(data); */
                // if success
                if (data.isSuccess && data.files[0]) {
                    item.name = data.files[0].name;
                    item.imgid = data.image_id;

                    item.html.find('.column-title > div:first-child').text(data.files[0].old_name).attr('title', data.files[0].name);
                }

                // if warnings
                if (data.hasWarnings) {
                    for (var warning in data.warnings) {
                        alert(data.warnings);
                    }

                    item.html.removeClass('upload-successful').addClass('upload-failed');
                    // go out from success function by calling onError function
                    // in this case we have a animation there
                    // you can also response in PHP with 404
                    return this.onError ? this.onError(item) : null;
                }

                item.html.find('.column-actions').append('<a data-id="'+data.image_id+'" class="fileuploader-action fileuploader-action-remove fileuploader-action-success" title="Remove"><i></i></a>');
                setTimeout(function() {
                    item.html.find('.progress-bar2').fadeOut(400);
                }, 400);
            },
            onError: function(item) {
                var progressBar = item.html.find('.progress-bar2');

                if(progressBar.length > 0) {
                    progressBar.find('span').html(0 + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(0 + "%");
                    item.html.find('.progress-bar2').fadeOut(400);
                }

                item.upload.status != 'cancelled' && item.html.find('.fileuploader-action-retry').length == 0 ? item.html.find('.column-actions').prepend(
                    '<a class="fileuploader-action fileuploader-action-retry" title="Retry"><i></i></a>'
                ) : null;
            },
            onProgress: function(data, item) {
                var progressBar = item.html.find('.progress-bar2');

                if(progressBar.length > 0) {
                    progressBar.show();
                    progressBar.find('span').html(data.percentage + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                }
            },
            onComplete: null,
        },
        onRemove: function(item) {
            $.post('<?php echo get_template_directory_uri(); ?>/php/ajax_remove_file.php', {
                file: item.name,
            });
        },
        captions: {
            feedback: 'Drag and drop files here',
            feedback2: 'Drag and drop files here',
            drop: 'Drag and drop files here'
        },
    });

});
</script>

<style type="text/css">
    .ErrorMesg {
        color: red;
        font-size: 15px;
    }
    .successMsg {
        color: green;
        font-size: 15px;
    }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMrFJCY6VldvwPWn9zB1q417eTS7gNno&libraries=places"></script>

    <script>
    function initialize() {

      var input = document.getElementById('paddress');
      var options = {
        types: ['address'],
        componentRestrictions: {
          country: 'us'
        }
      };
      autocomplete = new google.maps.places.Autocomplete(input, options);
      google.maps.event.addListener(autocomplete, 'place_changed', function() {

        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        var city = place.vicinity;
        document.getElementById('city').value = city;
        document.getElementById('lat').value = lat;
        document.getElementById('lng').value = lng;
        for (var i = 0; i < place.address_components.length; i++) {
          for (var j = 0; j < place.address_components[i].types.length; j++) {
            if (place.address_components[i].types[j] == "postal_code") {
              document.getElementById('zipcode').value = place.address_components[i].long_name;
            }else{
                document.getElementById('zipcode').value = '';
            }
          }
        }
      })
    }
    google.maps.event.addDomListener(window, "load", initialize);
    </script>
<?php
//print_r(is_user_logged_in());
//is_user_logged_in();

$ErrorMesg = "";

if (isset($_POST['savechanges']) && !empty($_POST))
{

    $PostArr = [];
    session_start();
    global $wpdb, $current_user, $wp_session;
    $userID       = $current_user->ID;
    $checkAddress = $_POST['paddress'];
    $checklat     = $_POST['lat'];
    $checklng     = $_POST['lng'];
    $checkQuery   = "select lat,lng,paddress,zipcode from wp_home_facts where paddress = '" . $checkAddress . "' and lat = $checklat and lng = $checklng";
    $addressExist = $wpdb->get_results($checkQuery);
    if ($addressExist)
    {
        wp_redirect(get_the_permalink() . '/?tag=addproperty&adau=exist');}
    else
    {

        /* if(empty($_POST['hometype'])){

        $ErrorMesg = "Home type is required!";

        }elseif(empty($_POST['beds']) ){

        $ErrorMesg = "beds";

        }elseif( empty($_POST['finishedFeet']) ){
        $ErrorMesg = "Finished square feet is required!";

        }elseif( empty($_POST['lotSize']) ){
        $ErrorMesg = "Lot size is required!";

        }else{ */

        /* pt($_POST['outdoor_amenittes']);
        die; */
        $filesn   = explode(',', $_POST['files_append']);
        $newImage = array();
        foreach ($filesn as $filen)
        {
            if ($filen != '' && $filen != 'null')
            {
                $newImage[] = $filen;
            }
        }
        /* $inser_url = site_url().'/wp-content/uploads/properties_gallery/'.$data['files']['0']['name']; */
        /* echo serialize($newImage); */
        /* pt($_POST);
        pt();
        die; */

        $adminID   = $current_user->ID;
        $results   = "SELECT * FROM wp_default_calculator";
        $result    = $wpdb->get_row($results);
        $allvalues = unserialize($result->userinput);

        $PostArr['user_id']   = $userID;
        $PostArr['home_type'] = $_POST['hometype'];
        $PostArr['images']    = serialize($newImage);

        $PostArr['ptitle']   = $_POST['ptitle'];
        $PostArr['paddress'] = $_POST['paddress'];
        $PostArr['lat']      = $_POST['lat'];
        $PostArr['lng']      = $_POST['lng'];
        $PostArr['zipcode']  = $_POST['zipcode'];
        $PostArr['city']     = $_POST['city'];
        $PostArr['pprice']   = str_replace(',', '', $_POST['pprice']);

        $PostArr['beds']             = $_POST['beds'];
        $PostArr['full_baths']       = $_POST['fbaths'];
        $PostArr['aby4baths']        = $_POST['aby4baths'];
        $PostArr['bby2baths']        = $_POST['bby2baths'];
        $PostArr['cby4baths']        = $_POST['cby4baths'];
        $PostArr['finished_feet']    = $_POST['finishedFeet'];
        $PostArr['lot_sze']          = $_POST['lotSize'];
        $PostArr['lot_units']        = $_POST['lotunits'];
        $PostArr['year_built']       = $_POST['yearBuilt'];
        $PostArr['remodal']          = $_POST['remodal'];
        $PostArr['sold_date']        = $_POST['sold_date'];
        $PostArr['hoadues']          = str_replace(',', '', $_POST['hoadues']);
        $PostArr['base_sqft']        = $_POST['baseSqft'];
        $PostArr['garage_sqft']      = $_POST['garageSqft'];
        $PostArr['home_description'] = $_POST['descHome'];

        $PostArr['ZillowID'] = $_POST['ZillowID'];
        $PostArr['MLSID']    = $_POST['MLSID'];
        $PostArr['TRETID']   = $_POST['zipcode'] . rand(10000, 99999);

        if ($role == 'dataentry' || $role == 'administrator')
        {
            /*Calcluation Fields start here*/
            $PostArr['upfrontimprovement']      = str_replace(',', '', $_POST['upfrontimprovement']);
            $PostArr['closingcost']             = $_POST['closingcost'];
            $PostArr['downpayment']             = $_POST['downpayment'];
            $PostArr['interestrate']            = $_POST['interestrate'];
            $PostArr['mortgageyears']           = $_POST['mortgageyears'];
            $PostArr['monthlyrent']             = str_replace(',', '', $_POST['monthlyrent']);
            $PostArr['vacancyrate']             = $_POST['vacancyrate'];
            $PostArr['expropertytaxes']         = $_POST['expropertytaxes'];
            $PostArr['exinsurance']             = str_replace(',', '', $_POST['exinsurance']);
            $PostArr['exrepairs']               = $_POST['exrepairs'];
            $PostArr['exutilities']             = str_replace(',', '', $_POST['exutilities']);
            $PostArr['expropertymgmt']          = $_POST['expropertymgmt'];
            $PostArr['exhoa']                   = str_replace(',', '', $_POST['exhoa']);
            $PostArr['exother']                 = $_POST['exother'];
            $PostArr['exotherfixed']            = str_replace(',', '', $_POST['exotherfixed']);
            $PostArr['marginaltaxrate']         = $_POST['marginaltaxrate'];
            $PostArr['annualappreciation']      = $_POST['annualappreciation'];
            $PostArr['amortizationperiodyears'] = $_POST['amortizationperiodyears'];
            $PostArr['selltransactioncost']     = $_POST['selltransactioncost'];
            $PostArr['annualrentincrease']      = $_POST['annualrentincrease'];
            $PostArr['sellholdingperiod']       = $_POST['sellholdingperiod'];
            $PostArr['sellcapitalgain']         = $_POST['sellcapitalgain'];
            $PostArr['annualoprating']          = $_POST['annualoprating'];
            $PostArr['sellstatetax']            = $_POST['sellstatetax'];
            $PostArr['selldepreciationrecap']   = $_POST['selldepreciationrecap'];

            /*Calcluation Fields end here*/

        }
            else
            {

            /*Calcluation Fields start here*/
            $PostArr['upfrontimprovement']      = str_replace(',', '', $allvalues['upfrontimprovement']);
            $PostArr['closingcost']             = $allvalues['closingcost'];
            $PostArr['downpayment']             = $allvalues['downpayment'];
            $PostArr['interestrate']            = $allvalues['interestrate'];
            $PostArr['mortgageyears']           = $allvalues['mortgageyears'];
            $PostArr['monthlyrent']             = str_replace(',', '', $allvalues['monthlyrent']);
            $PostArr['vacancyrate']             = $allvalues['vacancyrate'];
            $PostArr['expropertytaxes']         = $allvalues['expropertytaxes'];
            $PostArr['exinsurance']             = str_replace(',', '', $allvalues['exinsurance']);
            $PostArr['exrepairs']               = $allvalues['exrepairs'];
            $PostArr['exutilities']             = str_replace(',', '', $allvalues['exutilities']);
            $PostArr['expropertymgmt']          = $allvalues['expropertymgmt'];
            $PostArr['exhoa']                   = str_replace(',', '', $allvalues['exhoa']);
            $PostArr['exother']                 = $allvalues['exother'];
            $PostArr['exotherfixed']            = str_replace(',', '', $allvalues['exotherfixed']);
            $PostArr['marginaltaxrate']         = $allvalues['marginaltaxrate'];
            $PostArr['annualappreciation']      = $allvalues['annualappreciation'];
            $PostArr['amortizationperiodyears'] = $allvalues['amortizationperiodyears'];
            $PostArr['selltransactioncost']     = $allvalues['selltransactioncost'];
            $PostArr['annualrentincrease']      = $allvalues['annualrentincrease'];
            $PostArr['sellholdingperiod']       = $allvalues['sellholdingperiod'];
            $PostArr['sellcapitalgain']         = $allvalues['sellcapitalgain'];
            $PostArr['annualoprating']          = $allvalues['annualoprating'];
            $PostArr['sellstatetax']            = $allvalues['sellstatetax'];
            $PostArr['selldepreciationrecap']   = $allvalues['selldepreciationrecap'];

            /*Calcluation Fields end here*/
        }

        $PostArr['add_info_home']       = $_POST['addInfoHome'];
        $PostArr['appliances']          = serialize($_POST['appliances']); //
        $PostArr['basement']            = $_POST['basement'];
        $PostArr['floor_cover']         = serialize($_POST['floorcover']); //
        $PostArr['rooms']               = serialize($_POST['rooms']); //
        $PostArr['totalrooms']          = $_POST['totalrooms'];
        $PostArr['indoor']              = serialize($_POST['Indoor']);
        $PostArr['basement']            = $_POST['basement'];
        $PostArr['rooms']               = serialize($_POST['rooms']); //
        $PostArr['cooling_type']        = serialize($_POST['cooling_type']); //
        $PostArr['heating_type']        = serialize($_POST['heating_type']); //
        $PostArr['heating_fuel']        = serialize($_POST['heating_fuel']); //
        $PostArr['building_amenities']  = serialize($_POST['building_amenities']); //
        $PostArr['architectural_style'] = $_POST['architectural_style'];
        $PostArr['exterior']            = serialize($_POST['exterior']); //
        $PostArr['outdoor_amenities']   = serialize($_POST['outdoor_amenittes']); //
        $PostArr['stories_count']       = $_POST['StoriesCount'];
        $PostArr['parking']             = serialize($_POST['parking']); //
        $PostArr['covered_parking']     = $_POST['CoveredParking'];
        $PostArr['roof']                = serialize($_POST['roof']); //
        $PostArr['view']                = serialize($_POST['view']); //
        /* $_SESSION['user_start'] = date('Y-m-d H:i:s');     */
        $PostArr['created_date']  = date('Y-m-d H:i:s');
        $PostArr['modified_date'] = date('Y-m-d H:i:s');
        /* $inserts = $wpdb->insert('wp_home_facts',$PostArr); */

        /* echo '<pre>'; print_r($PostArr); die; */

        $count = count($filesn);

        /* if($count <=1 && $filesn[0] == 'null'){ */
        /* pt($PostArr);
        die; */
        $resultforupdate = $wpdb->insert('wp_home_facts', $PostArr);
        /* $lastid = $wpdb->insert_id;     */
        /* }else{ */

        /* pt(serialize($newImage));
        die; */

        /* $wpdb->delete( 'property_imaes', array( 'status' => '0' )); */

        /* $resultforupdate = $wpdb->update('wp_home_facts',$PostArr,array('id'=>$_SESSION['lastpropertyid'])); */

        /* } */

        if ($resultforupdate)
                {
           /* $lastid = $wpdb->insert_id;
            $TRETID = $_POST['zipcode'] . rand(10000, 99999);
            $wpdb->query($wpdb->prepare("UPDATE wp_home_facts SET TRETID='$TRETID' WHERE id=$lastid"));
*/
            $_SESSION['lastpropertyid']     = "";
            $_SESSION['home_facts_success'] = "";
            $_SESSION['home_facts_error']   = "";
            header("Location: " . site_url() . '/your-profile/?tag=property_listing&agentid=' . base64_encode($userID));
            exit;
        }
                    else
                    {
            $_SESSION['home_facts_success'] = "";
            $_SESSION['home_facts_error']   = "Something went worng please try agin.";
            header("Location: " . the_permalink());
            exit;
        }
    }
}

global $wpdb;
$UserID     = get_current_user_id();
$UserIDe    = base64_encode(get_current_user_id());
$propertyID = base64_decode($_GET['id']);
$query      = "SELECT user_id,paddress,zipcode FROM wp_home_facts WHERE id = '" . $propertyID . "' and user_id = '" . $UserID . "'";
$result     = $wpdb->get_row($query);
if (!empty($result))
                {
    if ($UserID == $result->user_id || $UserID == '7')
                    {

        $paddress = $result->paddress;
        $user_id  = $result->user_id;
        $zipcode  = $result->zipcode;

    }
                    else
                    {
        $url = site_url() . "/your-profile/?tag=property_listing&agentid='" . $UserIDe . "'";
        wp_redirect($url);
    }
}

?>
<link href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" rel="stylesheet"/>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"> </script>

    <div class="container" id="facts_maincontainer">
        <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <?php if (isset($_GET['adau']) && $_GET['adau'] == 'exist')
                {
    ?>
                <div class="alert alert-danger">
                  <strong>Alert!</strong> Property Address You Have Entered, Already Exist.
                </div>
                <?php }?>
                </div>
                <?php if ($paddress)
                {
    ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mainhead_container">
                <h1 class="facts_headingmain"><?php echo $paddress . ', ' . $zipcode; ?></h1>
            </div>
                <?php }?>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php
if (isset($_GET['tag']) && $_GET['tag'] == 'updateproperty')
                {
    echo '<h2 class="facts_headingsmall">Update property</h2>';
}
                else
                {
    echo '<h2 class="facts_headingsmall">Add property</h2>';
}
?>

                <div class="ErrorMesg"><?php /* echo $ErrorMesg; */?></div>
                <div class="ErrorMesg"><?php echo $_SESSION['home_facts_error']; ?></div>
                <div class="successMsg"><?php echo $_SESSION['home_facts_success']; ?></div>
            </div>
        </div>

        <?php
if (isset($_GET['tag']) && $_GET['tag'] == 'addproperty')
                {
    global $wpdb;
    /* $PtostArr = [];
    $PtostArr['user_id']     = $userID;
    $PtostArr['home_type']     = 'new';
    $wpdb->insert('wp_home_facts',$PtostArr); */
    get_template_part('template-parts/addproperties');
}
if (isset($_GET['tag']) && $_GET['tag'] == 'updateproperty')
                {
    get_template_part('template-parts/updateproperties');
}
?>

</div>
<script>
    jQuery(document).ready(function(){
         jQuery("a[rel^='prettyPhoto']").prettyPhoto();
         jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools:''});


jQuery( '.uploadPic' ).click(function(){
    jQuery('#homeImages').trigger('click');
});

jQuery( document ).on('click', '.factThumbnail .remove', function(){
    var x;
    if (confirm("Are you sure you want to delete this property") == true) {
        /* var propertyID = jQuery(this).attr('id');
        var userID = jQuery(this).attr('data_id'); */

        var imageName = jQuery(this).attr('data');
    /*  var meta_key = jQuery(this).attr('rel'); */
        var id = jQuery(this).attr('id');
        jQuery(this).parent().parent().addClass('deleteImg_Parent');

        var strc = 'action=deletePropertiesImages&imageName=' + imageName + '&id=' + id;

         jQuery.ajax({

            context: this,

            url: "<?php echo home_url(); ?>/wp-admin/admin-ajax.php",

            type: 'POST',

            data: strc,

            success: function(response) {
            /* alert(response); */
            var images = jQuery('#appendfiles').val();
            value = images.replace(','+response, ""); // value = 9:61
            // can then use it as
            jQuery("#appendfiles").val(value);

            jQuery('#deleteMsg').html('Your Property has been deleted');
                jQuery(this).parent().parent().css('display','none');

            }

        });

    }






});
    jQuery( document ).delegate('#homeImages', 'change', function()
    {
        if (window.File && window.FileReader && window.FileList && window.Blob)
        {
            var data = jQuery(this)[0].files;
            jQuery.each(data, function(index, file)
            {
                var fileSize = Math.round(file.size/1024);
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type) && fileSize<=4000)
                {
                    /* jQuery('#thumb-output-agentLogo').html('');   */
                    jQuery('span.upload-path-name-agentLogo').html('');
                    var fRead = new FileReader();
                    fRead.onload = (function(file)
                    {
                        return function(e)
                        {
                            var img = '<li class="factThumbnail"><a><img id="preview" class="factThumbnailimg" src="'+e.target.result+'" class="img-responsive"><i class="fa fa-times-circle remove" aria-hidden="true"></i></a></li>';
                            jQuery('#thumb-output-agentLogo').append(img);
                            jQuery('span.upload-path-name-agentLogo').html(file.name);
                        };
                    })(file);
                    fRead.readAsDataURL(file);
                }
                else
                {
                    jQuery('input#agentLogoUpload').val('');
                    jQuery(".error-messageFileSizeLogo").find("#myModalFileSizeError").modal({backdrop: 'static', keyboard: false});
                }
            });

        }
    });

     });
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-datepicker.js"></script>
<script>
$('#yearBuilt').datepicker({
     format: " yyyy", // Notice the Extra space at the beginning
    viewMode: "years",
    minViewMode: "years",
    todayHighlight: true
});

$('#remodalyear').datepicker({
    format: " yyyy", // Notice the Extra space at the beginning
    viewMode: "years",
    minViewMode: "years",
    todayHighlight: true
});
$('#sold_date').datepicker({
    /* format: " yyyy", // Notice the Extra space at the beginning
    viewMode: "years",
    minViewMode: "years", */
    todayHighlight: true
});
/* $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
}); */
</script>
<?php

/* pt($_REQUEST); */
get_footer();?>